<?php

namespace Database\Factories;

use App\Models\KelasOnline;
use App\Models\Komentar;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KomentarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Komentar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pemblJrn = Pembelajaran::all()->random();
        $mapelId = $pemblJrn->mapel_id;
        $kelasId = $pemblJrn->kelas_id;
        $kelon = KelasOnline::where(['kelas_id' => $kelasId, 'mapel_id' => $mapelId])->get()->random();
        $siswa = Siswa::where('kelas_id', $kelasId)->get()->random();
        return [
            'kelon_id' => $kelon->id,
            'author_id' => $siswa->user_id,
            'komentar' => $this->faker->sentence(10)
        ];
    }
}
