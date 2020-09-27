<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jurusan;
use Livewire\Component;

class Kelas extends Component
{
    public $nama, $jurusan, $author;


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
        $jurusans = Jurusan::all();
        return view('livewire.admin.kelas',[
            'jurusans' => $jurusans
        ]);
    }
}
