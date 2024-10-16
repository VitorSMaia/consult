<?php

namespace App\Http\Livewire\Auth;

use App\Models\Company;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $company = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
            'company' => ['required'],
        ]);

        $CompanyDB = Company::query()->create([
            'name' => $this->company,
            'cpf_cnpj' => '06972728347'
        ]);

        $user = User::create([
            'company_id' => 1,
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'cpf_cnpj' => '06972728347',
            'office' => 'Dev'
        ]);

        $user->syncRoles([1]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
