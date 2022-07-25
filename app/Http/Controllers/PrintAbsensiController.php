<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class PrintAbsensiController extends Controller
{
    public $tahun;
    public $semester;
    public $kelas;
    public $tanggalawal;
    public $tanggalakhir;
    public $list_siswa = [];
    public $list_hadir = [];
    public $list_izin = [];
    public $list_sakit = [];
    public $list_alpha = [];
    public $list_bolos = [];
    public $list_pulang = [];
    public $list_present = [];

    public function index()
    {
        $this->tahun = request('tahun');
        $this->semester = request('semester');
        $this->kelas = request('kelas');
        $this->tanggalawal = request('tanggalawal');
        $this->tanggalakhir = request('tanggalakhir');

        $kelas = Kelas::find($this->kelas);
        $wali_kelas = WaliKelas::where('tahun', $this->tahun)
        ->where('kelas_id', $this->kelas)
        ->with(['guru'])
        ->get();
        $this->list_siswa = Siswa::where('tahun', $this->tahun)
        ->where('kelas_id', $this->kelas)
        ->with(['user'])
        ->get()
        ->sortBy('user.name');
        
        if(!empty($this->semester)){
            $this->get_kehadiran();
            $data =
            [
                'nama_kelas' => $kelas->nama,
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'wali_kelas' => $wali_kelas,
                'list_siswa' => $this->list_siswa,
                'list_hadir' => $this->list_hadir,
                'list_izin' => $this->list_izin,
                'list_sakit' => $this->list_sakit,
                'list_alpha' => $this->list_alpha,
                'list_bolos' => $this->list_bolos,
                'list_pulang' => $this->list_pulang,
                'list_present' => $this->list_present,
            ];
            return view('absensi.absensi-print', $data);
        } else {
            $this->get_kehadiran_harian();
            $dataharian =
            [
                'nama_kelas' => $kelas->nama,
                'tahun' => $this->tahun,
                'tanggalawal' => $this->tanggalawal,
                'tanggalakhir' => $this->tanggalakhir,
                'wali_kelas' => $wali_kelas,
                'list_siswa' => $this->list_siswa,
                'list_hadir' => $this->list_hadir,
                'list_izin' => $this->list_izin,
                'list_sakit' => $this->list_sakit,
                'list_alpha' => $this->list_alpha,
                'list_bolos' => $this->list_bolos,
                'list_pulang' => $this->list_pulang,
                'list_present' => $this->list_present,
            ];
            return view('absensi.absensi-print-harian', $dataharian);
        }
    }

    public function get_kehadiran()
    {

        foreach($this->list_siswa as $key => $siswa)
        {
            $total_hadir = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 1)
            ->count();
            $this->list_hadir[$key] = $total_hadir;

            $total_sakit = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 2)
            ->count();
            $this->list_sakit[$key] = $total_sakit;

            $total_izin = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 3)
            ->count();
            $this->list_izin[$key] = $total_izin;

            $total_alpha = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 4)
            ->count();
            $this->list_alpha[$key] = $total_alpha;

            $total_bolos = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 5)
            ->count();
            $this->list_bolos[$key] = $total_bolos;

            $total_pulang = Absensi::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 6)
            ->count();
            $this->list_pulang[$key] = $total_pulang;

            $max = max($this->list_hadir);
            $this->list_present[$key] = round(($this->list_hadir[$key] / $max) * 100, 2);
        }
        
    }
    public function get_kehadiran_harian()
    {

        foreach($this->list_siswa as $key => $siswa)
        {
            $total_hadir = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 1)
            ->count();
            $this->list_hadir[$key] = $total_hadir;

            $total_sakit = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 2)
            ->count();
            $this->list_sakit[$key] = $total_sakit;

            $total_izin = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 3)
            ->count();
            $this->list_izin[$key] = $total_izin;

            $total_alpha = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 4)
            ->count();
            $this->list_alpha[$key] = $total_alpha;

            $total_bolos = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 5)
            ->count();
            $this->list_bolos[$key] = $total_bolos;

            $total_pulang = Absensi::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
            ->where('nis', $siswa->nis)
            ->where('kehadiran_id', 6)
            ->count();
            $this->list_pulang[$key] = $total_pulang;

            $max = max($this->list_hadir);
            $this->list_present[$key] = round(($this->list_hadir[$key] / $max) * 100, 2);
        }
        
    }
}
