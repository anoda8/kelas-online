<?php

namespace App\Http\Livewire\Guru;

use App\Models\KelasOnline;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Detail Kelas",
            'keterangan' => ""
        ];
    }

    public function mount($kelonid){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->kelonid = $kelonid;
    }

    public function render()
    {
        $kelons = KelasOnline::find($this->kelonid);
        return view('livewire.guru.detail-kelas-online');
    }
}
