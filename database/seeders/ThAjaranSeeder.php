<?php

namespace Database\Seeders;

use App\Models\ThAjaran;
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
        ThAjaran::insert([
            'kode' => '20211',
            'keterangan' => 'Tahun Pelajaran 2020/2021 Semester 1',
            'semester' => 1,
            'status' => true
        ]);

        ThAjaran::insert([
            'kode' => '20212',
            'keterangan' => 'Tahun Pelajaran 2020/2021 Semester 2',
            'semester' => 2,
            'status' => false
        ]);
    }
}
