<?php

namespace App\Http\Livewire\Bendahara;

use App\Models\Gunabayar;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Traits\GetData;
use Livewire\Component;

class TagihanSiswa extends Component
{
    use GetData;

    // model
    public $tahun;
    public $kelas;
    public $id_kelas;

    // array
    public $list_gunabayar = [];
    public $list_siswa = [];
    public $list_kelas = [];

    public function render()
    {
        return view('livewire.bendahara.tagihan-siswa');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->list_gunabayar = Gunabayar::orderBy('semester')->get();
    }
    
    public function hydrate()
    {
        $this->get_list_siswa();
        $this->id_kelas = $this->kelas;
    }
    public function updated($property)
    {
        $this->get_list_siswa();
        $this->id_kelas = $this->kelas;
    }

}
