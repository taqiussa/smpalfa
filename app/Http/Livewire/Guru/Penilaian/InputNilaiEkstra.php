<?php

namespace App\Http\Livewire\Guru\Penilaian;

use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\PenilaianEkstrakurikuler;
use App\Traits\GetData;
use Livewire\Component;

class InputNilaiEkstra extends Component
{
    use GetData;

    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $nilai;
    public $ekstrakurikuler;
    public $is_edit;
    public $is_disabled;
    public $id_nilai_ekstra;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_ekstra = [];
    public $list_nilai_ekstra = [];
    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'siswa' => 'required',
        'ekstrakurikuler' => 'required',
        'kelas' => 'required',
        'nilai' => 'required|numeric|max:100'
    ];
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        $this->get_list_siswa();
        $this->get_nilai();
        return view('livewire.guru.penilaian.input-nilai-ekstra');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_semester();
        $this->list_ekstra = Ekstrakurikuler::orderBy('nama')->get();
        $this->list_kelas = Kelas::get();
    }


    public function simpan()
    {
        $this->validate();
        if ($this->is_edit) {
            PenilaianEkstrakurikuler::updateOrCreate(
                [
                    'id' => $this->id_nilai_ekstra
                ],
                [
                    'nilai' => $this->nilai,
                ]
            );
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Nilai Ekstrakurikuler'
                ]
            );
        } else {

            PenilaianEkstrakurikuler::create([
                'ekstrakurikuler_id' => $this->ekstrakurikuler,
                'nis' => $this->siswa,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'nilai' => $this->nilai,
                'kelas_id' => $this->kelas
            ]);
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Nilai Ekstrakurikuler'
                ]
            );
        }
        $this->kelas = '';
        $this->siswa = '';
        $this->nilai = '';
        $this->list_siswa = [];
        $this->is_edit = false;
        $this->is_disabled = '';
    }
    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $this->id_nilai_ekstra = $id;
        $cari = PenilaianEkstrakurikuler::find($id);
        $this->tahun = $cari->tahun;
        $this->semester = $cari->semester;
        $this->ekstrakurikuler = $cari->ekstrakurikuler_id;
        $this->kelas = $cari->kelas_id;
        $this->siswa = $cari->nis;
        $this->nilai = $cari->nilai;
    }
    public function batal()
    {
        $this->kelas = '';
        $this->siswa = '';
        $this->nilai = '';
        $this->is_edit = false;
        $this->is_disabled = '';
        $this->id_nilai_ekstra = '';
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Nilai Ekstra Siswa',
                'text' => 'Anda Yakin Menghapus Nilai Ekstra Siswa ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        PenilaianEkstrakurikuler::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Nilai Ekstra'
            ]
        );
    }
    public function hydrate()
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
    }
    public function updated($property)
    {
        $this->list_siswa = [];
        $this->get_list_siswa();
        $this->get_nilai();
    }

    private function get_nilai()
    {
        $this->list_nilai_ekstra = [];
        if (!empty($this->tahun) && !empty($this->semester) && !empty($this->ekstrakurikuler)) {
            $this->list_nilai_ekstra = PenilaianEkstrakurikuler::with('ekstra')
                ->join('users', 'users.nis', '=', 'penilaian_ekstrakurikulers.nis')
                ->join('kelas', 'kelas.id', '=', 'penilaian_ekstrakurikulers.kelas_id')
                ->where('ekstrakurikuler_id', $this->ekstrakurikuler)
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->select(
                    'users.name as name',
                    'kelas.nama as kelas',
                    'penilaian_ekstrakurikulers.id as id',
                    'penilaian_ekstrakurikulers.nilai as nilai',
                    'penilaian_ekstrakurikulers.ekstrakurikuler_id as ekstrakurikuler_id'
                )
                ->get();
        }
    }
}
