<?php

namespace App\Http\Livewire\Guru;

use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
            'keterangan' => ""
        ];
    }

    public function mount($kelonid)
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->kelonid = $kelonid;
    }

    public function render()
    {
        return view('livewire.guru.detail-kelas-online');
    }
}
