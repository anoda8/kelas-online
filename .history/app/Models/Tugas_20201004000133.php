<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'mapel_id'  ,
        'kelas_id'  ,
        'author_id' ,
        'judul'     ,
        'deskripsi' ,
        'videopath' ,
        'file'      ,
    ];

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }

    public function author()
    {
        reutrn $this->belongsTo('App\Models\User', 'author_id');
    }
}
