<?php

namespace App\Imports;

use App\Models\PenilaianSikap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNilaiSikap implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new PenilaianSikap(
            [
                'tahun' => $row['tahun'],
                'semester' => $row['semester'],
                'kelas_id' => $row['kelas_id'],
                'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                'nis' => $row['nis'],
                'kategori_sikap_id' => $row['kategori_sikap_id'],
                'jenis_sikap_id' => $row['jenis_sikap_id'],
                'nilai' => $row['nilai'],
                'tindak_lanjut' => $row['tindak_lanjut']
            ]
            );
    }
}
