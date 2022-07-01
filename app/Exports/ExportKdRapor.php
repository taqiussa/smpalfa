<?php

namespace App\Exports;

use App\Models\JenisPenilaian;
use App\Models\KategoriNilai;
use App\Models\KurikulumMapel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportKdRapor implements FromView
{
    private $tahun;
    private $semester;
    private $tingkat;
    private $kategori_nilai_id;
    private $jenis_penilaian_id;
    public function __construct($tahun, $semester, $tingkat, $kategori_nilai_id, array $jenis_penilaian_id)
    {
        $this->tahun = $tahun;
        $this->semester = $semester;
        $this->tingkat = $tingkat;
        $this->kategori_nilai_id = $kategori_nilai_id;
        $this->jenis_penilaian_id = $jenis_penilaian_id;
    }
    public function view(): View
    {
        return view(
            'exports.export-kd-rapor',
            [
                'list_mata_pelajaran' => KurikulumMapel::join('mata_pelajarans', 'mata_pelajarans.id', '=', 'kurikulum_mata_pelajaran.mata_pelajaran_id')
                    ->where('tahun', $this->tahun)
                    ->where('tingkat', $this->tingkat)
                    ->select(
                        'mata_pelajarans.id as id',
                        'mata_pelajarans.nama as nama',
                    )
                    ->get(),
                'list_jenis_penilaian' => JenisPenilaian::whereIn('id', $this->jenis_penilaian_id)->get(),
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'tingkat' => $this->tingkat,
                'nama_kategori' => KategoriNilai::find($this->kategori_nilai_id)->nama,
                'kategori_nilai_id' => $this->kategori_nilai_id
            ]
        );
    }
}
