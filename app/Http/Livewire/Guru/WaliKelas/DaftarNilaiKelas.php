<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Traits\GetData;
use Livewire\Component;

class DaftarNilaiKelas extends Component
{
    use GetData;

    
    public function render()
    {
        return view('livewire.guru.wali-kelas.daftar-nilai-kelas');
    }
}
