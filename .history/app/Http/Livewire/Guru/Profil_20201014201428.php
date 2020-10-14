<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profil extends Component
{
    public $fileimport;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Profil Guru",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->guruid = Guru::where('user_id', Auth::id())->get()->first()->id;
    }

    public function render()
    {
        return view('livewire.guru.profil');
    }
}
