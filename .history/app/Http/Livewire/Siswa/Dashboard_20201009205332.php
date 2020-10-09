<?php

namespace App\Http\Livewire\Siswa;

use App\Models\KelasOnline;
use Livewire\Component;

class Dashboard extends Component
{
    public $kelasid;

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
    }

    public function render()
    {
        $kelon = KelasOnline::where('kelas_id');
        return view('livewire.siswa.dashboard');
    }
}
