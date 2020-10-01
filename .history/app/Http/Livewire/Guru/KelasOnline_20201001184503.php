<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KelasOnline extends Component
{
    public $mapelid, $kelasid, $materi, $isimateri, $wktmulai, $wktselesai, $tgl_kelon;
    public $guruid;
    public $formopen = false;
    public $fileimport;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
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
        return view('livewire.guru.kelas-online',[
            'mapels' => $mapel, 'pembelajaran' => $pembl
        ]);
    }

    public function formToggle()
    {
        $this->formopen == true ?? false;
    }

    public function simpan()
    {
        $this->validate([
            'tgl_kelon' => 'required',
            'mapelid' => 'required',
            'kelasid' => 'required',
            'materi' => 'required',
            'isimateri' => 'required',
            'wktmulai' => 'required',
            'wktselesai' => 'required'
        ]);

        $this->clearForm();
        $this->emit('closeAddForm');

    }

    public function clearForm()
    {
        $this->tgl_kelon = '';
        $this->mapelid = '';
        $this->kelasid = '';
        $this->materi = '';
        $this->isimateri = '';
        $this->wktmulai = '';
        $this->wktselesai = '';
    }
}
