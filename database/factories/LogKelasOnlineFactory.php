<?php

namespace Database\Factories;

use App\Models\KelasOnline;
use App\Models\LogKelasOnline;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LogKelasOnlineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogKelasOnline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Pindah ke seeder
        // $pemblJrn = Pembelajaran::all()->random();
        // $mapelId = $pemblJrn->mapel_id;
        // $kelasId = $pemblJrn->kelas_id;
        // $kelon = KelasOnline::where(['kelas_id' => $kelasId, 'mapel_id' => $mapelId])->get()->random();
        // $siswa = Siswa::where('kelas_id', $kelasId)->get()->random();

        // return [
        //     'kelon_id' => $kelon->id,
        //     'user_id' => $kelon->author_id,
        //     'siswa_id' => $siswa->id,
        //     'wkt_keluar' => date('Y-m-d H:i:s', strtotime($kelon->wkt_masuk) + (3600)),
        //     'created_at' => $kelon->wkt_masuk,
        //     'status' => false
        // ];
    }
}
