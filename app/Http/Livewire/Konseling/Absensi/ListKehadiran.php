<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Kehadiran;
use Livewire\Component;

class ListKehadiran extends Component
{
    //model
    public $tanggal;
    public $jam;
    public $kehadiran;
    public $total;
    //array
    public $list_kehadiran = [];
    public function render()
    {
        $this->hitung();
        return view('livewire.konseling.absensi.list-kehadiran');
    }

    public function mount($tanggal, $jam, $kehadiran)
    {
        $this->tanggal = $tanggal;
        $this->jam = $jam;
        $this->kehadiran = $kehadiran;
        $this->list_kehadiran = Kehadiran::where('nama', '!=', 'Hadir')->get();
    }
    
    private function hitung()
    {
        $kehadiran = Kehadiran::where('nama', $this->kehadiran)->first()->id;
        $this->total = Absensi::where([
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'kehadiran_id' => $kehadiran
        ])
        ->join('users', 'users.nis', '=' , 'absensis.nis')
        ->join('kelas', 'kelas.id', '=', 'absensis.kelas_id')
        ->get();
    }
}
