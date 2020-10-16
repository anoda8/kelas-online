<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru;
use App\Models\KelasOnline;
use App\Models\LogKelasOnline;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $coba;
    public $judul;
    public $kelon_perpage = 10;

    public function mount()
    {
        $this->judul = "Beranda";
    }

    public function render()
    {
        $jumlah_siswa = Siswa::count();
        $jumlah_guru = Guru::count();
        $jumlah_kelon = KelasOnline::whereDate('wkt_masuk', date("Y-m-d"))->count();
        $jumlah_aktif = LogKelasOnline::where('status', true)->count();
        $kelon = KelasOnline::whereDate('wkt_masuk', date("Y-m-d"))->with(['kelas', 'mapel', 'author', 'log'])->paginate($this->kelon_perpage);
        $pengumuman = Pengumuman::where('tujuan', 'all')->with(['author', 'komentar'])->latest()->take(3)->get();

        $userid = User::where('name', 'like%', 'Guru')->get()->first()->id;
        dd($userid);
        return view('livewire.admin.dashboard', [
            'jumlah' => [
                'siswa' => $jumlah_siswa,
                'guru' => $jumlah_guru,
                'kelon' => $jumlah_kelon,
                'siswaAktif' => $jumlah_aktif
            ],
            'data' => [
                'kelon' => $kelon,
                'pengumuman' => $pengumuman
            ]
        ]);
    }
}
