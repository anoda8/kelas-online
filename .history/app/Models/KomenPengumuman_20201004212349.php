<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomenPengumuman extends Model
{
    use HasFactory;

    protected $table = 'komen_pengumuman';

    protected $fillable = [
        'kelon_id', 'author_id', 'komentar'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function kelon()
    {
        $this->belongsTo('App\Models\KelasOnline', 'kelon_id');
    }
}
