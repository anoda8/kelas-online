<?php

namespace Database\Seeders;

use App\Models\KelasOnline;
use App\Models\LogKelasOnline;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class LogKelasOnlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $pemblJrn = Pembelajaran::all()->random();
        // $mapelId = $pemblJrn->mapel_id;
        // $kelasId = $pemblJrn->kelas_id;
        // $kelons = KelasOnline::all();
        // foreach($kelons as $kelon){
        //     $siswas = Siswa::where('kelas_id', $kelon->kelas_id)->get();
        //     foreach($siswas as $siswa){
        //         LogKelasOnline::create([
        //             'kelon_id' => $kelon->id,
        //             'user_id' => $kelon->author_id,
        //             'siswa_id' => $siswa->id,
        //             'wkt_keluar' => date('Y-m-d H:i:s', strtotime($kelon->wkt_masuk) + (3600)),
        //             'created_at' => $kelon->wkt_masuk,
        //             'status' => false
        //         ]);
        //     }
        // }
    }
}
