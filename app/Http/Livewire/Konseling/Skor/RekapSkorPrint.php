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
    public $idkelas;

    //array
    public $list_kelas = [];
    public $list_siswa = [];


    public function render()
    {
        $this->list_kelas = Kelas::get();
        $this->idkelas = $this->kelas;
        return view('livewire.konseling.skor.rekap-skor-print');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    
    public function updated($property)
    {
        $this->list_kelas = Kelas::get();
        $this->get_list_siswa();
    }
}
