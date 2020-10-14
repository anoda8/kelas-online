<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profil extends Component
{
    use WithFileUploads;

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
        $user = User::find(Auth::id());
        $this->nama = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.guru.profil');
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'pass' => 'nullable|min:6',
            'repass' => 'sometimes|required_with:pass|same:pass'
        ]);

        $fullpath = '';
        if ($this->fileimport != null) {
            $namafile = $this->email . $this->fileimport->extension();
            $fullpath = 'storage/kelasonline/' . Auth::user()->name . '/' . $namafile;
            $this->fileimport->storeAs('public/kelasonline/' . Auth::user()->name . '/' . $namafile);
        }

        $user = User::find(Auth::id());
        $user->name = $this->nama;
        $user->password = Hash::make($this->pass);
        $user->foto_profil = $fullpath;
        $user->save();

        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil mengubah profil !']);
    }
}
