<?php

namespace App\Imports;

use App\Models\AnalisisPenilaian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAnalisis implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row) 
        {
            AnalisisPenilaian::updateOrCreate(
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
                    'tanggal' => gmdate('Y-m-d'),
                    'user_id' => auth()->user()->id,
                    'no_1' => $row['no_1'],
                    'no_2' => $row['no_2'],
                    'no_3' => $row['no_3'],
                    'no_4' => $row['no_4'],
                    'no_5' => $row['no_5'],
                    'no_6' => $row['no_6'],
                    'no_7' => $row['no_7'],
                    'no_8' => $row['no_8'],
                    'no_9' => $row['no_9'],
                    'no_10' => $row['no_10'],
                    'nilai' => $row['nilai'],
                ]
                );
        }
    }
}
