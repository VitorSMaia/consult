<?php

namespace App\Library;

use App\Events\ActiveUser;
use App\Mail\SendActiveUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function authGoogle($data)
    {
        $user = new User;
        $userFound = $user->where('email', $data->email)->first();
        if (!$userFound) {
            $user->create([
                'full_name' => $data->givenName. ' ' . $data->familyName,
                'email' => $data->email,
                'status' => 'Ativo',
                'password' => $data->email.'Inativo'.$data->givenName.''.$data->familyName,
            ]);
//            Auth::loginUsingId($user->id);
            ActiveUser::dispatch($user);
            return redirect()->to('/');
        }
        Auth::login($userFound, true);

        session()->put('auth', true);

        return redirect()->route('dashboard');
    }

    public function auth()
    {
    }

    public function logout()
    {
        unset($_SESSION['user'], $_SESSION['auth']);
        header('Location:/');
    }
}