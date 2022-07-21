<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(BkDetail::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
