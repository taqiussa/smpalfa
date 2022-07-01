<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurikulumMapel extends Model
{
    use HasFactory;
    protected $table = 'kurikulum_mata_pelajaran';
    protected $guarded = [];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

}
