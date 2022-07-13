<?php

namespace App\Http\Livewire\Guru\Alquran;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class PrintNilai extends Component
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
        return view('livewire.guru.alquran.print-nilai');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }

    public function updated($property)
    {
        $this->get_list_siswa();
        $this->idkelas = $this->kelas;
    }
}
