<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guru;
use App\Models\Mapel as ModelsMapel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mapel extends Component
{
    public $guru, $author_id, $nama;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Mata Pelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $mapels = ModelsMapel::with(['guru', 'author'])->get();
        $gurus = Guru::all();
        return view('livewire.admin.mapel', [
            'mapels' => $mapels, 'gurus' => $gurus
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'guru' => 'required'
        ]);

        ModelsMapel::create([
            'guru_id' => $this->guru,
            'author_id' => Auth::id(),
            'nama' => $this->nama
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->nama = '';
        $this->guru = '';
        $this->author_id = '';
    }

    public function hapus($id)
    {
        $mapel = ModelsMapel::find($id);
        $nama = $mapel->nama;
        $mapel->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil mennghapus '.$nama]);
    }

    public function export(Type $var = null)
    {
        # code...
    }
}
