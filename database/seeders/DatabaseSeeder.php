<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $company = \App\Models\Company::query()->updateOrCreate([
            'name' => 'DevTech',
        ],[
            'status' => 'Ativo',
            'cpf_cnpj' => '06972728347',
        ]);

         \App\Models\User::query()->updateOrCreate([
             'name' => 'Admin',
         ],[
            'company_id' => $company->id,
            'cpf_cnpj' => '06972728347',
            'phone' => '11913564982',
            'office' => 'Developer',
            'password' => '!QAZJv1234',
            'email' => 'vitor.smaia@gmail.com',
            'status' => 'Ativo',
         ]);


        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
