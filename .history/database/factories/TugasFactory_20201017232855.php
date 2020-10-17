<?php

namespace Database\Factories;

use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Tugas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TugasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tugas::class;

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
        return [
            'mapel_id'  => $mapelId,
            'kelas_id'  => $kelasId,
            'author_id' => $authorId,
            'judul'     => $this->faker->sentence(),
            'deskripsi' => $this->faker->realText(500),
            'videopath' => "<iframe width="853" height="480" src="https://www.youtube.com/embed/2RMri0OF3bI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>",
            'file'      => 'document.docx',
        ];
    }
}
