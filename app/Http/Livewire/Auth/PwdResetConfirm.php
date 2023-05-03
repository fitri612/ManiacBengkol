<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class PwdResetConfirm extends Component
{
    public $token;

    public function mount($token)
    {
        $this->token = $token;
    }
    public function render()
    {
        return view('livewire.auth.pwd-reset-confirm')->extends('layouts.app')->section('content');
    }
}
