<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function wali_kelas($tahun)
    {
        return $this->belongsToMany(User::class, 'kelas_wali_kelas', 'kelas_id', 'user_id')
        ->wherePivot('tahun', $tahun);
    }
}
