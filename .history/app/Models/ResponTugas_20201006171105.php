<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponTugas extends Model
{
    use HasFactory;

    protected $table = 'respon_tugas';

    protected $fillable = [
        'tugas_id', 'author_id', 'jawaban', 'videopath', 'file', 'nilai', 'komentar'
    ];

    public function tugas()
    {
        return $this->belongsTo('App\Models\Tugas', 'tugas_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}
