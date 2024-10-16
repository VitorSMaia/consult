<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $group = [
                [
                    'name' => 'Dashboard',
                    'permission' => [
                        [
                            'name' => 'dashboard_view',
                            'label' => 'Visulizar'
                        ],
                    ]
                ],
                [
                    'name' => 'Config',
                    'permission' => [
                        [
                            'name' => 'config_view',
                            'label' => 'Visulizar'
                        ],
                        [
                            'name' => 'config_edit',
                            'label' => 'Editar'
                        ],
                    ]
                ],
                [
                    'name' =>'Sala de reunião',
                    'permission' => [
                        [
                            'name' => 'meeting_rooms_view',
                            'label' => 'Visulizar'
                        ],
                        [
                            'name' => 'meeting_rooms_create',
                            'label' => 'Cadastrar'
                        ],
                        [
                            'name' => 'meeting_rooms_edit',
                            'label' => 'Editar'
                        ],
                        [
                            'name' => 'meeting_rooms_delete',
                            'label' => 'Deletar'
                        ],
                    ]
                ],
                [
                    'name' =>'Disponibilidade',
                    'permission' => [
                        [
                            'name' => 'availability_view',
                            'label' => 'Visulizar'
                        ],
                        [
                            'name' => 'availability_create',
                            'label' => 'Cadastrar'
                        ],
                        [
                            'name' => 'availability_edit',
                            'label' => 'Editar'
                        ],
                        [
                            'name' => 'availability_delete',
                            'label' => 'Deletar'
                        ],
                    ]
                ],
                [
                    'name' => 'Permissões',
                    'permission' => [
                        [
                            'name' => 'role_view',
                            'label' => 'Visulizar'
                        ],
                        [
                            'name' => 'role_create',
                            'label' => 'Cadastrar'
                        ],
                        [
                            'name' => 'role_edit',
                            'label' => 'Editar'
                        ],
                        [
                            'name' => 'role_delete',
                            'label' => 'Deletar'
                        ],
                    ]
                ],
                [
                    'name' => 'Usuário',
                    'permission' => [
                        [
                            'name' => 'user_view',
                            'label' => 'Visulizar'
                        ],
                        [
                            'name' => 'user_create',
                            'label' => 'Cadastrar'
                        ],
                        [
                            'name' => 'user_edit',
                            'label' => 'Editar'
                        ],
                        [
                            'name' => 'user_delete',
                            'label' => 'Deletar'
                        ],
                    ]
                ],
            ];


            foreach ($group as $itemGroup) {
                $groupPermission = GroupPermission::query()->updateOrCreate([
                    'name' => $itemGroup['name']
                ]);
                foreach ($itemGroup['permission'] as $itemPermission) {
                    $PermissionDB = Permission::query()->updateOrCreate([
                        'name' => $itemPermission['name']
                    ],[
                        'group_permission_id' => $groupPermission->id,
                        'label' => $itemPermission['label'],
                        'name' => $itemPermission['name'],
                        'guard_name' => 'web'
                    ]);

                }
            }


            DB::commit();
        }catch (\Exception $exception) {

            Log::error($exception->getMessage());
            DB::rollBack();
        }
    }
}
