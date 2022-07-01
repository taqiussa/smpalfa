<?php

namespace App\Http\Controllers\Konseling\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Bk;
use App\Models\BkDetail;
use Illuminate\Http\Request;

class DetailBimbinganController extends Controller
{
    public function show(BkDetail $bk_detail)
    {
        return view('konseling.layanan.detail-bimbingan',
    [
        'header' => 'Detail Bimbingan',
        'detail' => $bk_detail,
        'bk' => Bk::with(['details' => fn($query) => 
            $query->join('users', 'users.nis', '=', 'bk_details.nis')
            ->join('kelas', 'kelas.id', '=', 'bk_details.kelas_id')
        ])->find($bk_detail->bk_id)
    ]);
    }
}
