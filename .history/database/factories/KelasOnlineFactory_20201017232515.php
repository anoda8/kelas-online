<?php

namespace Database\Factories;

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
        $pemblJrn = Pembelajaran::all()->random();
        $mapelId = $pemblJrn->mapel_id;
        $kelasId = $pemblJrn->kelas_id;
        $mapel = Mapel::where('id', $mapelId)->with(['guru.user'])->get()->first();
        $authorId = $mapel->guru->author->id;
        $startTime = $this->faker->dateTimeBetween('now', '+10 days')->format("Y-m-d H:i:s");
        $endTime = date("Y-m-d H:i:s", strtotime($startTime) + 2 * 60 * 60);

        return [
            'kelas_id' => $kelasId,
            'mapel_id' => $mapelId,
            'materi' => $this->faker->sentence(),
            'isi_materi' => $this->faker->realText(500),
            'video_path' => '<iframe width="853" height="480" src="https://www.youtube.com/embed/2RMri0OF3bI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'wkt_masuk' => $startTime,
            'wkt_selesai' => $endTime,
            'author_id' => $authorId
        ];
    }
}
