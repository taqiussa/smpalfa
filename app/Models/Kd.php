<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kd extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeJoins($query, $tahun)
    {
        return $query->join('mata_pelajarans', 'mata_pelajarans.id', '=', 'kds.mata_pelajaran_id')
                    ->join('kategori_nilais', 'kategori_nilais.id', '=', 'kds.kategori_nilai_id')
                    ->join('jenis_penilaians', 'jenis_penilaians.id', '=', 'kds.jenis_penilaian_id')
                    ->where('kds.tahun', $tahun)
                    ->select(
                        'kds.id as id',
                        'mata_pelajarans.nama as nama_mata_pelajaran',
                        'kategori_nilais.nama as nama_kategori_nilai',
                        'jenis_penilaians.nama as nama_jenis_penilaian',
                        'kds.tahun as tahun',
                        'kds.semester as semester',
                        'kds.tingkat as tingkat',
                        'kds.deskripsi as deskripsi'
                    )
                    ->orderBy('tahun', 'desc')
                    ->orderBy('semester')
                    ->orderBy('tingkat')
                    ->orderBy('mata_pelajarans.nama')
                    ->orderBy('kategori_nilais.nama')
                    ->orderBy('jenis_penilaians.nama');
    }
}
