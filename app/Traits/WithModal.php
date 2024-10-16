<?php

namespace App\Traits;

trait WithModal
{
    public function openModal($component = null, $params = [])
    {
        $this->emit('openModal', $component,$params);
    }

    public function closeModal($modal = null)
    {
        $this->emit('closeModal', $modal);
    }
}
