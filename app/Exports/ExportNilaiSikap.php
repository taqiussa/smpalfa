<?php

namespace App\Exports;

use App\Models\JenisSikap;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportNilaiSikap implements FromView
{
    private $tahun;
    private $semester;
    private $kelas;
    private $kategori_sikap_id;
    private $mata_pelajaran_id;
    public function __construct($tahun, $semester, $kelas, $kategori_sikap_id, $mata_pelajaran_id)
    {
        $this->tahun = $tahun;
        $this->semester = $semester;
        $this->kelas = $kelas;
        $this->kategori_sikap_id = $kategori_sikap_id;
        $this->mata_pelajaran_id = $mata_pelajaran_id;
    }
    public function view(): View
    {
        return view(
            'exports.export-nilai-sikap',
            [
                'list_jenis' => JenisSikap::with('kategori')->where('kategori_sikap_id', $this->kategori_sikap_id)->get(),
                'list_siswa' => Siswa::join('users', 'siswas.nis', '=', 'users.nis')
                ->where('siswas.kelas_id', $this->kelas)
                ->where('siswas.tahun', $this->tahun)
                ->select(
                    'users.name as name',
                    'siswas.nis as nis',
                    'siswas.kelas_id as kelas_id'
                )
                ->orderBy('users.name')
                ->get(),
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'mata_pelajaran_id' => $this->mata_pelajaran_id,
                'nama_mapel' => MataPelajaran::find($this->mata_pelajaran_id)->nama
            ]
        );
    }
}
