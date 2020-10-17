<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Guru
        // $users = User::where('name', 'like', 'Guru%')->get();
        // foreach ($users as $user) {
        //     $user->attachRole('guru');
        // }
        //Siswa
        $users = User::where('name', 'not like', 'Guru%')->where('email', 'not like', 'admin')->get();
        foreach ($users as $user) {
            $user->attachRole('siswa');
        }
    }
}
