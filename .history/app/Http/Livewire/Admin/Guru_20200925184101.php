<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Guru extends Component
{
    public $user_id, $nama, $nik, $nip;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Guru",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.guru', [
            'gurus' => Guru::all()
        ]);
    }
}
