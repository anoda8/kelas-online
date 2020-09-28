<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mapel;
use Livewire\Component;

class Pembelajaran extends Component
{
    public $mapel;
    public $list_mapel, $list_kelas;

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
        $this->list_mapel = Mapel::all();
    }

    public function render()
    {
        return view('livewire.admin.pembelajaran', [
            'mapels' => $this->mapel
        ]);
    }
}
