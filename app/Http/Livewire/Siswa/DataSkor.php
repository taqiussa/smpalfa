<?php

namespace App\Http\Livewire\Siswa;

use App\Traits\GetData;
use Livewire\Component;
use App\Models\PenilaianSkor;
use Livewire\WithPagination;

class DataSkor extends Component
{
    use GetData;
    use WithPagination;

    // model
    public $tahun;
    public $saldo;
    public function render()
    {
        $this->get_tahun();
        $total = PenilaianSkor::where('tahun', $this->tahun)
        ->where('nis', auth()->user()->nis)
        ->sum('skor');
        $this->saldo = $total;
        return view(
            'livewire.siswa.data-skor',
            [
                'list_skor' => PenilaianSkor::with('skors')
                    ->join('users as siswa', 'siswa.nis', '=', 'penilaian_skors.nis')
                    ->join('users as guru', 'guru.id', '=', 'penilaian_skors.user_id')
                    ->where('siswa.nis', auth()->user()->nis)
                    ->where('penilaian_skors.tahun', $this->tahun)
                    ->select(
                        'siswa.name as nama_siswa',
                        'guru.name as nama_guru',
                        'penilaian_skors.tanggal as tanggal',
                        'penilaian_skors.kelas_id as kelas_id',
                        'penilaian_skors.skor_id as skor_id',
                        'penilaian_skors.skor as skor',
                        'penilaian_skors.tahun as tahun',
                        'penilaian_skors.created_at as created_at'
                    )
                    ->orderBy('created_at', 'desc')->paginate(10)
            ]
        );
    }
}
