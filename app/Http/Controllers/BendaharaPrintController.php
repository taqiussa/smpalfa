<?php

namespace App\Http\Controllers;

use App\Models\Gunabayar;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class BendaharaPrintController extends Controller
{
    public function pembayaran_siswa()
    {
        $pembayaran = Pembayaran::find(request('id'));
        $data = [
            'tanggal' => $pembayaran->tanggal,
            'bendahara' => User::where('id', $pembayaran->user_id)->first()->name,
            'jumlah' => $pembayaran->jumlah,
            'siswa' => User::where('nis', $pembayaran->nis)->first()->name,
            'kelas' => Kelas::find($pembayaran->kelas_id)->nama,
            'tahun' => $pembayaran->tahun,
            'gunabayar' => Gunabayar::find($pembayaran->gunabayar_id)->nama
        ];
        return view('pembayaran.print',$data);
    }
}
