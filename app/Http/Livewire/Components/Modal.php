<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Modal extends Component
{
    protected $listeners = [
        'openModal',
        'closeModal' => 'updateModalVisible',
        'updateModalVisible'
    ];

    public $component;
    public $params = [
        'title' => ''
    ];
    public $isModalVisible = false;

    public function openModal($component = null, $params = [])
    {
        $this->isModalVisible = true;
        $this->component = $component;
        $this->params = $params;
    }

    public function updateModalVisible($type = null) : void
    {
        if($type) {
            $this->$type = !$this->$type;
        }
        $this->reset();
    }

    public function render()
    {
        return view('livewire.components.modal');
    }
}
