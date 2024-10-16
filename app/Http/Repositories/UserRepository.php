<?php

namespace App\Http\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserRepository
{
    /**
     * @var Builder
     */
    private \Illuminate\Database\Eloquent\Builder $userDB;

    public function __construct()
    {
       $this->userDB = User::query();
    }

    /**
     * @param array $filters
     * @param $limit
     * @return array
     */
    public function index(array $filters = [], $limit = 10) : array
    {
        try {
            $query = $this->userDB;

            // Aplicar dinamicamente os filtros à consulta
            foreach ($filters as $key => $value) {
                if ($key && $value) {
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }

            $users = $query->paginate($limit);

            return [
                'data' => $users,
                'message' => User::USER_REPOSITORY_INDEX_SUCCESS,
                'code' => 200
            ];
        }catch(\Exception $exception) {
            Log::error('[UserRepository][index] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => User::USER_REPOSITORY_INDEX_FAIL,
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
            $user = $this->userDB->findOrFail($id)->toArray();

            return [
                'data' => $user,
                'code' => 200,
                'message' => User::USER_REPOSITORY_FIND_SUCCESS
            ];
        } catch (ModelNotFoundException $exception) {
            Log::warning('[UserRepository][find] => User not found with ID: ' . $id);

            return [
                'data' => [],
                'message' => User::USER_REPOSITORY_FIND_FAIL,
                'code' => 404,
            ];
        }catch (\Exception $exception) {
            Log::error('[UserRepository][find] => ' . $exception->getMessage());

            return [
                'data' => [],
                'message' => User::USER_REPOSITORY_FIND_FAIL,
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
            $user = $this->userDB->updateOrCreate(
                ['id' => $id],
                $validatedData
            );

            if (isset($request['permission'])) {
                $user->syncRoles($request['permission']);
            }

            DB::commit();

            return [
                'data' => $user,
                'code' => 200,
                'message' => $id ? User::USER_REPOSITORY_UPDATE_SUCCESS : User::USER_REPOSITORY_CREATE_SUCCESS
            ];
        } catch(\Exception $exception) {
            DB::rollBack();

            Log::error('UserRepository][updateOrCreate] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' =>  User::USER_REPOSITORY_CREATE_UPDATE_FAIL,
                'code' => $exception->getCode() ?: 500,
            ];
        }
    }

    public function delete($id) : array
    {
        DB::beginTransaction();
        try {
            $authenticatedUserId = Auth::id();

            if ($authenticatedUserId && $authenticatedUserId == $id) {
                return [
                    'data' => [],
                    'message' => User::USER_REPOSITORY_DELETE_FAIL_YOURSELF,
                    'code' => 204
                ];
            }

            $user = $this->userDB->findOrFail($id);
            $user->delete();

            DB::commit();
            return [
                'data' => [],
                'message' => User::USER_REPOSITORY_DELETE_SUCCESS,
                'code' => 200
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('[UserRepository][delete] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' =>  User::USER_REPOSITORY_DELETE_FAIL,
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

    public function profileUpdate(array $request): array
    {
        DB::beginTransaction();

        $userRequest = new UserRequest;
        $validatedData = $userRequest->validation($request, $request['id']);

        try{
            $user_id = Auth::user()->id;
            $user = $this->userDB->findOrFail($user_id);
            $user->update($validatedData);

            DB::commit();

            return [
                'data' => [],
                'message' => User::USER_REPOSITORY_UPDATE_SUCCESS,
                'code' => 200,
            ];
        }catch (\Exception $exception){

            DB::rollBack();

            Log::error('[UserRepository][profileUpdate] =>' . $exception->getMessage());
            return [
                'data' => [],
                'message' =>  User::USER_REPOSITORY_CREATE_UPDATE_FAIL,
                'code' => $exception->getCode() ?: 500,
            ];
        }
    }

    public function messageFromWebpage(string $message, User $user)
    {
        $user->messages()->created([
            'message' => $message
        ]);
    }

    public function sendContactForm(array $request): array
    {
        DB::beginTransaction();
        $message = $request['message'];
        try{
            dd($request);
            $userRequest = new UserRequest;
            $validatedData = $userRequest->validation($request, $request['id']);

            $user = $this->userDB->updateOrCreate($validatedData, $validatedData);
            $user = $this->messageFromWebpage($message, $user);

            DB::commit();

            return [
                'data' => $user,
                'message' => User::USER_REPOSITORY_UPDATE_SUCCESS,
                'code' => 200,
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            Log::error('[UserRepository][profileUpdate] =>' . $exception->getMessage());
            return [
                'data' => [],
                'message' =>  User::USER_REPOSITORY_CREATE_UPDATE_FAIL,
                'code' => $exception->getCode() ?: 500,
            ];
        }
    }
}
