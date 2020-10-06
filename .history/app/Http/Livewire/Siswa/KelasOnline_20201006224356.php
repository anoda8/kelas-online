<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\KelasOnline as ModelsKelasOnline;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class KelasOnline extends Component
{
    use WithPagination;

    public $siswa, $kelas;
    public $katakunciMapel = null, $katakunciTgl = null;
    public $perpage = 15;

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
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelon = ModelsKelasOnline::where('kelas_id', $this->kelas->id)->with(['kelas', 'mapel', 'author']);
        if ($this->katakunciTgl != null) {
            $kelon->whereDate('wkt_masuk', $this->katakunciTgl);
        }
        $kelon->latest('wkt_masuk')->paginate($this->perpage);
        $pembelajaran = Pembelajaran::where('kelas_id', $this->kelas->id)->with(['mapel.guru'])->get();
        return view('livewire.siswa.kelas-online', [
            'kelons' => $kelon, 'pembelajaran' => $pembelajaran
        ]);
    }

    public function today()
    {
        $now = date("Y-m-d", time());
        $this->katakunciTgl = $now;
    }
}
