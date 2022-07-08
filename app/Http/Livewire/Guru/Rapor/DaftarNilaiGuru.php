<?php

namespace App\Http\Livewire\Guru\Rapor;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class DaftarNilaiGuru extends Component
{
    use GetData;

    //model
    public $tahun;
    public $kelas;
    public $wali_kelas;
    public $mata_pelajaran;
    public $semester;

    //array
    public $list_siswa = [];
    public $list_kelas = [];
    public $list_mata_pelajaran = [];

    public function render()
    {
        return view('livewire.guru.rapor.daftar-nilai-guru');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->list_kelas = Kelas::get();
        $this->list_mata_pelajaran = $this->cek_mata_pelajaran();
    }
    
}
