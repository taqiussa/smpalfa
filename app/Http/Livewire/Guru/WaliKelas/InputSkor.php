<?php

namespace App\Http\Livewire\Guru\WaliKelas;

use App\Models\Kelas;
use App\Models\PenilaianSkor;
use App\Models\Skor;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;

class InputSkor extends Component
{
    use GetData;
    use WithPagination;

    //model
    public $tanggal;
    public $tahun;
    public $semester;
    public $kelas;
    public $siswa;
    public $skor;
    public $informasi;
    public $kelas_wali;

    //array
    public $list_kelas = [];
    public $list_siswa = [];
    public $list_skor = [];
    protected $rules = [
        'tanggal' => 'required',
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required',
        'siswa' => 'required',
        'skor' => 'required'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view(
            'livewire.guru.wali-kelas.input-skor',
            [
                'list_nilai_skor' => PenilaianSkor::with('skors')
                    ->where('penilaian_skors.tahun', $this->tahun)
                    ->where('penilaian_skors.kelas_id', $this->kelas)
                    ->join('users as siswa', 'siswa.nis', '=', 'penilaian_skors.nis')
                    ->join('users as guru', 'guru.id', '=', 'penilaian_skors.user_id')
                    ->select(
                        'siswa.name as nama_siswa',
                        'guru.name as nama_guru',
                        'penilaian_skors.tanggal as tanggal',
                        'penilaian_skors.kelas_id as kelas_id',
                        'penilaian_skors.skor_id as skor_id',
                        'penilaian_skors.skor as skor',
                        'penilaian_skors.id as id',
                        'penilaian_skors.created_at as created_at'
                    )
                    ->orderBy('created_at', 'desc')->paginate(10)
            ]
        );
    }

    public function mount()
    {
        $this->list_kelas = Kelas::get();
        $this->get_tahun();
        $this->get_wali_kelas();
        $this->get_semester();
        $this->tanggal = gmdate('Y-m-d');
        $this->list_skor = Skor::orderBy('keterangan')->get();
    }
    public function hydrate()
    {
        $this->list_kelas = Kelas::get();
        $this->get_wali_kelas();
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
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Skor Siswa',
                'text' => 'Anda Yakin Menghapus Skor Siswa ?',
                'id' => $id

            ]
        );
    }
    public function delete($id)
    {
        PenilaianSkor::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Skor Siswa'
            ]
        );
    }
    public function updatedTahun()
    {
        $this->list_kelas = Kelas::get();
        $this->get_wali_kelas();
        $this->get_list_siswa();
    }
}
