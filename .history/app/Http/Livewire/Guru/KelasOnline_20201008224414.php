<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasOnline as ModelsKelasOnline;
use App\Models\LogKelasOnline;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class KelasOnline extends Component
{
    use WithPagination, WithFileUploads;

    public $mapelid, $kelasid, $materi, $isimateri, $wktmulai, $wktselesai, $tgl_kelon, $videopath;
    public $guruid;
    public $formopen = false;
    public $dokumen;
    public $editId = null;
    public $kataKunciMateri = null, $kataKunciMapel, $kataKunciKelas = null, $kataKunciTgl = null;
    public $perpage = 10;
    public $fileimport = null;
    public $namafileUpload = null;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
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
        $mapel = Mapel::where('thajaran', session('thajaran'))->where('guru_id', $this->guruid)->with(['guru'])->get();
        $pembl = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->mapelid)->with(['kelas'])->get();
        $kelons = ModelsKelasOnline::where('author_id', Auth::id())->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);

        if ($this->kataKunciMateri != null) {
            $this->kataKunciKelas = null;
            $kelons = ModelsKelasOnline::where('author_id', Auth::id())->where('materi', 'like', '%' . $this->kataKunciMateri . '%')
                ->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);
        }

        if ($this->kataKunciKelas != null) {
            $this->kataKunciMateri = null;
            $kelons = ModelsKelasOnline::where('author_id', Auth::id())->where('kelas_id', $this->kataKunciKelas)
                ->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);
        }

        if ($this->kataKunciTgl != null) {
            $this->kataKunciKelas = null;
            $this->kataKunciMateri = null;
            $kelons = ModelsKelasOnline::where('author_id', Auth::id())->whereDate('wkt_masuk', $this->kataKunciTgl)
                ->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);
        }

        $cariKelas = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->kataKunciMapel)->with(['kelas'])->get();
        return view('livewire.guru.kelas-online', [
            'mapels' => $mapel, 'pembelajaran' => $pembl, 'kelons' => $kelons, 'cariKelas' => $cariKelas
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
            'fileimport' => 'nullable|mimes:jpg,jpeg,png,xlsx,xls,doc,docx,ppt,pptx,pdf|max:10000',
        ]);

        // dd($this->tgl_kelon." ".$this->wktmulai.":00");
        $data = [
            'kelas_id' => $this->kelasid,
            'mapel_id' => $this->mapelid,
            'author_id' => Auth::id(),
            'materi' => $this->materi,
            'isi_materi' => $this->isimateri,
            'video_path' => $this->videopath
        ];

        if ($this->fileimport != null) {
            $mapel = Mapel::find($this->mapelid)->nama;
            $kelas = Kelas::find($this->kelasid)->nama;
            $namafile = strtolower(date("Y-m-d", time()) . "_" . $this->mapelid . "_" . $this->kelasid . "_" . $this->materi . "." . $this->fileimport->extension());
            $fullpath = 'storage/kelasonline/' . Auth::user()->name . "/" . $mapel . "/" . $kelas . "/" . $namafile;
            $this->fileimport->storeAs('public/kelasonline/' . Auth::user()->name . "/" . $mapel . "/" . $kelas . "/", $namafile);
            $data['file'] = $fullpath;
        }

        if ($this->editId != null) {
            $data['wkt_masuk']      = $this->tgl_kelon . " " . $this->wktmulai;
            $data['wkt_selesai']    = $this->tgl_kelon . " " . $this->wktselesai;
            ModelsKelasOnline::where('id', $this->editId)->update($data);
            $this->editId = null;
        } else {
            $data['wkt_masuk']      = $this->tgl_kelon . " " . $this->wktmulai . ":00";
            $data['wkt_selesai']    = $this->tgl_kelon . " " . $this->wktselesai . ":00";
            ModelsKelasOnline::create($data);
        }

        $this->clearForm();
        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menambahkan kelas online']);
    }

    public function edit($id)
    {
        $kelon = ModelsKelasOnline::find($id);
        // dd($kelon);
        $this->tgl_kelon = date("Y-m-d", strtotime($kelon->wkt_masuk));
        $this->mapelid = $kelon->mapel_id;
        $this->kelasid = $kelon->kelas_id;
        $this->materi = $kelon->materi;
        $this->videopath = $kelon->video_path;
        $this->namafileUpload = $kelon->file;
        $this->emit('isiMateri', $kelon->isi_materi);
        // $this->isimateri = $kelon->isi_materi;
        $this->wktmulai = date("H:i:s", strtotime($kelon->wkt_masuk));
        $this->wktselesai = date("H:i:s", strtotime($kelon->wkt_selesai));
        $this->editId = $kelon->id;
    }

    public function salin($id)
    {
        $kelon = ModelsKelasOnline::find($id);
        // dd($kelon);
        $this->tgl_kelon = date("Y-m-d", strtotime($kelon->wkt_masuk));
        $this->mapelid = $kelon->mapel_id;
        $this->kelasid = $kelon->kelas_id;
        $this->materi = $kelon->materi;
        $this->videopath = $kelon->video_path;
        $this->namafileUpload = $kelon->file;
        $this->emit('isiMateri', $kelon->isi_materi);
        // $this->isimateri = $kelon->isi_materi;
        $this->wktmulai = date("H:i", strtotime($kelon->wkt_masuk));
        $this->wktselesai = date("H:i", strtotime($kelon->wkt_selesai));
    }

    public function hapus($id)
    {
        $kelon = ModelsKelasOnline::find($id);
        $kelon->delete();
        if ($kelon->file != null) {
            $file = str_replace('storage/', '', $kelon->file);
            Storage::disk('public')->delete($file);
        }
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menghapus ' . $kelon->materi]);
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
        $this->namafileUpload = null;
        $this->videopath = null;
        $this->editId = null;
    }
}
