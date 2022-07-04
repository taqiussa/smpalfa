<?php

namespace App\Http\Livewire\Konseling\Skor;

use App\Models\Kelas;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PenilaianSkor;

class RekapSkor extends Component
{
    use WithPagination;
    use GetData;

    //model
    public $tahun;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view('livewire.konseling.skor.rekap-skor',
    [
        'list_rekap_skor' => PenilaianSkor::with('skors')
        ->join('users as siswa','siswa.nis', '=','penilaian_skors.nis')
        ->join('users as guru', 'guru.id', '=', 'penilaian_skors.user_id')
        ->where('penilaian_skors.tahun', $this->tahun)
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
        ->orderBy('created_at','desc')->paginate(5),
    ]);
    }

    public function mount()
    {
        $this->get_tahun();
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
