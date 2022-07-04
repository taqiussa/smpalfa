<?php

namespace App\Http\Livewire\Guru\Skor;

use App\Models\Kelas;
use App\Models\PenilaianSkor;
use App\Models\Skor;
use App\Traits\GetData;
use Livewire\Component;

class InputSkor extends Component
{
    use GetData;

    //model
    public $tanggal;
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $skor;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_skor = [];
    public $list_nilai_skor = [];
    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'skor' => 'required'
    ];

    public function render()
    {
        $this->list_nilai_skor = PenilaianSkor::with('skors')
            ->join('users as siswa', 'siswa.nis', '=', 'penilaian_skors.nis')
            ->join('users as guru', 'guru.id', '=', 'penilaian_skors.user_id')
            ->select(
                'siswa.name as nama_siswa',
                'guru.name as nama_guru',
                'penilaian_skors.tanggal as tanggal',
                'penilaian_skors.kelas_id as kelas_id',
                'penilaian_skors.skor_id as skor_id',
                'penilaian_skors.skor as skor',
                'penilaian_skors.created_at as created_at'
            )
            ->orderBy('created_at', 'desc')->take(10)->get();
        return view('livewire.guru.skor.input-skor');
    }

    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->list_kelas = Kelas::get();
        $this->get_tahun();
        $this->get_semester();
        $this->list_skor = Skor::orderBy('keterangan')->get();
    }
    public function hydrate()
    {
        $this->get_list_siswa();
    }
    public function simpan()
    {
        $this->validate();
        $skors = Skor::find($this->skor);
        PenilaianSkor::create(
            [
                'tanggal' => $this->tanggal,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kelas_id' => $this->kelas,
                'user_id' => auth()->user()->id,
                'nis' => $this->siswa,
                'skor_id' => $this->skor,
                'skor' => $skors->skor,
            ]
        );
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Menyimpan Skor Siswa'
            ]
        );
    }
    public function updatedKelas()
    {
        $this->get_list_siswa();
    }
    public function updatedTahun()
    {
        $this->get_list_siswa();
    }
}
