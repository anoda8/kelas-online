<?php

namespace App\Http\Livewire\Guru;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Tugas as ModelsTugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Expr\AssignOp\Mod;

class Tugas extends Component
{
    use WithPagination;

    public $guruid, $mapelid, $kelasid, $judTugas, $deskripsi, $dokumen, $videopath;
    public $editId = null;
    public $kataKunciJudul = null, $kataKunciMapel, $kataKunciKelas = null, $kataKunciTgl = null;
    public $perpage = 10;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Tugas",
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
        $tugas = ModelsTugas::where('author_id', Auth::id())->with(['mapel', 'kelas', 'author'])->paginate($this->perpage);

        if ($this->kataKunciJudul != null) {
            $this->kataKunciKelas = null;
            $tugas = ModelsTugas::where('author_id', Auth::id())->where('judul', 'like', "%" . $this->kataKunciJudul . "%")->with(['mapel', 'kelas', 'author'])->paginate($this->perpage);
        }

        if ($this->kataKunciKelas != null) {
            $this->kataKunciJudul = null;
            $tugas = ModelsTugas::where('author_id', Auth::id())->where('kelas_id', $this->kataKunciKelas)->with(['mapel', 'kelas', 'author'])->paginate($this->perpage);
        }

        $cariKelas = Pembelajaran::where('thajaran', session('thajaran'))->where('mapel_id', $this->kataKunciMapel)->with(['kelas'])->get();
        return view('livewire.guru.tugas', [
            'mapels' => $mapel, 'pembelajaran' => $pembl, 'tugase' => $tugas, 'cariKelas' => $cariKelas
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

        if ($this->editId != null) {
            ModelsTugas::where('id', $this->editId)->update([
                'mapel_id' => $this->mapelid,
                'kelas_id' => $this->kelasid,
                'author_id' => Auth::id(),
                'judul' => $this->judTugas,
                'deskripsi' => $this->deskripsi,
                'videopath' => $this->videopath,
                'file' => $this->dokumen
            ]);
            $this->editId = null;
        } else {
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

        $this->clearForm();
        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menambahkan kelas tugas']);
    }

    public function edit($id)
    {
        $tugas = ModelsTugas::find($id);
        $this->mapelid = $tugas->mapel_id;
        $this->kelasid = $tugas->kelas_id;
        $this->judTugas = $tugas->judul;
        $this->deskripsi = $tugas->deskripsi;
        $this->emit('isiDeskripsi', $tugas->deskripsi);
        $this->dokumen = $tugas->dokumen;
        $this->videopath = $tugas->videopath;
        $this->editId = $id;
    }

    public function salin($id)
    {
        $tugas = ModelsTugas::find($id);
        $this->mapelid = $tugas->mapel_id;
        $this->kelasid = $tugas->kelas_id;
        $this->judTugas = $tugas->judul;
        $this->deskripsi = $tugas->deskripsi;
        $this->emit('isiDeskripsi', $tugas->deskripsi);
        $this->dokumen = $tugas->dokumen;
        $this->videopath = $tugas->videopath;
    }

    public function hapus($id)
    {
        $tugas = ModelsTugas::find($id);
        $tugas->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menghapus ' . $tugas->judul]);
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
