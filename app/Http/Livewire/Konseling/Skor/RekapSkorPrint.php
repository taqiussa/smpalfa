<?php

namespace App\Http\Livewire\Konseling\Skor;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapSkorPrint extends Component
{
    use GetData;

    //model
    public $tahun;
    public $kelas;
    public $idkelas;
    public $kesiswaan;
    public $kepala_sekolah;

    //array
    public $list_kelas = [];
    public $list_siswa = [];


    public function render()
    {
        $this->list_kelas = Kelas::get();
        $this->idkelas = $this->kelas;
        $this->kepala_sekolah = User::role('Kepala Sekolah')->get();
        $this->kesiswaan = User::role('Kesiswaan')->get();
        $this->get_list_siswa();
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

    public function downloadperkelas()
    {
        $data = [
            'tahun' => $this->tahun,
            'nama_kelas' => Kelas::find($this->kelas)->nama,
            'list_siswa' => Siswa::join('users', 'siswas.nis', '=', 'users.nis')
                ->where('siswas.kelas_id', $this->kelas)
                ->where('siswas.tahun', $this->tahun)
                ->select(
                    'users.name as name',
                    'siswas.nis as nis',
                )
                ->orderBy('users.name')
                ->get(),
            'kesiswaan' => $this->kesiswaan,
            'kepala_sekolah' => $this->kepala_sekolah,
        ];
        $pdf = Pdf::loadView('skor.rekap-skor-perkelas-pdf', $data)->setPaper(array(0, 0, 595.276, 935.433))->download();
        return response()->streamDownload(
            fn () => print($pdf),
            'Laporan Skor ' . $data['nama_kelas'] . '.pdf'
        );
    }
}
