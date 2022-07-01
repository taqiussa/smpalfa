<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Models\Catatan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Livewire\Component;

class InputCatatan extends Component
{
    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $catatan;
    public $siswa;
    public $informasi;
    public $kelas_wali;
    public $is_edit = false;
    public $is_disabled;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_catatan = [];
    public $list_nis_siswa = [];

    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'siswa' => 'required',
        'catatan' => 'required',
        'kelas' => 'required'
    ];
    protected $messages = [
        '*.required' => 'Tidak Boleh Kosong'
    ];

    protected $listeners = ['delete' => 'delete'];

    public function render()
    {
        $this->list_kelas = Kelas::get();
        $this->get_wali();
        $this->get_catatan();
        $this->get_siswa();
        return view('livewire.guru.wali-kelas.input-catatan');
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
        $this->get_wali();
        $this->get_siswa();
    }
    public function updated($property)
    {
        $this->resetErrorBag();
        $this->list_kelas = Kelas::get();
        $this->get_wali();
        $this->get_catatan();
        $this->get_siswa();
    }
    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {
            Catatan::updateOrCreate(
                [
                    'nis' => $this->siswa,
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'kelas_id' => $this->kelas
                ],
                [
                    'catatan' => $this->catatan
                ]
            );
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Catatan'
                ]
            );
            $this->batal();
        } else {

            Catatan::create([
                'nis' => $this->siswa,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'catatan' => $this->catatan,
                'kelas_id' => $this->kelas
            ]);
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Catatan'
                ]
            );
            $this->siswa = '';
        }
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $cari = Catatan::find($id);
        $this->tahun = $cari->tahun;
        $this->semester = $cari->semester;
        $this->kelas = $cari->kelas_id;
        $this->siswa = $cari->nis;
        $this->catatan = $cari->catatan;
    }
    public function batal()
    {
        $this->is_edit = false;
        $this->is_disabled = '';
        $this->siswa = '';
        $this->catatan = '';
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Catatan Wali Kelas',
                'text' => 'Anda Yakin Menghapus Catatan ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        Catatan::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Catatan'
            ]
        );
    }
    private function get_siswa()
    {
        if ($this->is_edit) {
            $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
                ->where('siswas.kelas_id', $this->kelas)
                ->where('siswas.tahun', $this->tahun)
                ->select(
                    'users.name as name',
                    'siswas.nis as nis',
                )
                ->orderBy('users.name')
                ->get();
        } else {

            $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
                ->where('siswas.kelas_id', $this->kelas)
                ->where('siswas.tahun', $this->tahun)
                ->whereNotIn('siswas.nis', $this->list_nis_siswa)
                ->select(
                    'users.name as name',
                    'siswas.nis as nis',
                )
                ->orderBy('users.name')
                ->get();
        }
    }
    private function get_wali()
    {
        $this->kelas_wali = WaliKelas::where('tahun', $this->tahun)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (blank($this->kelas_wali)) {
            $this->informasi = 'Anda Bukan Wali Kelas pada tahun ' . $this->tahun;
            $this->kelas = '';
            $this->siswa = '';
            $this->list_siswa = [];
            $this->list_kelas = [];
        } else {
            $this->informasi = '';
            $this->kelas = $this->kelas_wali->kelas_id;
        }
    }
    private function get_catatan()
    {
        $this->list_catatan = Catatan::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kelas_id', $this->kelas)
            ->join('users', 'users.nis', '=', 'catatans.nis')
            ->select(
                'users.name as name',
                'catatans.id as id',
                'catatans.catatan as catatan',
                'catatans.nis as nis'
            )
            ->orderBy('users.name')
            ->get();
        $this->list_nis_siswa = $this->list_catatan->pluck('nis');
    }
}
