<?php

namespace App\Http\Livewire\Konseling\Skor;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\PenilaianSkor;
use Livewire\WithPagination;

class PencarianSkor extends Component
{
    use GetData;
    use WithPagination;

    //model
    public $tahun;
    public $kelas;
    public $siswa;

    //array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view('livewire.konseling.skor.pencarian-skor',
    [
        'list_rekap_skor' => PenilaianSkor::with('skors')
        ->join('users as siswa','siswa.nis', '=','penilaian_skors.nis')
        ->join('users as guru', 'guru.id', '=', 'penilaian_skors.user_id')
        ->where('penilaian_skors.nis', $this->siswa)
        ->where('penilaian_skors.tahun', $this->tahun)
        ->select(
            'siswa.name as nama_siswa',
            'guru.name as nama_guru',
            'penilaian_skors.tanggal as tanggal',
            'penilaian_skors.kelas_id as kelas_id',
            'penilaian_skors.skor_id as skor_id',
            'penilaian_skors.skor as skor',
            'penilaian_skors.id as id'
        )
        ->orderBy('tanggal','desc')->paginate(5),
    ]);
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    public function hydrate()
    {
        $this->get_list_siswa();
    }
    public function updated($property)
    {
        $this->get_list_siswa();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Skor',
            'text' => 'And Yakin Menghapus Data Skor Siswa ?',
            'id' => $id, 
        ]);
    }

    public function delete($id)
    {
        PenilaianSkor::find($id)->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Data Skor Siswa'
        ]);
    }
}
