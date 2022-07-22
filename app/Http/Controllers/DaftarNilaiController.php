<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\GuruMapel;
use App\Models\WaliKelas;
use App\Models\MataPelajaran;
use App\Models\KurikulumMapel;
use App\Models\PenilaianRapor;
use App\Models\PenilaianSikap;

class DaftarNilaiController extends Controller
{
    public $tahun;
    public $semester;
    public $id_kelas;
    public $kelas;
    public $mata_pelajaran;

    public function __construct()
    {
        $this->tahun = request('tahun');
        $this->semester = request('semester');
        $this->id_kelas = request('id_kelas');
        $this->kelas = Kelas::find($this->id_kelas);
        $this->mata_pelajaran = request('mata_pelajaran');
    }
    public function nilai_guru()
    {
        $data = [
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'nama_kelas' => $this->kelas->nama,
            'mata_pelajaran' => $this->mata_pelajaran,
            'nama_mapel' => MataPelajaran::find($this->mata_pelajaran)->nama,
            'wali_kelas' => $this->get_wali_kelas(),
            'list_penilaian' => $this->get_list_penilaian(),
            'list_siswa' => $this->get_list_siswa(),
        ];
        return view('rapor.daftar-nilai-guru-print', $data);
    }

    public function nilai_kelas()
    {
        $data =
            [
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'nama_kelas' => $this->kelas->nama,
                'id_wali_kelas' => $this->get_id_wali_kelas(),
                'wali_kelas' => $this->get_wali_kelas(),
                'list_mata_pelajaran' => $this->get_list_mata_pelajaran(),
                'total_mapel' => $this->get_total_mapel(),
                'list_siswa' => $this->get_list_siswa(),
            ];
        return view('rapor.daftar-nilai-kelas-print', $data);
    }


    private function get_list_penilaian()
    {
        return PenilaianRapor::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            // ->where('tingkat', $kelas->tingkat)
            ->with(['kategori', 'jenis_penilaian'])
            ->get();
    }

    private function get_id_wali_kelas()
    {
        return WaliKelas::where('tahun', $this->tahun)
            ->where('kelas_id', $this->id_kelas)
            ->pluck('user_id');
    }
    private function get_wali_kelas()
    {
        return WaliKelas::where('tahun', $this->tahun)
            ->where('kelas_id', $this->id_kelas)
            ->with('guru')
            ->get();
    }
    private function get_list_mata_pelajaran()
    {
        return KurikulumMapel::where('kurikulum_mata_pelajaran.tahun', $this->tahun)
            ->where('kurikulum_mata_pelajaran.tingkat', $this->kelas->tingkat)
            ->with(['mapel'])
            ->join('kkms', 'kkms.mata_pelajaran_id', 'kurikulum_mata_pelajaran.mata_pelajaran_id')
            ->where('kkms.tahun', $this->tahun)
            ->where('kkms.tingkat', $this->kelas->tingkat)
            ->get();
    }
    private function get_total_mapel()
    {
        return KurikulumMapel::where('tahun', $this->tahun)
            ->where('tingkat', $this->kelas->tingkat)
            ->count();
    }
    private function get_list_siswa()
    {
        return Siswa::where('tahun', $this->tahun)
            ->where('kelas_id', $this->id_kelas)
            ->with(['user'])
            ->get();
    }
}
