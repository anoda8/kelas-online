<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'guru_id',
        'author_id',
        'nama'
    ];

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'guru_id');
    }

}
