<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\ResponTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailTugas extends Component
{
    public $tugasid, $dokumen, $jawaban;

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
        $tugas = Tugas::where('id', $this->tugasid)->with(['author'])->get()->first();
        $this->heading['judul'] = $tugas->judul;
        $this->heading['keterangan'] = $tugas->mapel->nama . " (" . $tugas->author->name . ")";
        return view('livewire.siswa.detail-tugas', [
            'tugas' => $tugas
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'dokumen' => 'required',
            'jawaban' => 'required'
        ]);

        ResponTugas::createOrUpdate([
            'tugas_id' => $this->tugasid,
            'author_id' => Auth::id(),
            'jawaban' => $this->jawaban,
            'videopath' => '',
        ])
    }
}
