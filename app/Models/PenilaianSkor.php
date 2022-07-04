<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSkor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function skors()
    {
        return $this->belongsTo(Skor::class,'skor_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
