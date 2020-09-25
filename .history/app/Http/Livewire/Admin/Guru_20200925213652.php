<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru as ModelsGuru;
use Livewire\Component;

class Guru extends Component
{
    public $user_id, $nama, $nik, $nip;
    public $modeEdit = false;
    public $buatUser = 'checked';

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Guru",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.guru', [
            'gurus' => ModelsGuru::with('user')->get()
        ]);
    }

    public function simpan()
    {
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'nik' => 'required'
        ]);

        $guru = ModelsGuru::updateOrCreate([
            'nik' => $this->nik
        ],[
            'nama' => $this->nama,
            'nip' => $this->nip,
            'nik' => $this->nik
        ]);


    }

    public function edit()
    {

    }


}
