<?php

namespace App\Http\Livewire\Admin;

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
        return view('livewire.admin.dashboard', [
            'jumlah_siswa' => $jumlah_siswa
        ]);
    }
}
