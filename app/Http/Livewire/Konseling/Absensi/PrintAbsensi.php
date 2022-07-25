<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class PrintAbsensi extends Component
{
    use GetData;

    // model
    public $tahun;
    public $semester;
    public $kelas;
    public $kelasharian;
    public $id_kelas;
    public $id_kelasharian;
    public $tanggalawal;
    public $tanggalakhir;
    
    // array
    public $list_kelas = [];
    public function render()
    {
        return view('livewire.konseling.absensi.print-absensi');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->list_kelas = Kelas::get();
        $this->tanggalawal = gmdate('Y-m-d');
        $this->tanggalakhir = gmdate('Y-m-d');
    }
    public function updated($property)
    {
        $this->id_kelas = $this->kelas;
        $this->id_kelasharian = $this->kelasharian;
    }
}
