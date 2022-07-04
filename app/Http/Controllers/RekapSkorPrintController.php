<?php

namespace App\Http\Controllers;

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
        $data = [
            'tahun' => $this->tahun,
            'kelas' => $this->kelas_id,
        ];
        return view('print.rekap-skor-perkelas', $data);
    }

    public function persiswa()
    {
        return view('print.rekap-skor-persiswa');
    }
}
