<?php

namespace App\Http\Livewire\Admin;

use App\Models\KelasOnline as ModelsKelasOnline;
use Livewire\Component;
use Livewire\WithPagination;

class KelasOnline extends Component
{
    use WithPagination;
    public $perpage = 50;
    public $heading;
    public function heading()
    {
        return [
            'judul' => "Monitoring Kelas Online",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $kelon = ModelsKelasOnline::with(['kelas', 'mapel', 'author', 'komen', 'log'])->latest();
        return view('livewire.admin.kelas-online',[
            'kelons' => $kelon
        ]);
    }
}
