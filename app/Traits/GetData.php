<?php

namespace App\Traits;

use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\WaliKelas;

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

}
