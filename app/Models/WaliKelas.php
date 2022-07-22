<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;
    protected $table = 'kelas_wali_kelas';

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
