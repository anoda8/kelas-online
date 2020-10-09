<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\KelasOnline;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $kelas, $siswa;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Dashboard",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $jumlah_kelon = KelasOnline::where('kelas_id', $this->kelas->id)->count();
        $jumlah_tugas = Tugas::where('kelas_id', $this->kelas->id)->count();
        $pengumuman = Pengumuman::where('kelas_id', $this->kelas->id)->with(['author', 'komentar'])->latest()->take(3)->get();
        $tugas = Tugas::where('kelas_id', $this->kelas->id)->with(['author'])->latest()->take(3)->get();
        $kelon = KelasOnline::where('kelas_id', $this->kelas->id)->whereDate('wkt_masuk', date("Y-m-d"))->with(['kelas', 'mapel', 'author'])->get();

        return view('livewire.siswa.dashboard', [
            'jumlah' => [
                'kelon' => $jumlah_kelon,
                'tugas' => $jumlah_tugas
            ],
            'data' => [
                'pengumuman' => $pengumuman,
                'kelon' => $kelon
            ]
        ]);
    }
}
