<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogKelasOnline extends Model
{
    use HasFactory;

    protected $table = 'log_kelasonline';

    protected $fillable = [
        'kelon_id', 'user_id', 'wkt_keluar', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function kelon()
    {
        return $this->belongsTo('App\Models\KelasOnline', 'kelon_id');
    }
}
