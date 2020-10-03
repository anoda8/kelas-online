<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tugas extends Component
{
    public $guruid, $mapelid;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Tugas",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->guruid = Guru::where('user_id', Auth::id())->get()->first()->id;
    }

    public function render()
    {
        $mapel = Mapel::where('thajaran', session('thajaran'))->where('guru_id', $this->guruid)->with(['guru'])->get();
        return view('livewire.guru.tugas',[
            'mapels' => $mapel
        ]);
    }
}
