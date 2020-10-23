<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use App\Models\Tugas as ModelsTugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Tugas extends Component
{
    use WithPagination;

    public $siswa, $kelas;
    public $perpage = 10;
    public $katakunciMapel = null, $katakunciTgl = null;

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
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $pembelajaran = Pembelajaran::where('kelas_id', $this->kelas->id)->with(['mapel.guru'])->get();
        $tugase = ModelsTugas::where('kelas_id', $this->kelas->id)->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);

        if($this->katakunciMapel != null){
            $this->katakunciTgl = null;
            $tugase = ModelsTugas::where('kelas_id', $this->kelas->id)->where('mapel_id', $this->katakunciMapel)->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);
        }

        if($this->katakunciTgl != null){
            $this->katakunciMapel = null;
            $tugase = ModelsTugas::where('kelas_id', $this->kelas->id)->whereDate('created_at', $this->katakunciTgl)->with(['kelas', 'mapel', 'author'])->latest()->paginate($this->perpage);
        }

        return view('livewire.siswa.tugas', [
            'tugase' => $tugase, 'pembelajaran' => $pembelajaran
        ]);
    }

    public function today()
    {
        $now = date("Y-m-d", time());
        $this->katakunciTgl = $now;
    }

    public function clearSearch()
    {
        $this->katakunciTgl = $this->katakunciMapel = null;
    }
}
