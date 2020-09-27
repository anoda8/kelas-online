<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    use HasFactory;

    protected $table = 'pembelajaran';

    protected $fillable = [
        'mapel_id', 'kelas_id', 'author_id', 'thajaran'
    ];
}
