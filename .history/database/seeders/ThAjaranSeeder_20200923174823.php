<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thajaran')->insert([
            'kode' => '20211',
            'keterangan' => 'Tahun Pelajaran 2020/2021 Semester 1',
            'semester' => 1
        ]);
    }
}
