<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaEkstra extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function ekstra()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id')->withDefault();
    }
}
