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
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelon = KelasOnline::where('kelas_id');
        return view('livewire.siswa.dashboard');
    }
}
