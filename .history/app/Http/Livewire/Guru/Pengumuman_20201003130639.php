<?php

namespace App\Http\Livewire\Guru;

use App\Models\Jurusan;
use App\Models\Kelas;
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


    }

    public function ubahKelompok($tipe, $value)
    {
        switch ($tipe) {
            case 'semua':
                $this->kelasid = null;
                $this->jurusanid = null;
                $this->tujuan = $value;
                break;
            case 'jurusan':
                $this->kelasid = null;
                $this->jurusanid = $value;
                $this->tujuan = null;
                dd( $this->tujuan);
                break;
            case 'kelas':
                $this->kelasid = $value;
                $this->jurusanid = null;
                $this->tujuan = null;
                break;
            default:
                # code...
                break;
        }
    }
}
