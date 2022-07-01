<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Models\Kelas;
use App\Models\Prestasi;
use App\Models\Siswa;
use Livewire\Component;

class InputPrestasi extends Component
{
    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $prestasi;
    public $keterangan;
    public $is_edit;

    //array
    public $list_siswa = [];
    public $list_kelas = [];
    public $list_prestasi = [];

    protected $listeners =
    [
        'delete' => 'delete'
    ];
    protected $rules =
    [
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'prestasi' => 'required',
        'keterangan' => 'required'
    ];

    public function render()
    {
        $this->get_list_siswa();
        $this->get_prestasi();
        return view('livewire.guru.penilaian.input-prestasi');
    }

    public function mount()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
            $this->semester = 2;
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
            $this->semester = 1;
        }
        $this->list_kelas = Kelas::get();
    }

    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {
            Prestasi::updateOrCreate(
                [
                    'nis' => $this->siswa,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'kelas_id' => $this->kelas
                ],
                [
                    'prestasi' => $this->prestasi,
                    'keterangan' => $this->keterangan
                ]
            );
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Prestasi'
                ]
            );
            $this->resetErrorBag();
            $this->resetExcept('tahun', 'semester', 'list_kelas', 'list_prestasi');
        } else {
            Prestasi::create([
                'nis' => $this->siswa,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kelas_id' => $this->kelas,
                'prestasi' => $this->prestasi,
                'keterangan' => $this->keterangan
            ]);

            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Prestasi'
                ]
            );
            $this->resetErrorBag();
            $this->resetExcept('tahun', 'semester', 'list_kelas', 'list_prestasi');
        }
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Hapus Data Prestasi',
                'text' => 'Anda Yakin Menghapus Data Prestasi ini ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        Prestasi::find($id)->delete();
        $this->dispatchBrowserEvent(
            'nofyt',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Data Prestasi'
            ]
        );
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $cari = Prestasi::find($id);
        $this->tahun = $cari->tahun;
        $this->semester = $cari->semester;
        $this->kelas = $cari->kelas_id;
        $this->siswa = $cari->nis;
        $this->prestasi = $cari->prestasi;
        $this->keterangan = $cari->keterangan;
    }
    public function batal()
    {
        $this->resetErrorBag();
        $this->resetExcept('tahun', 'semester', 'list_kelas', 'list_prestasi');
    }
    private function get_list_siswa()
    {
        $this->list_siswa = [];
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

    private function get_prestasi()
    {
        $this->list_prestasi = Prestasi::join('users', 'users.nis', '=', 'prestasis.nis')
            ->join('kelas', 'kelas.id', '=', 'prestasis.kelas_id')
            ->where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->select(
                'prestasis.id as id',
                'prestasis.prestasi as prestasi',
                'prestasis.keterangan as keterangan',
                'prestasis.tahun as tahun',
                'prestasis.semester as semester',
                'users.name as name',
                'kelas.nama as nama'
            )
            ->orderBy('kelas.nama')
            ->orderBy('users.name')
            ->get();
    }
}
