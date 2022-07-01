<?php

namespace App\Imports;

use App\Models\Kd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportKdRapor implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kd(
            [
                'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                'tingkat' => $row['tingkat'],
                'kategori_nilai_id' => $row['kategori_nilai_id'],
                'jenis_penilaian_id' => $row['jenis_penilaian_id'],
                'tahun' => $row['tahun'],
                'semester' => $row['semester'],
                'deskripsi' => $row['kd'],
            ]
            );
    }
}
