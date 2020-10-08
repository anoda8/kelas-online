<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru;
use App\Models\Siswa;
use Livewire\Component;

class Dashboard extends Component
{
    public $coba;
    public $judul;

    public function mount()
    {
        $this->judul = "Beranda";
    }

    public function render()
    {
        $jumlah_siswa = Siswa::count();
        $jumlah_guru = Guru::count();
        return view('livewire.admin.dashboard', [
            'jumlah' => [
                'siswa' => $jumlah_siswa, 'guru' => $jumlah_guru
            ]
        ]);
    }
}
