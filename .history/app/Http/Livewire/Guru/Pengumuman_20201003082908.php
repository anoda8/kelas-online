<?php

namespace App\Http\Livewire\Guru;

use Livewire\Component;

class Pengumuman extends Component
{
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
    }

    public function render()
    {
        return view('livewire.guru.pengumuman');
    }
}
