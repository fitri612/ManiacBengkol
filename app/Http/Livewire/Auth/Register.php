<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class Register extends Component
{
    public $name, $email ,$password, $password_confirmation;
    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }

    public function rules()
    {
        # code...
        return[
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.min' => 'Nama harus memiliki setidaknya :min karakter.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password harus memiliki setidaknya :min karakter.',
        ];
    }

    public function regisUser()
    {
        # code...
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user,true);
        // event(new Registered($user));
        return redirect()->to(RouteServiceProvider::HOME);
    }
}
