<?php

namespace App\Http\Livewire\Auth;

use App\Library\Authenticate;
use App\Library\GoogleClient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
//    /** @var string */
//    public $email = '';
//
//    /** @var string */
//    public $password = '';
//
//    /** @var bool */
//    public $remember = false;

    public $state = [];
    public $url_google = '';
    public $forgetPassword = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function mount()
    {
        $googleClient = new GoogleClient();
        $googleClient->init();

        if($googleClient->authenticated()){
            $auth = new Authenticate();
            return $auth->authGoogle($googleClient->getData());
        }

        $this->url_google = $googleClient->generateAuthLink();
    }

    public function authenticate() : void
    {
        $request = $this->validate([
            'state.email' => ['required', 'email'],
            'state.password' => ['required'],
            'state.remember' => ['sometimes'],
        ],[], [
            'state.email' => 'email',
            'state.password' => 'senha',
            'state.remember' => 'lembrar-me',
        ]);

        $request = $request['state'];

        $request['remember'] = isset($request['remember']) ? true : false;

        if(!User::query()->where('email', $request['email'])->where('status', 'Ativo')->first()) {
            $this->addError('email', trans('auth.failed'));
        }elseif (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $request['remember'])) {
            $this->addError('email', trans('auth.failed'));
        }else{
            session()->push('color', Auth::user()->color);
            redirect()->intended(route('dashboard'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
