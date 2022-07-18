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
    }

    public function simpan()
    {
        $this->validate();
        try {
            User::find(auth()->user()->id)->update(['password' => bcrypt($this->password)]);
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Update Profile']);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
    }
}
