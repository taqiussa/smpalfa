<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PenilaianRapor;
use App\Models\Siswa;
use App\Models\WaliKelas;

class DaftarNilaiController extends Controller
{
    
    public function nilai_guru()
    {
        $tahun = request('tahun');
        $semester = request('semester');
        $id_kelas = request('id_kelas');
        $kelas = Kelas::find($id_kelas);
        $mata_pelajaran = request('mata_pelajaran');
        $data = [
            'tahun' => $tahun,
            'semester' => $semester,
            'nama_kelas' => $kelas->nama,
            'mata_pelajaran' => $mata_pelajaran,
            'nama_mapel' => MataPelajaran::find($mata_pelajaran)->nama,
            'wali_kelas' => WaliKelas::where('tahun', $tahun)
            ->where('kelas_id', $id_kelas)
            ->with('guru')
            ->get(),
            'list_penilaian' => PenilaianRapor::where('tahun',$tahun)
            ->where('semester', $semester)
            // ->where('tingkat', $kelas->tingkat)
            ->with(['kategori', 'jenis_penilaian'])
            ->get(),
            'list_siswa' => Siswa::where('tahun', $tahun)
            ->where('kelas_id', $id_kelas)
            ->with(['user'])
            ->get(),
        ];
        return view('rapor.daftar-nilai-guru-print', $data);
    }
}
