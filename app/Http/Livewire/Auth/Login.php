<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';

    protected $rules = [
        'username' => 'required',
        'password' => 'required|min:8'
    ];
    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.login');
    }

    public function proses_login()
    {
        $this->validate();
        if (is_numeric($this->username)) {
            $field = 'nis';
        } else {
            $field = 'username';
        }
        if (!Auth::attempt([$field => $this->username, 'password' => $this->password])) {
            $this->addError('username', 'Username / Password Salah. Silahkan Ulangi');
            return;
        }
        return redirect()->intended(route('home'));
    }
}
