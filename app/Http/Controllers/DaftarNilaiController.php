<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PenilaianRapor;

class DaftarNilaiController extends Controller
{
    
    public function nilai_guru()
    {
        $tahun = request('tahun');
        $semester = request('semester');
        $idkelas = request('kelas');
        $kelas = Kelas::find($idkelas);
        $mata_pelajaran = request('mata_pelajaran');
        $data = [
            'tahun' => $tahun,
            'semester' => $semester,
            'nama_kelas' => $kelas->nama,
            'nama_mapel' => MataPelajaran::find($mata_pelajaran)->nama,
            'list_penilaian' => PenilaianRapor::where('tahun',$tahun)
            ->where('semester', $semester)
            ->where('tingkat', $kelas->tingkat)
            ->with(['kategori', 'jenis_penilaian'])
            ->get(),
        ];
        return view('rapor.daftar-nilai-guru-print', $data);
    }
}
