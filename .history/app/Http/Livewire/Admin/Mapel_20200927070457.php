<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Mapel extends Component
{
    public $user_id, $author_id, $nama;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Mata Pelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.mapel');
    }
}
