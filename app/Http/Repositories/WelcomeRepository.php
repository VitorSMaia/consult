<?php

namespace App\Http\Repositories;

use App\Http\Requests\FormRequest;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\ConfigValues;
use App\Models\FormSafe;
use App\Models\Occurrences;
use App\Models\Partner;
use App\Models\User;
use App\Service\API\InsuranceCalculator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WelcomeRepository
{
    private $formDB;
    private $configValues;

    public function __construct()
    {
        $this->formDB = FormSafe::query()->with(['user', 'address', 'status']);
        $this->configValues = ConfigValues::query()->first()->toArray();
        $this->occurrences = Occurrences::query();
    }

    public function index($limit = 10, $name = null)
    {
        try {
            if (!is_null($name)) {
                $this->formDB = $this->formDB
                    ->orWhere('requested_id', 'like', "%$name%");
            }

            $this->formDB = $this->formDB->orderBy('created_at', 'DESC')->paginate($limit);

            return [
                'data' => $this->formDB,
                'message' => 'Listagem com sucesso.',
                'code' => 200
            ];
        } catch (\Exception $exception) {
            Log::error('[WelcomeRepository][index]' . '::index => ' . $exception->getMessage());
            return array(
                'data' => array(),
                'message' => 'Falha ao listar status.',
                'code' => $exception->getCode()
            );
        }
    }

    public function find($id)
    {
        try {
            $this->formDB = $this->formDB->findOrFail($id)->toArray();

            $this->formDB += $this->configValues;

            return [
                'data' => $this->formDB,
                'code' => 200,
                'message' => ''
            ];
        } catch (\Exception $exception) {
            Log::error('dd' . '::find => ' . $exception->getMessage());
            return [
                'data' => array(),
                'message' => '',
                'code' => $exception->getCode(),
            ];
        }
    }

    public function updateOrCreate($request)
    {
        $id = $request['id'] ?? '';
        if(empty($id)) {
            $request['company'] = 'Finarte Client';
            $request['password'] = Str::random(8);
            $request['status'] = 'Inativo';
        }

        $userRequest = new UserRequest();
        $requestUser = $userRequest->validation($request, $id);
        $formRequest = new FormRequest();
        $requestFormSafe = $formRequest->validation($request);

        try {
            DB::beginTransaction();

            $userDB = User::query()->updateOrCreate([
                'id' => $id
            ],$requestUser);

            $requestFormSafe['user_id'] = $userDB['id'];

            $this->formDB = $this->formDB->updateOrCreate([
                'id' => $requestFormSafe['form_id']
            ],$requestFormSafe);

            $arrAdress = [];
            foreach ($request['address'] as $itemAddress) {
                if(!empty($itemAddress['cep'])) {
                    $AddressDB = Address::query()->updateOrCreate([
                        'cep' => $itemAddress['cep'],
                        'street' => $itemAddress['street'],
                        'number' => $itemAddress['number'],
                        'neighborhood' => $itemAddress['neighborhood'],
                        'complement' => $itemAddress['complement'] ?? '',
                        'uf' => $itemAddress['uf'],
                        'city' => $itemAddress['city'],
                    ],[
                        'type_address' => $itemAddress['type_address'],
                        'occupation' => $itemAddress['occupation'],
                        'construction' => '',
                        'obs_address' => $request['address']['obs_address'],
                    ]);
                    array_push($arrAdress, $AddressDB->id) ;
                }
            }
            $this->formDB->address()->sync($arrAdress);
            $estimated_safe = $requestFormSafe['estimated_safe'];

            if($estimated_safe < 50000000.00) {
                $insuranceCalculator = new InsuranceCalculator;
                $insuranceCalculator = $insuranceCalculator->fetchData($estimated_safe, $this->configValues);
                $insuranceCalculator += $this->configValues;

                $this->formDB->update([
                    'value_tax' => $insuranceCalculator['tax'],
                    'value_iof' => $insuranceCalculator['value_iof'],
                    'value_total' => $insuranceCalculator['total'],
                    'value_requested' =>$insuranceCalculator['origin'],
                    'percentage_iof' =>$insuranceCalculator['iof'],
                ]);
            }else {

                $insuranceCalculator['tax'] = 0;
                $insuranceCalculator['iof'] = 0;
                $insuranceCalculator['total'] = 0;
                $insuranceCalculator['origin'] = $estimated_safe;
            }

            $insuranceCalculator['uuid'] = $requestFormSafe['requested_id'];
            DB::commit();
            return [
                'data' => $insuranceCalculator,
                'code' => 200,
                'message' => 'Formulário preenchido com sucesso'
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('[WelcomeForm][updateOrCreate]' . '::create => ' . $exception->getMessage());
            return [
                'data' => array(),
                'message' => 'Por favor, tente novamente.',
                'code' => $exception->getCode(),
            ];
        }
    }

    public function update($request, $id = null)
    {
        try {
            $this->formDB->findOrFail($id)->update($request);

            return [
                'data' => $this->formDB,
                'message' => 'Atualizado com sucesso',
                'code' => 200
            ];
        }catch (\Exception $exception) {
            return [
                'data' => $this->formDB,
                'message' => 'Falha ao atualizar',
                'code' => $exception->getCode(),
            ];
        }
    }

    public function delete($id)
    {
        try {
            $this->formDB = $this->formDB->findOrFail($id);

            $this->formDB->address()->detach($this->formDB->address->first()->id);
            $this->formDB = $this->formDB->delete();

            return [
                'data' => $this->formDB,
                'message' => 'Deletado com sucesso',
                'code' => 200
            ];
        } catch (\Exception $exception) {
            Log::error('[WelcomeRepository][delete]' . '::delete => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => 'Falha ao deletar registro.',
                'code' => $exception->getCode(),
            ];
        }
    }

    public function getOccurrence($idSafe)
    {
        try {
            $this->occurrences = $this->occurrences
                ->where('form_safe_id',$idSafe)
                ->orderBy('id', 'ASC')
                ->get()->toArray();

            return [
                'data' => $this->occurrences,
                'message' => 'Comentario registrado com sucesso',
                'code' => 200
            ];
        }catch (\Exception $exception) {
            return [
                'data' => [],
                'message' => 'Falha ao registrar comentario',
                'code' => $exception->getCode()
            ];
        }
    }

    public function storeOccurrence($request)
    {
        try {
            $this->occurrences->create([
                'form_safe_id' => $request['idSafe'],
                'message' => $request['message'],
                'status_safe_id' => $request['idStatusSafe'],
            ]);

            return [
                'data' => $this->formDB,
                'message' => 'Comentario registrado com sucesso',
                'code' => 200
            ];
        }catch (\Exception $exception) {
            Log::error('[WelcomeRepository][storeOccurrence] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => 'Falha ao guardar ocorrencia.',
                'code' => $exception->getCode(),
            ];
        }
    }

    public function storePartner($request, $id = null)
    {
        Validator::validate($request,[
            'name' => 'required',
            'status' => 'required',
        ]);

        try {
            $request['slug'] = Str::slug($request['name'], '-');

            Partner::query()->updateOrCreate([
                'id' => $id
            ],$request);

            return [
                'data' => $this->formDB,
                'message' => 'Parceiro registrado com sucesso',
                'code' => 200
            ];
        }catch(\Exception $exception){
            Log::error('[WelcomeRepository][storePartner] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => 'Falha ao guardar parceiro.',
                'code' => $exception->getCode(),
            ];
        }
    }
}
