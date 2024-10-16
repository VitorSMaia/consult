<?php

namespace App\Traits;

trait WithToast
{
    public function openToast($message, $code = 200)
    {
        $this->emit('openToast', $message, $code);
    }
}
