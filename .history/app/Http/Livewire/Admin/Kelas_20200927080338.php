<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jurusan;
use App\Models\Kelas as ModelsKelas;
use Illuminate\Support\Facades\Auth;
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

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'jurusan' => 'required'
        ]);

        ModelsKelas::create([
            'nama' => $this->nama,
            'jurusan_id' => $this->jurusan,
            'author_id' => Auth::id()
        ]);


    }
}
