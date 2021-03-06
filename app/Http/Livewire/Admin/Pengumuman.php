<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pengumuman as ModelsPengumuman;
use Livewire\Component;
use Livewire\WithPagination;

class Pengumuman extends Component
{
    use WithPagination;
    public $perpage = 5;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Pengumuman",
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
        $pengumuman = ModelsPengumuman::with(['author', 'komentar'])->latest()->paginate($this->perpage);
        return view('livewire.admin.pengumuman',[
            'pengumuman' => $pengumuman
        ]);
    }
}
