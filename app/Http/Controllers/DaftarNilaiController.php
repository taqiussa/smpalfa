<?php

namespace App\Http\Controllers;


class DaftarNilaiController extends Controller
{
    
    public function nilai_guru()
    {
        return view('rapor.daftar-nilai-guru-print');
    }
}
