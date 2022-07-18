<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportDataSiswa implements FromView
{
    private $tahun;
    private $kelas;

    public function __construct($tahun, $kelas)
    {
        $this->tahun = $tahun;
        $this->kelas = $kelas;
    }
    public function view(): View
    {
        return view('exports.export-data-siswa', [
            'list_data_siswa' =>Siswa::where('tahun', $this->tahun)
            ->where('kelas_id', $this->kelas)
            ->with(
                [
                    'user',
                    'alamat',
                    'orangtua',
                    'wali',
                    'biodata'
                ]
            )
            ->get()
        ]);
    }
    // public function view(): View
    // {
    //     return view('exports.export-data-siswa', [
    //         'list_siswa' => Siswa::join('users', 'users.nis', '=', 'siswas.nis')
    //             ->where('tahun', $this->tahun)
    //             ->where('kelas_id', $this->kelas)
    //             ->select(
    //                 'users.nis as nis',
    //                 'users.name as name'
    //             )
    //             ->orderBy('users.name')
    //             ->get()
    //     ]);
    // }
}
