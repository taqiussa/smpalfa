<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;

class DaftarNilaiController extends Controller
{
    
    public function nilai_guru()
    {
        $tahun = request('tahun');
        $semester = request('semester');
        $kelas = request('kelas');
        $mata_pelajaran = request('mata_pelajaran');
        $data = [
            'tahun' => $tahun,
            'semester' => $semester,
            'nama_kelas' => Kelas::find($kelas)->nama,
            'nama_mapel' => MataPelajaran::find($mata_pelajaran)->nama,
        ];
        return view('rapor.daftar-nilai-guru-print', $data);
    }
}
