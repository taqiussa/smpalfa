<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'nis', 'nis')->withDefault();
    }
    public function bendahara()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }
    public function gunabayar()
    {
        return $this->belongsTo(Gunabayar::class)->withDefault();
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class)->withDefault();
    }
}
