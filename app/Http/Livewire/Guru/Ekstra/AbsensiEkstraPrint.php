<?php

namespace App\Http\Livewire\Guru\Ekstra;

use App\Models\Ekstrakurikuler;
use App\Models\User;
use App\Traits\GetData;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class AbsensiEkstraPrint extends Component
{
    use GetData;

    //model 
    public $tanggal;
    public $tahun;
    public $semester;
    public $ekstrakurikuler;
    public $nama_ekstra;

    //array
    public $list_ekstra = [];
    public $list_absensi_ekstra = [];

    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'ekstrakurikuler' => 'required',
    ];
    public function render()
    {
        $this->list_absensi_ekstra = $this->cek_absen_ekstra();
        return view('livewire.guru.ekstra.absensi-ekstra-print');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->tanggal = gmdate('Y-m-d');
        $this->list_ekstra = Ekstrakurikuler::get();
    }

    public function updated($property)
    {
        $this->list_absensi_ekstra = [];
        $this->list_absensi_ekstra = $this->cek_absen_ekstra();
    }
    public function download()
    {
        $this->validate();
        $this->nama_ekstra = Ekstrakurikuler::find($this->ekstrakurikuler)->nama;
        $data = [
            'tanggal' => $this->tanggal,
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'nama_ekstra' => $this->nama_ekstra,
            'list_absensi' => $this->cek_absen_ekstra(),
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
        ];
        $pdf = Pdf::loadView('ekstra.pdf', $data)->setPaper(array(0, 0, 595.276, 935.433))->download();
        return response()->streamDownload(
            fn () => print($pdf),
            'Rekap Absensi ' . $this->nama_ekstra . '.pdf'
        );
    }
}
