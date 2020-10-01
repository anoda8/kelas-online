<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\KelasOnline as ModelsKelasOnline;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KelasOnline extends Component
{
    public $mapelid, $kelasid, $materi, $isimateri, $wktmulai, $wktselesai, $tgl_kelon, $videopath;
    public $guruid;
    public $formopen = false;
    public $dokumen;
    public $editId = null;
    public $kataKunciMateri;

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
        $kelons = ModelsKelasOnline::where('author_id', Auth::id())->where('materi', 'like', '%'.$this->kataKunciMateri.'%')
        ->with(['kelas', 'mapel', 'author'])->latest()->get();
        return view('livewire.guru.kelas-online',[
            'mapels' => $mapel, 'pembelajaran' => $pembl, 'kelons' => $kelons
        ]);
    }

    public function formToggle()
    {
        $this->formopen == true ?? false;
    }

    public function simpan()
    {
        $this->emitUp('postCkEditor');
        $this->validate([
            'tgl_kelon' => 'required',
            'mapelid' => 'required',
            'kelasid' => 'required',
            'materi' => 'required',
            'isimateri' => 'required',
            'wktmulai' => 'required',
            'wktselesai' => 'required',
            'dokumen' => '',
            'videopath' => '',
        ]);

        // dd($this->tgl_kelon." ".$this->wktmulai.":00");

        if($this->editId != null){
            ModelsKelasOnline::where('id', $this->editId)->update([
                'kelas_id' => $this->kelasid,
                'mapel_id' => $this->mapelid,
                'author_id' => Auth::id(),
                'materi' => $this->materi,
                'isi_materi' => $this->isimateri,
                'wkt_masuk' => $this->tgl_kelon." ".$this->wktmulai,
                'wkt_selesai' => $this->tgl_kelon." ".$this->wktselesai,
            ]);
        }else{
            ModelsKelasOnline::create([
                'kelas_id' => $this->kelasid,
                'mapel_id' => $this->mapelid,
                'author_id' => Auth::id(),
                'materi' => $this->materi,
                'isi_materi' => $this->isimateri,
                'wkt_masuk' => $this->tgl_kelon." ".$this->wktmulai.":00",
                'wkt_selesai' => $this->tgl_kelon." ".$this->wktselesai.":00",
            ]);
        }


        $this->clearForm();
        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan kelas online']);
    }

    public function edit($id)
    {
        $kelon = ModelsKelasOnline::find($id);
        // dd($kelon);
        $this->tgl_kelon = date("Y-m-d", strtotime($kelon->wkt_masuk));
        $this->mapelid = $kelon->mapel_id;
        $this->kelasid = $kelon->kelas_id;
        $this->materi = $kelon->materi;
        $this->emit('isiMateri', $kelon->isi_materi);
        // $this->isimateri = $kelon->isi_materi;
        $this->wktmulai = date("H:i:s", strtotime($kelon->wkt_masuk));
        $this->wktselesai = date("H:i:s", strtotime($kelon->wkt_selesai));
        $this->editId = $kelon->id;
    }

    public function hapus($id)
    {
        $kelon = ModelsKelasOnline::find($id);
        $kelon->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menghapus '.$kelon->materi]);
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
        $this->editId = null;
    }
}
