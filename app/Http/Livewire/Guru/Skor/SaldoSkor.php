<?php

namespace App\Http\Livewire\Guru\Skor;

use App\Models\Kelas;
use App\Models\PenilaianSkor;
use App\Models\Siswa;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class SaldoSkor extends Component
{
    //model 
    public $tahun;
    public $kelas;
    
    //array
    public $list_siswa = [];
    public $list_kelas = [];
    public $total_skor = [];

    public function render()
    {
        return view('livewire.guru.skor.saldo-skor');
    }

    public function mount()
    {
        $this->list_kelas = Kelas::get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }
    public function hydrate()
    {
        $this->get_list_siswa();
        $this->get_saldo_skor();
    }
    public function updated($property)
    {
        $this->get_list_siswa();
        $this->get_saldo_skor();
    }
    private function get_list_siswa()
    {
        $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get();
    }
    private function get_saldo_skor()
    {
        foreach($this->list_siswa as $key => $siswa)
        {
            $skor = PenilaianSkor::where('tahun', $this->tahun)
            ->where('nis', $siswa->nis)
            ->sum('skor');
            $this->total_skor[$key] = $skor;
        }
    }
}
