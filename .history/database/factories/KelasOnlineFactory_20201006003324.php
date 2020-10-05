<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\KelasOnline;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KelasOnlineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KelasOnline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kelasId = Kelas::all()->random()->id;
        $mapelId = Pembelajaran::where('kelas_id', $kelasId)->get()->random()->mapel_id;
        $startTime = $this->faker->dateTimeBetween('now', '+100 days')->format("Y-m-d H:i:s");
        $endTime = date("Y-m-d H:i:s", strtotime($startTime) + 3 * 60 * 60);
        return [
            'kelas_id' => $kelasId,
            'mapel_id' => $mapelId,
            'materi' => $this->faker->sentence(),
            'isi_materi' => $this->faker->realText(500),
            'video_path' => "https://www.youtube.com/watch?v=Tfaq4UTH7P0&list=RDTfaq4UTH7P0&start_radio=1",
            'wkt_masuk' => $this->faker->dateTimeBetween('now', '+100 days'),

        ];
    }
}
