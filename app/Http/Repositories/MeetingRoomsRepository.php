<?php

namespace App\Http\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Models\MeetingRooms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MeetingRoomsRepository
{
    /**
     * @var Builder
     */
    private \Illuminate\Database\Eloquent\Builder $userDB;

    public function __construct()
    {
       $this->model = MeetingRooms::query();
    }

    /**
     * @param array $filters
     * @param $limit
     * @return array
     */
    public function index(array $filters = [], $limit = 10) : array
    {
        try {
            $query = $this->model;

            // Aplicar dinamicamente os filtros à consulta
            foreach ($filters as $key => $value) {
                if ($key && $value) {
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }

            $data = $query->paginate($limit);

            return [
                'data' => $data,
                'message' => Helper::msgMethod('INDEX_SUCCESS'),
                'code' => 200
            ];
        }catch(\Exception $exception) {
            Log::error('[MeetingRoomsRepository][index] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => Helper::msgMethod('INDEX_FAIL'),
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function find($id) : array
    {
        try {
            $data = $this->model->findOrFail($id)->toArray();

            return [
                'data' => $data,
                'message' => Helper::msgMethod('FIND_SUCCESS'),
                'code' => 200,
            ];
        } catch (ModelNotFoundException $exception) {
            Log::error('[MeetingRoomsRepository][find] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => Helper::msgMethod('FIND_FAIL'),
                'code' => $exception->getCode() ?: 500
            ];
        }catch (\Exception $exception) {
            Log::error('[MeetingRoomsRepository][find] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => Helper::msgMethod('FIND_FAIL'),
                'code' => $exception->getCode() ?: 500,
            ];
        }
    }

    /**
     * @throws ValidationException
     */
    public function updateOrCreate($request, $id = null) : array
    {
        $userRequest = new UserRequest;
        $validatedData = $userRequest->validation($request, $id);

        DB::beginTransaction();
        try {
            $data = $this->model->updateOrCreate(
                ['id' => $id],
                $validatedData
            );

            if (isset($request['permission'])) {
                $data->syncRoles($request['permission']);
            }

            DB::commit();

            return [
                'data' => $data,
                'message' => Helper::msgMethod('CREATE_UPDATE_SUCCESS'),
                'code' => 200
            ];
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error('MeetingRoomsRepository][updateOrCreate] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => Helper::msgMethod('CREATE_UPDATE_FAIL'),
                'code' => $exception->getCode() ?: 500,
            ];
        }
    }

    public function delete($id) : array
    {
        DB::beginTransaction();
        try {
            $data = $this->model->findOrFail($id);
            $data->delete();

            DB::commit();
            return [
                'data' => [],
                'message' => Helper::msgMethod('DELETE_SUCCESS'),
                'code' => 200
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('[MeetingRoomsRepository][delete] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' =>  Helper::msgMethod('DELETE_FAIL'),
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

}
