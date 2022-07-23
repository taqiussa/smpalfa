<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkDetail extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];
    public function bk(){
        return $this->belongsTo(Bk::class);
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function siswa()
    {
        return $this->belongsTo(User::class, 'nis', 'nis')->withDefault();
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class)->withDefault();
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user_name'
            ]
        ];
    }
    public function getRouteKeyName()

    {

        return 'slug';

    }
}
