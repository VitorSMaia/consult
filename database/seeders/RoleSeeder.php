<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $roleDB = Role::query()->updateOrCreate([
                'id' => 1
            ], [
                'name' => 'Super Admin',
                'company_id' => 1,
                'guard_name' => 'web'
            ]);

            $userDB = User::query()->find(1);

            if(!$userDB->hasRole('Super Admin')) {
                $userDB->assignRole('Super Admin');
            }

            $PermissionDB = Permission::query()->get();
            foreach ($PermissionDB as $itemPermission) {
                $roleDB->givePermissionTo($itemPermission->name);
            }

        }catch (\Exception $exception) {
            dd($exception);
        }
    }
}
