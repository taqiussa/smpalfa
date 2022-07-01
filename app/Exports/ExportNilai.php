<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportNilai implements FromView
{
    private $tahun;
    private $semester;
    private $mata_pelajaran_id;
    private $kategori_nilai_id;
    private $jenis_penilaian_id;
    private $kelas_id;

    public function __construct($tahun, $semester, $mata_pelajaran_id, $kategori_nilai_id, $jenis_penilaian_id, $kelas_id)
    {
        $this->tahun = $tahun;
        $this->semester = $semester;
        $this->mata_pelajaran_id = $mata_pelajaran_id;
        $this->kategori_nilai_id = $kategori_nilai_id;
        $this->jenis_penilaian_id = $jenis_penilaian_id;
        $this->kelas_id = $kelas_id;
    }
    public function view(): View
    {
        return view('exports.export-nilai',[
            'list_siswa' => Siswa::join('users', 'users.nis', '=', 'siswas.nis')
                            ->where('tahun', $this->tahun)
                            ->where('kelas_id', $this->kelas_id)
                            ->select(
                                'users.nis as nis',
                                'users.name as name'
                            )
                            ->orderBy('users.name')
                            ->get(),
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'kategori_nilai_id' => $this->kategori_nilai_id,
            'jenis_penilaian_id' => $this->jenis_penilaian_id,
            'kelas_id' => $this->kelas_id
        ]);
    }
}
