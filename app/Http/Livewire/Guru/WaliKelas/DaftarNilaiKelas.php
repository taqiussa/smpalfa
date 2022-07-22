<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class DaftarNilaiKelas extends Component
{
    use GetData;

    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $kelas_wali;
    public $id_kelas;

    //array
    public $list_kelas = [];
    
    public function render()
    {
        return view('livewire.guru.wali-kelas.daftar-nilai-kelas');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->list_kelas = Kelas::get();
        $this->get_wali_kelas();
        $this->id_kelas = $this->kelas;
    }
    
    public function updated($property)
    {
        $this->list_kelas = Kelas::get();
        $this->get_wali_kelas();
        $this->id_kelas = $this->kelas;

    }

}
