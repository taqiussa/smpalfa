<?php

namespace App\Http\Controllers;

use App\Models\JenisAlquran;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrintAlquranController extends Controller
{
    public function index()
    {
        $tahun = request('tahun');
        $kelas = request('kelas');
        $data = [
            'list_siswa' =>Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $kelas)
            ->where('siswas.tahun', $tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get(),
            'list_bilghoib' => JenisAlquran::where('kategori_alquran_id', 1)->get(),
            'list_binnadzor' => JenisAlquran::where('kategori_alquran_id', 2)->get(),
            'kelas' => Kelas::find($kelas)->nama,
            'tahun' => $tahun,
        ];
        return view('alquran.print', $data);
    }
}
