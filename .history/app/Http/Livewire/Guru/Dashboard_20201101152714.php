<?php

namespace App\Http\Livewire\Guru;

use App\Models\KelasOnline;
use App\Models\Pengumuman;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Beranda",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $jumlah_kelon = KelasOnline::where('author_id', Auth::id())->count();
        $jumlah_tugas = Tugas::where('author_id', Auth::id())->count();
        $kelon = KelasOnline::where('author_id', Auth::id())->whereDate('wkt_masuk', '<', date('Y-m-d', strtotime(date('Y-m-d') . " +1 day")))->get();
        $peng = Pengumuman::orWhere('tujuan', 'guru')->orWhere('tujuan', 'all')->orWhere('author_id', Auth::id())->take(2)->get();

        return view('livewire.guru.dashboard', [
            'jumlah' => [
                'kelon' => $jumlah_tugas,
                'tugas' => $jumlah_kelon
            ],
            'data' => [
                'kelon' => $kelon,
                'pengumuman' => $peng
            ]
        ]);
    }
}
