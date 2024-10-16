<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Traits\WithModal;

class Button extends Component
{
    use WithModal;

    public $text = '';

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.components.button');
    }
}
