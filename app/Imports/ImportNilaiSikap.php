<?php

namespace App\Imports;

use App\Models\PenilaianSikap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNilaiSikap implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            PenilaianSikap::updateOrCreate(
                [
                    'tahun' => $row['tahun'],
                    'semester' => $row['semester'],
                    'kelas_id' => $row['kelas_id'],
                    'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                    'nis' => $row['nis'],
                    'kategori_sikap_id' => $row['kategori_sikap_id'],
                    'jenis_sikap_id' => $row['jenis_sikap_id'],
                ],
                [
                    'nilai' => $row['nilai'],
                    'tindak_lanjut' => $row['tindak_lanjut']

                ]
            );
        }
    }
}
