<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tugas extends Component
{
    public $guruid, $mapelid, $kelasid, $judTugas, $deskripsi, $dokumen;

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
        $pembl = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->mapelid)->with(['kelas'])->get();
        return view('livewire.guru.tugas',[
            'mapels' => $mapel, 'pembelajaran' => $pembl
        ]);
    }
}
