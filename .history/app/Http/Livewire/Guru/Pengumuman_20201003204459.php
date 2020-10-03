<?php

namespace App\Http\Livewire\Guru;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pengumuman as ModelsPengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Pengumuman extends Component
{
    public $jurusanid = null, $kelasid = null, $tujuan = null, $judul, $isipengumuman, $tanggal, $waktu;
    public $editId = null;
    public $kataKunciPeng;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Pengumuman",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $kelases    = Kelas::where('thajaran', session('thajaran'))->get();
        $jurusans   = Jurusan::where('thajaran', session('thajaran'))->get();
        $pengumuman = ModelsPengumuman::where('author_id', Auth::id())->with(['author', 'kelas'])->get();
        return view('livewire.guru.pengumuman',[
            'kelases' => $kelases, 'jurusans' => $jurusans, 'pengumumans' => $pengumuman
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required',
            'isipengumuman' => 'required'
        ]);

        if(($this->jurusanid == '') && ($this->kelasid == '') && ($this->tujuan == '')){
            throw ValidationException::withMessages(['tujuanumum' => 'Pilih salah satu tujuan !!']);
        }

        $this->jurusanid == '' ?? null;
        $this->kelasid == '' ?? null;
        $this->tujuan == '' ?? null;

        if($this->editId != null){
            ModelsPengumuman::find($this->editId)->update([
                'jurusan_id' => $this->jurusanid,
                'kelas_id' => $this->kelasid,
                'author_id' => Auth::id(),
                'tujuan' => $this->tujuan,
                'judul' => $this->judul,
                'isi_pengumuman' => $this->isipengumuman,
                'published_at' => $this->tanggal." ".$this->waktu
            ]);
            $this->editId = null;
        }else{
            ModelsPengumuman::create([
                'jurusan_id' => $this->jurusanid,
                'kelas_id' => $this->kelasid,
                'author_id' => Auth::id(),
                'tujuan' => $this->tujuan,
                'judul' => $this->judul,
                'isi_pengumuman' => $this->isipengumuman,
                'published_at' => $this->tanggal." ".$this->waktu
            ]);
        }

        $this->clearForm();
        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan pengumuman']);
    }

    public function hapus($id)
    {
        $peng = ModelsPengumuman::find($id);
        $judul = $peng->judul;
        $peng->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menghapus '.$judul]);
    }

    public function edit($id)
    {
        $peng = ModelsPengumuman::find($id);
        $this->jurusanid = $peng->jurusan_id;
        $this->kelasid = $peng->kelas_id;
        $this->tujuan = $peng->tujuan;
        $this->judul = $peng->judul;
        $this->emit('isiPengumuman', $peng->isi_pengumuman);
        $this->tanggal = date("Y-m-d", strtotime($peng->published_at));
        $this->waktu = date("H:i", strtotime($peng->published_at));
        $this->editId = $peng->id;
    }

    public function salin($id)
    {
        $peng = ModelsPengumuman::find($id);
        $this->jurusanid = $peng->jurusan_id;
        $this->kelasid = $peng->kelas_id;
        $this->tujuan = $peng->tujuan;
        $this->judul = $peng->judul;
        $this->emit('isiPengumuman', $peng->isi_pengumuman);
        $this->tanggal = date("Y-m-d", strtotime($peng->published_at));
        $this->waktu = date("H:i", strtotime($peng->published_at));
    }

    public function clearForm()
    {
        $this->jurusanid = '';
        $this->kelasid = '';
        $this->tujuan = '';
        $this->judul = '';
        $this->isipengumuman = '';
        $this->tanggal = '';
        $this->waktu = '';
    }
}
