<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Tugas as ModelsTugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tugas extends Component
{
    public $guruid, $mapelid, $kelasid, $judTugas, $deskripsi, $dokumen, $videopath;
    public $editId = null;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Tugas",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->guruid = Guru::where('user_id', Auth::id())->get()->first()->id;
    }

    public function render()
    {
        $mapel = Mapel::where('thajaran', session('thajaran'))->where('guru_id', $this->guruid)->with(['guru'])->get();
        $pembl = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->mapelid)->with(['kelas'])->get();
        return view('livewire.guru.tugas',[
            'mapels' => $mapel, 'pembelajaran' => $pembl
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'mapelid' => 'required',
            'kelasid'  => 'required',
            'judTugas'  => 'required',
            'deskripsi'  => 'required'
        ]);

        ModelsTugas::create([
            'mapel_id' => $this->mapelid,
            'kelas_id' => $this->kelasid,
            'author_id' => Auth::id(),
            'judul' => $this->judTugas,
            'deskripsi' => $this->deskripsi,
            'videopath' => $this->videopath,
            'file' => $this->dokumen
        ]);
    }

    public function clearForm()
    {
        $this->mapelid = '';
        $this->kelasid = '';
        $this->judTugas = '';
        $this->deskripsi = '';
        $this->dokumen = '';
        $this->videopath = '';
        $this->editId = null;
    }


}
