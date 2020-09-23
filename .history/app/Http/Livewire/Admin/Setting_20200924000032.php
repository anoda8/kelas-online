<?php

namespace App\Http\Livewire\Admin;

use App\Models\ThAjaran;
use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester, $tambah_status = 0, $coba;

    public function mount()
    {

    }

    public function render()
    {
        $data['list_thajaran'] = ThAjaran::all();
        return view('livewire.admin.setting', $data);
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
