<?php

namespace App\Imports;

use App\Models\Penilaian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNilai implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Penilaian::updateOrCreate(
                [
                    'tahun' => $row['tahun'],
                    'semester' => $row['semester'],
                    'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                    'kategori_nilai_id' => $row['kategori_nilai_id'],
                    'jenis_penilaian_id' => $row['jenis_penilaian_id'],
                    'kelas_id' => $row['kelas_id'],
                    'nis' => $row['nis'],
                ],
                [
                    'nilai' => $row['nilai'],
                    'tanggal' => gmdate('Y-m-d'),
                    'user_id' => auth()->user()->id
                ]
            );
        }
    }
}
