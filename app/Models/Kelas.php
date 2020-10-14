<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama', 'jurusan_id', 'author_id', 'thajaran'
    ];

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan', 'jurusan_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Models\Siswa', 'kelas_id');
    }
}
