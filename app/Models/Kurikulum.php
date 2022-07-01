<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mapels($tahun, $tingkat)
    {
        return $this->belongsToMany(MataPelajaran::class)->wherePivot('tahun', $tahun)->wherePivot('tingkat', $tingkat);
    }
}
