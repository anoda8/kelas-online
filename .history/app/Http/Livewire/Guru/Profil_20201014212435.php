<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profil extends Component
{
    public $fileimport;
    public $nama, $email, $pass, $repass, $fotoprofil;

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

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'pass' => 'required|min:6',
            'repass' => 'required_with:pass|same:pass'
        ]);

        $user = User::find(Auth::id());
        $user->name = $this->nama;
        $user->pass = Hash::make($this->pass);
        $user->save();

        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil mengubah profil !');
    }
}
