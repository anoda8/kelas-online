<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester, $tambah_status = 0;

    public function render()
    {
        return view('livewire.admin.setting');
    }
}
