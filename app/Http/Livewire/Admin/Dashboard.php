<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $coba;
    public $judul;

    public function mount()
    {
        $this->judul = "Beranda";
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
