<?php

namespace App\Http\Livewire\Components;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Contact extends Component
{

    public array $state = [
        'name' => '',
    ];

//    private UserRepository $userRepository;

//    public function __construct($id = null)
//    {
//        parent::__construct($id);
//        $this->userRepository = new UserRepository();
//    }

    public function mount()
    {

    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function save(): void
    {
        dd('asd');
//        $request = $this->state;
//        $userRepositoryReturn = $this->userRepository->sendContactForm($request);
//
//        $this->emit('updatedTableUser');
    }

    public function render()
    {
        return view('livewire.components.contact');
    }
}
