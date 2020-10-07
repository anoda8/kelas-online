<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\ResponTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailTugas extends Component
{
    use WithFileUploads;

    public $tugasid, $dokumen, $jawaban;
    public $mapel;
    public $fileimport = null;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
            'keterangan' => ""
        ];
    }

    public function mount($tugasid)
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->tugasid = $tugasid;
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $tugas = Tugas::where('id', $this->tugasid)->with(['author', 'mapel'])->get()->first();
        $this->mapel = $tugas->mapel->nama;
        $this->heading['judul'] = $tugas->judul;
        $this->heading['keterangan'] = $tugas->mapel->nama . " (" . $tugas->author->name . ")";

        $respon = ResponTugas::where(['author_id' => Auth::id(), 'tugas_id' => $this->tugasid])->get();

        if ($respon->count() > 0) {
            $this->jawaban = $respon->first()->jawaban;
        }

        return view('livewire.siswa.detail-tugas', [
            'tugas' => $tugas, 'respon' => $respon
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'fileimport' => 'nullable|mimes:jpg,jpeg,png,xlsx,xls,doc,docx,ppt,pptx,pdf|max:5000',
            'jawaban' => 'required'
        ]);

        if ($this->fileimport) {
            $namafile = strtolower(date("Y-m-d_H-i-s", time()) . "_" . $this->mapel . "." . $this->fileimport->extension());
            $fullpath = 'public/kelasonline/' . Auth::user()->email . "/" . $this->mapel . "/" . $namafile;
            $this->fileimport->storeAs('public/kelasonline/' . Auth::user()->email . "/" . $this->mapel . "/", $namafile);
        }

        $data = [
            'tugas_id' => $this->tugasid,
            'author_id' => Auth::id(),
            'jawaban' => $this->jawaban,
            'videopath' => ''
        ];

        ResponTugas::updateOrCreate([
            'tugas_id' => $this->tugasid,
            'author_id' => Auth::id(),
        ], $data);

        $this->clearForm();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menyimpan respon']);
    }

    public function clearForm()
    {
        $this->fileimport = null;
        $this->jawaban = '';
    }
}
