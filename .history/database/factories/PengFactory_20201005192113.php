<?php

namespace Database\Factories;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengumuman::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jurusanId = Jurusan::all()->random()->id;
        $kelasId = Kelas::where('id', $jurusanId)->get()->random()->id;

        return [
            'jurusan_id' => ,
            'kelas_id' => ,

        ];
    }
}
