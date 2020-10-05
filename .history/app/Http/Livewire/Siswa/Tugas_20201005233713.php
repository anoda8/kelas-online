<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tugas extends Component
{
    public $siswa, $kelas;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Tugas",
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
        return view('livewire.siswa.tugas');
    }
}
