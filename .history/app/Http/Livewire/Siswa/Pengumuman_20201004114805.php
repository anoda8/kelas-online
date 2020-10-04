<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Pengumuman as ModelsPengumuman;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pengumuman extends Component
{
    public $siswa;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Pengumuman",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->siswa = Siswa::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        // ModelsPengumuman::where('')
        return view('livewire.siswa.pengumuman');
    }
}
