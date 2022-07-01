<?php

namespace App\Imports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNilai implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penilaian([
            'tahun' => $row['tahun'],
            'semester' => $row['semester'],
            'mata_pelajaran_id' => $row['mata_pelajaran_id'],
            'kategori_nilai_id' => $row['kategori_nilai_id'],
            'jenis_penilaian_id' => $row['jenis_penilaian_id'],
            'kelas_id' => $row['kelas_id'],
            'nis' => $row['nis'],
            'nilai' => $row['nilai'],
            'tanggal'=> gmdate('Y-m-d'),
            'user_id' => auth()->user()->id
        ]);
    }
}
