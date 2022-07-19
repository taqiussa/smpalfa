<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'nis', 'nis')->withDefault();
    }
    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class, 'nis', 'nis')->withDefault();
    }
    public function wali()
    {
        return $this->belongsTo(Wali::class, 'nis', 'nis')->withDefault();
    }
    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'nis', 'nis')->withDefault();
    }
}
