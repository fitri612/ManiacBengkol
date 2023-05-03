<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class PasswordReset extends Component
{
    public function render()
    {
        return view('livewire.auth.password-reset')->extends('layouts.app')->section('content');
    }
}
