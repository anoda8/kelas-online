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
    public $loginUser;

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
        $this->loginUser = 'nip';
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

        $this->updateCreateUser();

    }

    public function edit()
    {

    }

    public function updateCreateUser()
    {
        $user = User::updateOrCreate([
            $this->loginUser = $this->$this->loginUser
        ],[
            'nama' => $this->nama,
            'email' => $this->nip,
            'password' => Hash::make($this->$this->loginUser)
        ]);
    }


}
