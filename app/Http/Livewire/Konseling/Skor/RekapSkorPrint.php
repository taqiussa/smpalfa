<?php

namespace App\Http\Livewire\Konseling\Skor;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class RekapSkorPrint extends Component
{
    use GetData;

    //model
    public $tahun;
    public $kelas;
    
    //array
    public $list_kelas = [];
    public $list_siswa = [];


    public function render()
    {
        return view('livewire.konseling.skor.rekap-skor-print');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }

    public function hydrate()
    {
        $this->get_list_siswa();
    }
    public function updatedTahun()
    {
        $this->get_list_siswa();
    }
    public function updatedKelas()
    {
        $this->get_list_siswa();
    }
}
