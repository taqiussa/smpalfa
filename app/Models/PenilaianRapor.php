<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianRapor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriNilai::class, 'kategori_nilai_id');
    }

    public function jenis_penilaian()
    {
        return $this->belongsTo(JenisPenilaian::class, 'jenis_penilaian_id');
    }
}
