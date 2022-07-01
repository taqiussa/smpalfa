<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsToMany(User::class, 'guru_mata_pelajaran');
    }

    public function kkm()
    {
        return $this->hasMany(Kkm::class);
    }
}
