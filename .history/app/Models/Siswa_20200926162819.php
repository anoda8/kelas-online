<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'user_id', 'kelas_id', 'nama', 'tgl_lahir', 'nis'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }
}
