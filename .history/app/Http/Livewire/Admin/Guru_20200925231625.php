<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru as ModelsGuru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Guru extends Component
{
    public $user_id, $nama, $nik, $nip;
    public $modeEdit = false;
    public $buatUser = 'checked';
    public $loginUser = 'nip';

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

        $user = User::updateOrCreate([
            'email' => $this->nip
        ],[
            'nama' => $this->nama,
            'email' => $this->nip,
            'password' => Hash::make($this->nip)
        ]);

        $user->attachRole('guru');

        $guru = ModelsGuru::updateOrCreate([
            'nik' => $this->nik
        ],[
            'nama' => $this->nama,
            'nip' => $this->nip,
            'nik' => $this->nik,
            'user_id' => $user->id
        ]);


        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->celarForm();
    }

    public function celarForm()
    {
        $this->nama = '';
        $this->nik = '';
        $this->nip = '';
    }

}
