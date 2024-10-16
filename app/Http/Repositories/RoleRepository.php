<?php
namespace App\Http\Repositories;

use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RoleRepository
{
    protected $roleDB;

    // Definindo as constantes para mensagens de retorno
    const MESSAGE_SUCCESS_LIST = 'Listagem com sucesso!';
    const MESSAGE_ERROR_LIST = 'Listagem com falha!';
    const MESSAGE_SUCCESS_FIND = 'Busca de grupo de permissão concluída!';
    const MESSAGE_ERROR_FIND = 'Falha ao buscar grupo de permissão!';
    const MESSAGE_SUCCESS_CREATE = 'Grupo de permissão criado com sucesso!';
    const MESSAGE_SUCCESS_UPDATE = 'Grupo de permissão editado com sucesso!';
    const MESSAGE_ERROR_CREATE_UPDATE = 'Falha ao criar ou editar Grupo de permissão!';
    const MESSAGE_SUCCESS_DELETE = 'Grupo de permissão deletado com sucesso!';
    const MESSAGE_ERROR_DELETE = 'Falha ao deletar Grupo de permissão!';
    const MESSAGE_CANNOT_DELETE = 'Grupo de permissão não pode ser deletado.';
    const MESSAGE_SUCCESS_SYNC = 'Permissões atualizadas com sucesso!';
    const MESSAGE_ERROR_SYNC = 'Falha ao atualizar permissões!';

    /**
     *
     */
    public function __construct()
    {
        $this->roleDB = Role::query();
    }

    /**
     * @param $name
     * @return array
     */
    public function index($name = null) : array
    {
        try {
            $query = $this->roleDB->newQuery();

            if ($name) {
                $query->where('name', 'like', "%$name%");
            }

            $roles = $query->paginate(7);

            return [
                'data' => $roles,
                'message' => self::MESSAGE_SUCCESS_LIST,
                'code' => 200
            ];
        } catch (\Exception $exception) {
            Log::error('[RoleRepository][index] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_LIST,
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
            $role = $this->roleDB->findOrFail($id)->toArray();

            return [
                'data' => $role,
                'code' => 200,
                'message' => self::MESSAGE_SUCCESS_FIND
            ];
        } catch (ModelNotFoundException $exception) {
            Log::warning('[RoleRepository][find] => Role not found with ID: ' . $id);

            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_FIND,
                'code' => 404,
            ];
        } catch (\Exception $exception) {
            Log::error('[RoleRepository][find] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_FIND,
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

    /**
     * @param array $request
     * @param $id
     * @return array
     */
    public function updateOrCreate(array $request, $id = null) : array
    {
        $permissionRequest = new PermissionRequest();
        $validatedData = $permissionRequest->validation($request, $id);

        DB::beginTransaction();
        try {
            $role = $this->roleDB->updateOrCreate(
                ['id' => $id],
                array_merge($validatedData, ['guard_name' => 'web'])
            );

            $message = $id ? self::MESSAGE_SUCCESS_UPDATE : self::MESSAGE_SUCCESS_CREATE;

            DB::commit();
            return [
                'data' => $role,
                'code' => 200,
                'message' => $message
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('[RoleRepository][updateOrCreate] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_CREATE_UPDATE,
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id) : array
    {
        DB::beginTransaction();
        try {
            $role = $this->roleDB->findOrFail($id);

            if ($role->name == Auth::user()->getRoleNames()->first()) {
                return [
                    'data' => [],
                    'message' => self::MESSAGE_CANNOT_DELETE,
                    'code' => 301
                ];
            }

            $role->delete();

            DB::commit();
            return [
                'data' => $role,
                'message' => self::MESSAGE_SUCCESS_DELETE,
                'code' => 200
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('[RoleRepository][delete] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_DELETE,
                'code' => $exception->getCode() ?: 500
            ];
        }
    }

    /**
     * @param $id
     * @param array $keys
     * @return array
     */
    public function sync($id, array $keys) : array
    {
        DB::beginTransaction();
        try {
            $keys = array_keys(array_filter($keys));

            $role = $this->roleDB->findOrFail($id);
            $role->syncPermissions($keys);

            DB::commit();
            return [
                'data' => $role,
                'message' => self::MESSAGE_SUCCESS_SYNC,
                'code' => 200
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('[RoleRepository][sync] => ' . $exception->getMessage());
            return [
                'data' => [],
                'message' => self::MESSAGE_ERROR_SYNC,
                'code' => $exception->getCode() ?: 500
            ];
        }
    }
}
