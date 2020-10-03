<?php

namespace App\Http\Livewire\Guru;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Pengumuman extends Component
{
    public $jurusanid, $kelasid, $tujuan, $judul, $isipengumuman, $tanggal, $waktu;

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
        $kelases    = Kelas::where('thajaran', session('thajaran'))->get();
        $jurusans   = Jurusan::where('thajaran', session('thajaran'))->get();
        return view('livewire.guru.pengumuman',[
            'kelases' => $kelases, 'jurusans' => $jurusans
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required',
            'isipengumuman' => 'required'
        ]);

        if(($this->jurusanid == '') && ($this->kelasid == '') && ($this->tujuan == '')){
            throw ValidationException::withMessages(['tujuanumum' => 'Pilih salah satu tujuan !!']);
        }

    }

    public function ubahSemua($value)
    {
        dd($value);
    }
}
