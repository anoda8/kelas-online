<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester;

    public function render()
    {
        return view('livewire.admin.setting');
    }
}
