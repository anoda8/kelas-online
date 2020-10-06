<?php

namespace App\Http\Livewire\Guru;

use App\Models\Tugas;
use Livewire\Component;

class DetailTugas extends Component
{
    public $tugasid;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Detail Tugas",
            'keterangan' => ""
        ];
    }

    public function mount($tugasid){
        $this->level = request()->segment(3);
        $this->tugasid = $tugasid;
    }

    public function render()
    {
        $tugas = Tugas::where('id', $this->tugasid)->with(['kelas', 'mapel'])->get()->first();
        $this->heading = [
            'judul' => "Tugas ".$tugas->kelas->nama." [".$tugas->mapel->nama."]",
            'keterangan' => $tugas->judul
        ];
        return view('livewire.guru.detail-tugas', [
            'tugas' => $tugas
        ]);
    }
}
