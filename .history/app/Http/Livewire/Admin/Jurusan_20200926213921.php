<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Jurusan extends Component
{
    public $heading;
    public function heading()
    {
        return [
            'judul' => "Jurusan",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.jurusan');
    }
}
