<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mapel as ModelsMapel;
use App\Models\User;
use Livewire\Component;

class Mapel extends Component
{
    public $guru, $author_id, $nama;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Mata Pelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $gurus = User::whereHas('roles', function($q){
            $q->where('name', 'guru');
        })->get();
        return view('livewire.admin.mapel', [
            'gurus' => $gurus
        ]);
    }

    public function simpan()
    {
        ModelsMapel::create([
            'user_id' => $this->user_id,
            'author_id' => $this
        ]);
    }
}
