<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $showToast = false;
    public $message = '';

    public $color = 'bg-[#FDC14A]';

    public $listeners = ['openToast'];

    public function openToast($message, $code = 200)
    {
        if($code != 200) {
            $this->color = 'bg-red-500';
        }else {
            $this->color = 'bg-[#FDC14A]';
        }
        $this->message = $message;
        $this->showToast = true;
    }

    public function render()
    {
        return view('livewire.components.toast');
    }
}
