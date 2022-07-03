<?php

namespace App\Imports;

use App\Models\Kd;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportKdRapor implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Kd::updateOrCreate(
                [
                    'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                    'tingkat' => $row['tingkat'],
                    'kategori_nilai_id' => $row['kategori_nilai_id'],
                    'jenis_penilaian_id' => $row['jenis_penilaian_id'],
                    'tahun' => $row['tahun'],
                    'semester' => $row['semester'],
                ],
                [
                    'deskripsi' => $row['kd'],
                ]
            );
        }
    }
}
