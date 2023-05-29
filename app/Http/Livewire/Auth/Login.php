<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;

class Login extends Component
{
    public $email, $password, $remember;
    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.app')->section('content');
    }

    public function rules()
    {
        # code...
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',

        ];
    }

    public function loginUser()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', __('auth.failed'));
            return null;
        }

        $throttleKey = 'send-message:' . $user->id;

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));
            return null;
        }

        if (RateLimiter::remaining($throttleKey, 5)) {
            RateLimiter::hit($throttleKey);
        } else {
            $this->addError('email', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));
            return null;
        }

        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            $this->addError('email', __('auth.failed'));
            return null;
        }

        $user = Auth::user();

        if ($user->is_admin == 1) {
            return redirect()->to('/category');
        } else {
            return redirect()->to(RouteServiceProvider::HOME);
        }
    }
}
