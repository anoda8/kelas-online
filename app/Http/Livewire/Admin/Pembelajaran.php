<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Mapel;
use Livewire\Component;

class Pembelajaran extends Component
{
    public $mapel, $kelas;
    public $mapel_terpilih = [
        'id' => '',
        'nama' => '',
        'guru' => ''
    ];

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Pembelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $mapel = Mapel::with(['guru'])->get();
        $kelas = Kelas::with(['jurusan'])->get();
        return view('livewire.admin.pembelajaran', [
            'mapels' => $mapel, 'kelases' => $kelas
        ]);
    }

    public function pilihMapel($id, $mapel, $guru)
    {
        $this->mapel_terpilih['id'] = $id;
        $this->mapel_terpilih['mapel'] = $mapel;
        $this->mapel_terpilih['guru'] = $guru;
        dd($this->mapel_terpilih);
    }
}
