<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;

class CekListAbsensi extends Component
{
    use GetData;

    // model
    public $tahun;
    public $tanggal;
    
    // array
    public $list_kelas = [];
    public $list_check = [];
    public function render()
    {
        return view('livewire.konseling.absensi.cek-list-absensi');
    }
    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
        $this->cek_absensi();
    }
    public function updated($property)
    {
        $this->cek_absensi();
    }
    public function cek_absensi()
    {
        foreach($this->list_kelas as $key => $kelas)
        {
            $this->list_check[$key] = 
            [
                '1-2' => Absensi::where('jam', '1-2')
                ->where('tanggal', $this->tanggal)
                ->where('kelas_id', $kelas->id)
                ->where('tahun', $this->tahun)
                ->get(),
                '3-4' => Absensi::where('jam', '3-4')
                ->where('tanggal', $this->tanggal)
                ->where('kelas_id', $kelas->id)
                ->where('tahun', $this->tahun)
                ->get(),
                '5-6' => Absensi::where('jam', '5-6')
                ->where('tanggal', $this->tanggal)
                ->where('kelas_id', $kelas->id)
                ->where('tahun', $this->tahun)
                ->get(),
                '7-8' => Absensi::where('jam', '7-8')
                ->where('tanggal', $this->tanggal)
                ->where('kelas_id', $kelas->id)
                ->where('tahun', $this->tahun)
                ->get(),

            ];
        }
    }
}
