<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Kelas extends Component
{
    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Kelas",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        // $kelases =
        return view('livewire.admin.kelas');
    }
}
