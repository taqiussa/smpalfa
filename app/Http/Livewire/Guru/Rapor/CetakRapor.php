<?php

namespace App\Http\Livewire\Guru\Rapor;

use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Catatan;
use App\Models\GuruMapel;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\KurikulumMapel;
use App\Models\PenilaianEkstrakurikuler;
use App\Models\PenilaianRapor;
use App\Models\PenilaianSikap;
use App\Models\Prestasi;
use App\Models\WaliKelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CetakRapor extends Component
{
    //model
    public $tahun;
    public $semester;
    public $kelas;
    public $idkelas;
    public $nama;
    public $informasi;
    public $kelas_wali;

    //array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $rules = [
        'tahun' => 'required',
        'semester' => 'required',
        'kelas' => 'required'
    ];
    public function render()
    {
        $this->list_kelas = Kelas::get();
        $this->get_list_siswa();
        $this->get_wali();
        $this->idkelas = $this->kelas;
        return view('livewire.guru.rapor.cetak-rapor');
    }
    public function mount()
    {
        $this->list_kelas = Kelas::get();
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
            $this->semester = 2;
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
            $this->semester = 1;
        }
        $this->get_wali();
    }
    public function updated($property)
    {
        $this->list_kelas = Kelas::get();
        $this->get_list_siswa();
        $this->get_wali();
    }
    private function get_wali()
    {
        $this->kelas_wali = WaliKelas::where('tahun', $this->tahun)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (blank($this->kelas_wali)) {
            $this->informasi = 'Anda Bukan Wali Kelas pada tahun ' . $this->tahun;
            $this->kelas = '';
            $this->siswa = '';
            $this->list_siswa = [];
            $this->list_kelas = [];
        } else {
            $this->informasi = '';
            $this->kelas = $this->kelas_wali->kelas_id;
        }
    }
    private function get_list_siswa()
    {
        $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get();
    }
    public function download($nis)
    {
        $this->validate();
        $this->nama = User::where('nis', $nis)->first()->name;
        $kelas = Kelas::find($this->kelas);
        $data = [
            'kelas_id' => $this->kelas,
            'nama_kelas' => $kelas->nama,
            'tingkat' => $kelas->tingkat,
            'nama_siswa' => $this->nama,
            'nis' => $nis,
            'nisn' => Biodata::where('nis', $nis)->first()->nisn,
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'spiritual' => $this->get_sikap($nis, 1),
            'sosial' => $this->get_sikap($nis, 2),
            'kelompok_a' => $this->get_nilai($nis, $kelas->tingkat, 3, 'A'),
            'kelompok_b' => $this->get_nilai($nis, $kelas->tingkat, 3, 'B'),
            'kelompok_c' => $this->get_nilai($nis, $kelas->tingkat, 3, 'C'),
            'kelompok_a2' => $this->get_nilai($nis, $kelas->tingkat, 4, 'A'),
            'kelompok_b2' => $this->get_nilai($nis, $kelas->tingkat, 4, 'B'),
            'kelompok_c2' => $this->get_nilai($nis, $kelas->tingkat, 4, 'C'),
            'nilai_ekstra' => PenilaianEkstrakurikuler::with('ekstra')
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $nis)
                ->get(),
            'sakit' => $this->get_kehadiran($nis, 2),
            'izin' => $this->get_kehadiran($nis, 3),
            'alpha' => $this->get_kehadiran($nis, 4),
            'list_prestasi' => Prestasi::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $nis)
                ->get(),
            'list_catatan' => Catatan::where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->where('nis', $nis)
                ->get(),
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
        ];
        $pdf = Pdf::loadView('rapor.pdf', $data)->setPaper(array(0, 0, 595.276, 907.087))->download();
        return response()->streamDownload(
            fn () => print($pdf),
            $this->nama . '.pdf'
        );
    }

    private function get_sikap($nis, $kategori)
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
        if ($hasil > 90 )
        {
            $predikat = 'Sangat Baik';
        } elseif ($hasil > 80)
        {
            $predikat = 'Baik';
        } elseif ($hasil > 70)
        {
            $predikat = 'Cukup';
        } else {
            $predikat = 'Kurang';
        }
        return $predikat;
    }
    private function get_nilai($nis, $tingkat, $kategori, $kelompok)
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
            ->where('penilaians.kelas_id', $this->kelas)
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
    private function get_kehadiran($nis, $kehadiran)
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
