<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RekapSkorPrintController extends Controller
{
    public $tahun;
    public $kelas_id;
    public $nis;
    public function __construct()
    {
        $this->tahun = request('tahun');
        $this->kelas_id = request('kelas_id');
        $this->nis = request('nis');
    }
    public function perkelas()
    {
        $nama_kelas = Kelas::find($this->kelas_id)->nama;
        $data = [
            'tahun' => $this->tahun,
            'nama_kelas' => $nama_kelas,
            'list_siswa' => Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas_id)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get(),
        ];
        return view('skor.rekap-skor-perkelas', $data);
    }

    public function persiswa()
    {
        return view('skor.rekap-skor-persiswa');
    }
}
