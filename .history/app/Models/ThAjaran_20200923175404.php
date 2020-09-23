<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThAjaran extends Model
{
    use HasFactory;

    protected $table = 'thajaran';

    protected $fillable = [
        'kode',
        'keterangan',
        'semester',
    ];

    protected $attributes = [
        'status' => 0
    ];


}
