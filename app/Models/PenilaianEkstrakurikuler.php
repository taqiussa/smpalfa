<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianEkstrakurikuler extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ekstra()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id')->withDefault();
    }
    public function siswa()
    {
        return $this->belongsTo(User::class, 'nis', 'nis')->withDefault();
    }
}
