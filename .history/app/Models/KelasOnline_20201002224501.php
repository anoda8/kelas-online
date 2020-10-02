<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasOnline extends Model
{
    use HasFactory;

    protected $table = 'kelasonline';

    protected $fillable = [
        'kelas_id', 'mapel_id', 'materi', 'isi_materi', 'video_path', 'wkt_masuk', 'wkt_selesai', 'author_id'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function getWktMasukAttribute($value)
    {
        return \Carbon\Carbon::parse($this->attributes['wkt_masuk'])->format('d, m Y H:i');
    }
}
