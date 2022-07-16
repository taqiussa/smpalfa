<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Absensi;
use Livewire\Component;

class Kehadiran extends Component
{

    // model
    public $tanggalawal;
    public $tanggalakhir;

    // array
    public $list_kehadiran = [];
    public $jam = ['1-2', '3-4', '5-6', '7-8'];
    public $cek_kehadiran = [];
    public function render()
    {
        // foreach($this->jam as $jam)
        // {
            $this->list_kehadiran = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', auth()->user()->nis)
            ->with('kehadiran')
            ->orderBy('tanggal')
            ->get();
        // }
        return view('livewire.siswa.kehadiran');
    }

    public function mount()
    {
        $this->tanggalawal = gmdate('Y-m-d');
        $this->tanggalakhir = gmdate('Y-m-d');
    }
}
