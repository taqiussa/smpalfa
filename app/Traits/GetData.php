<?php

namespace App\Traits;

use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\GuruMapel;
use App\Models\WaliKelas;
use App\Models\AbsensiEkstra;

trait GetData
{
    public function get_list_siswa()
    {
        $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
                'siswas.id as id',
            )
            ->orderBy('users.name')
            ->get();
    }
    public function get_semester()
    {
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->semester = 2;
        } else {
            $this->semester = 1;
        }
    }
    public function get_tahun()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
    }
    public function get_wali_kelas()
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

    public function cek_absen()
    {
        $cek_absen = Absensi::where('tanggal', $this->tanggal)
            ->where('jam', $this->jam)
            ->where('kelas_id', $this->kelas)
            ->where('tahun', $this->tahun)
            ->get();
        return $cek_absen;
    }
    public function data_absensi()
    {
        $data_absensi = Absensi::join('users', 'absensis.nis', '=', 'users.nis')
            ->where('tanggal', $this->tanggal)
            ->where('jam', $this->jam)
            ->where('kelas_id', $this->kelas)
            ->where('tahun', $this->tahun)
            ->select(
                'users.name as name',
                'absensis.id as id',
                'absensis.jam as jam',
                'absensis.kehadiran_id as kehadiran_id',
            )
            ->orderBy('users.name')
            ->get();
        return $data_absensi;
    }

    public function cek_absen_ekstra()
    {
        $absen_ekstra = AbsensiEkstra::with('ekstra')
            ->where('tanggal', $this->tanggal)
            ->where('absensi_ekstras.tahun', $this->tahun)
            ->where('ekstrakurikuler_id', $this->ekstrakurikuler)
            ->join('users', 'users.nis', '=', 'absensi_ekstras.nis')
            ->join('kehadirans', 'kehadirans.id', '=', 'absensi_ekstras.kehadiran_id')
            ->join('kelas', 'kelas.id', '=', 'absensi_ekstras.kelas_id')
            ->select(
                'users.name as name',
                'kelas.nama as kelas',
                'kehadirans.nama as kehadiran',
                'absensi_ekstras.id as id',
                'absensi_ekstras.tanggal as tanggal',
                'absensi_ekstras.tahun as tahun',
                'absensi_ekstras.semester as semester',
                'absensi_ekstras.ekstrakurikuler_id as ekstrakurikuler_id'
            )
            ->get();

        return $absen_ekstra;
    }

    public function cek_mata_pelajaran()
    {
        return GuruMapel::join('mata_pelajarans', 'mata_pelajarans.id', '=', 'guru_mata_pelajaran.mata_pelajaran_id')
            ->where('user_id', auth()->user()->id)
            ->select(
                'guru_mata_pelajaran.mata_pelajaran_id as id',
                'mata_pelajarans.nama as nama'
            )
            ->get();
    }
}
