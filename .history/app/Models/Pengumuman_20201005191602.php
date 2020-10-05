<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'jurusan_id', 'kelas_id', 'author_id', 'tujuan', 'judul', 'isi_pengumuman', 'published_at'
    ];

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function komentar()
    {
        return $this->hasMany('App\Models\KomenPengumuman', 'peng_id');
    }
}
