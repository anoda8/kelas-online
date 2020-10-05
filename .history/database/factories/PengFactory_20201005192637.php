<?php

namespace Database\Factories;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\User;
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
        $authorId = User::whereHas('roles', function ($q) {
            $q->where('name', 'guru');
        })->get()->random()->id;

        return [
            'jurusan_id' => Jurusan::all()->random()->id,
            'kelas_id' => null,
            'author_id' => $authorId,

        ];
    }
}
