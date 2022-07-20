<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAlquran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function siswa()
    {
        return $this->belongsTo(User::class,'nis', 'nis');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriAlquran::class, 'kategori_alquran_id');
    }
    public function jenis()
    {
        return $this->belongsTo(JenisAlquran::class, 'jenis_alquran_id');
    }
}
