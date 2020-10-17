<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'siswa');
        })->get();

        $faker = \Faker\Factory::create();

        foreach ($users as  $user) {
            Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => null,
                'nama' => $user->name,
                'tgl_lahir' => $faker->date(),
                'nis' => $user->email,
                'jenkel' => $faker->randomElement(['L', 'P'])
            ]);
        }
    }
}
