<?php

namespace App\Console\Commands;

use App\Models\LogKelasOnline;
use Illuminate\Console\Command;

class ClearSiswaAktif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hapus:siswaaktif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek siswa aktif keluar kelas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $siswaaktif = LogKelasOnline::where('status', true)->get();

        foreach ($siswaaktif as $log) {
            LogKelasOnline::where('id', $log->id)->update(['status' => false]);
        }
        $this->info("log kelas online telah dibersihakn !" . $siswaaktif->count());
    }
}
