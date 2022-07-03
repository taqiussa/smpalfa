<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Catatan;
use App\Models\Prestasi;
use App\Models\GuruMapel;
use App\Models\KurikulumMapel;
use App\Models\PenilaianRapor;
use App\Models\PenilaianSikap;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PenilaianEkstrakurikuler;
use Carbon\Carbon;

class PrintRaporController extends Controller
{
    public $kelas;
    public $nis;
    public $tahun;
    public $nama;
    public $semester;

    public function index()
    {
        $this->kelas = Kelas::find(request('kelas'));
        $this->nis = request('nis');
        $this->tahun = request('tahun');
        $this->nama = User::where('nis', $this->nis)->first()->name;
        $this->semester = request('semester');

        $data = [
            'kelas_id' => $this->kelas,
            'nama_kelas' => $this->kelas->nama,
            'tingkat' => $this->kelas->tingkat,
            'nama_siswa' => $this->nama,
            'nis' => $this->nis,
            'nisn' => Biodata::where('nis', $this->nis)->first()->nisn,
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'spiritual' => $this->get_sikap($this->nis, 1),
            'sosial' => $this->get_sikap($this->nis, 2),
            'kelompok_a' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'A'),
            'kelompok_b' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'B'),
            'kelompok_c' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'C'),
            'kelompok_a2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'A'),
            'kelompok_b2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'B'),
            'kelompok_c2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'C'),
            'nilai_ekstra' => PenilaianEkstrakurikuler::with('ekstra')
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'sakit' => $this->get_kehadiran($this->nis, 2),
            'izin' => $this->get_kehadiran($this->nis, 3),
            'alpha' => $this->get_kehadiran($this->nis, 4),
            'list_prestasi' => Prestasi::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'list_catatan' => Catatan::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
        ];
        return view('rapor.rapor-print', $data);
    }
    public function indexv()
    {
        $this->kelas = Kelas::find(request('kelas'));
        $this->nis = request('nis');
        $this->tahun = request('tahun');
        $this->nama = User::where('nis', $this->nis)->first()->name;
        $this->semester = request('semester');

        $data = [
            'kelas_id' => $this->kelas,
            'nama_kelas' => $this->kelas->nama,
            'tingkat' => $this->kelas->tingkat,
            'nama_siswa' => $this->nama,
            'nis' => $this->nis,
            'nisn' => Biodata::where('nis', $this->nis)->first()->nisn,
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'spiritual' => $this->get_sikap($this->nis, 1),
            'sosial' => $this->get_sikap($this->nis, 2),
            'list_mapela' => $this->get_mapel($this->kelas->tingkat, 'A'),
            'nilai_a' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'A'),
            'kelompok_b' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'B'),
            'kelompok_c' => $this->get_nilai($this->nis, $this->kelas->tingkat, 3, 'C'),
            'kelompok_a2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'A'),
            'kelompok_b2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'B'),
            'kelompok_c2' => $this->get_nilai($this->nis, $this->kelas->tingkat, 4, 'C'),
            'nilai_ekstra' => PenilaianEkstrakurikuler::with('ekstra')
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'sakit' => $this->get_kehadiran($this->nis, 2),
            'izin' => $this->get_kehadiran($this->nis, 3),
            'alpha' => $this->get_kehadiran($this->nis, 4),
            'list_prestasi' => Prestasi::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'list_catatan' => Catatan::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $this->nis)
                ->get(),
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
        ];
        return view('rapor.rapor-print-v', $data);
    }

    public function get_sikap($nis, $kategori)
    {
        $id_mapel = GuruMapel::where('user_id', auth()->user()->id)
            ->pluck('mata_pelajaran_id');
        $sikap_mapel = PenilaianSikap::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kategori_sikap_id', $kategori)
            ->where('nis', $nis)
            ->select(
                DB::raw('round(avg(nilai)) as nilai')
            )
            ->value('nilai');
        $sikap_wali =  PenilaianSikap::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kategori_sikap_id', $kategori)
            ->where('nis', $nis)
            ->whereIn('mata_pelajaran_id', $id_mapel)
            ->select(
                DB::raw('round(avg(nilai)) as nilai')
            )
            ->value('nilai');
        $hasil = (intval($sikap_mapel) + intval($sikap_wali)) / 2;
        if ($hasil > 90) {
            $predikat = 'Sangat Baik';
        } elseif ($hasil > 80) {
            $predikat = 'Baik';
        } elseif ($hasil > 70) {
            $predikat = 'Cukup';
        } else {
            $predikat = 'Kurang';
        }
        return $predikat;
    }
    public function get_mapel($tingkat, $kelompok)
    {
        return KurikulumMapel::where('kurikulum_mata_pelajaran.tahun', $this->tahun)
            ->where('kurikulum_mata_pelajaran.tingkat', $tingkat)
            ->join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('mata_pelajarans.kelompok', $kelompok)
            ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'kurikulum_mata_pelajaran.mata_pelajaran_id')
            ->where('kkms.tingkat', $tingkat)
            ->where('kkms.tahun', $this->tahun)
            ->select(
                'mata_pelajarans.nama as nama',
                'kurikulum_mata_pelajaran.mata_pelajaran_id as id',
                'kkms.kkm as kkm',
            )
            ->orderBy('mata_pelajarans.id')
            ->get();
    }
    public function get_nilai($nis, $tingkat, $kategori, $kelompok)
    {
        $jenis_penilaian = PenilaianRapor::where('semester', $this->semester)
            ->where('tahun', $this->tahun)->where('kategori_nilai_id', $kategori)->pluck('jenis_penilaian_id');
        return KurikulumMapel::where('kurikulum_mata_pelajaran.tahun', $this->tahun)
            ->where('kurikulum_mata_pelajaran.tingkat', $tingkat)
            ->join('mata_pelajarans', 'kurikulum_mata_pelajaran.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('mata_pelajarans.kelompok', $kelompok)
            ->join('kkms', 'kkms.mata_pelajaran_id', '=', 'kurikulum_mata_pelajaran.mata_pelajaran_id')
            ->where('kkms.tingkat', $tingkat)
            ->where('kkms.tahun', $this->tahun)
            ->join('penilaians', 'penilaians.mata_pelajaran_id', '=', 'kurikulum_mata_pelajaran.mata_pelajaran_id')
            ->where('penilaians.tahun', $this->tahun)
            ->where('penilaians.semester', $this->semester)
            ->where('penilaians.nis', $nis)
            ->where('penilaians.kelas_id', $this->kelas->id)
            ->where('penilaians.kategori_nilai_id', $kategori)
            ->whereIn('penilaians.jenis_penilaian_id', $jenis_penilaian)
            ->select(
                'mata_pelajarans.nama as nama',
                'kurikulum_mata_pelajaran.mata_pelajaran_id as id',
                'kkms.kkm as kkm',
                DB::raw('round(avg(penilaians.nilai)) as nilai')
            )
            ->groupBy('nama', 'kkm', 'id')
            ->orderBy('mata_pelajarans.id')
            ->get();
    }
    public function get_kehadiran($nis, $kehadiran)
    {
        $absensi =  Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $nis)
            ->where('kehadiran_id', $kehadiran)
            ->count();
        $hasil = floor($absensi / 4);
        return $hasil;
    }
}
