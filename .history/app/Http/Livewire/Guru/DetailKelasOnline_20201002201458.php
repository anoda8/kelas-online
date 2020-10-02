<?php

namespace App\Http\Livewire\Guru;

use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;

    public function mount($kelonid)
    {
        $this->kelonid = $kelonid;
    }

    public function render()
    {
        return view('livewire.guru.detail-kelas-online');
    }
}
