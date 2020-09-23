<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester, $tambah_status = 0, $coba;

    public function render()
    {
        return view('livewire.admin.setting');
    }

    public function store()
    {
        $this->validatedDate = $this->validate([
            'tambah_tahun' => 'required|numeric',
            'tambah_semester' => 'required'
        ]);

        $this->emit('thAjaranStore');
    }
}
