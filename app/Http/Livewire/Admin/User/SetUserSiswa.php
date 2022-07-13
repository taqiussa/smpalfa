<?php

namespace App\Http\Livewire\Admin\User;

use App\Jobs\SetUserAsSiswaJob;
use Livewire\Component;

class SetUserSiswa extends Component
{
    public function render()
    {
        return view('livewire.admin.user.set-user-siswa');
    }

    public function setuser()
    {
        set_time_limit(0);
        SetUserAsSiswaJob::dispatch();
        $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'Berhasil']);
    }
}
