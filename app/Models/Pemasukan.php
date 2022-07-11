<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function gunabayar()
    {
        return $this->belongsTo(Gunabayar::class, 'gunabayar_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPemasukan::class, 'kategori_pemasukan_id');
    }
}
