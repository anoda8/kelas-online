<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jurusan as ModelsJurusan;
use Livewire\Component;

class Jurusan extends Component
{
    public $nama, $singkat, $tingkat;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Jurusan / Tingkat",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.jurusan');
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'singkat' => 'required',
            'tingkat' => 'required'
        ]);

        ModelsJurusan::updateOrCreate([
            'singkat' => $this->singkat,
            'tingkat' => $this->tingkat
        ],[
            'nama' => $this->nama,
            'singkat' => $this->singkat,
            'tingkat' => $this->tingkat
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->nama = '';
        $this->singkat = '';
        $this->tingkat = '';
    }
}
