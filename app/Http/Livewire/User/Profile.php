<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Profile extends Component
{
    //model
    public $nama;
    public $password;
    public $password_confirmation;
    public $id_user;

    protected $rules = [
        'nama' => 'required',
        'password' => 'required|min:8|confirmed'
    ];
    public function render()
    {
        return view('livewire.user.profile');
    }

    public function mount()
    {
        $this->nama = auth()->user()->name;
        $this->id_user = auth()->user()->id;
    }

    public function ganti_nama()
    {
        $this->validate(['nama' => 'required']);
        try {
            User::find($this->id_user)->update(['name' => $this->nama]);
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Ganti Nama']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
    }

    public function ganti_password()
    {
        $this->validate(['password' => 'required|min:8|confirmed']);
        try {
            User::find(auth()->user()->id)->update(['password' => bcrypt($this->password)]);
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Ganti Password']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
        $this->reset('password', 'password_confirmation');
    }
}
