<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\KelasOnline as ModelsKelasOnline;
use App\Models\LogKelasOnline;
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
        $kelon = ModelsKelasOnline::where('kelas_id', $this->kelas->id)->with(['kelas', 'mapel', 'author'])->latest('wkt_masuk')->paginate($this->perpage);
        if ($this->katakunciTgl != null) {
            $this->resetPage();
            $this->katakunciMapel = null;
            $kelon = ModelsKelasOnline::where('kelas_id', $this->kelas->id)->whereDate('wkt_masuk', $this->katakunciTgl)->with(['kelas', 'mapel', 'author'])->latest('wkt_masuk')->paginate($this->perpage);
        }

        if ($this->katakunciMapel != null) {
            $this->resetPage();
            $this->katakunciTgl = null;
            $kelon = ModelsKelasOnline::where('kelas_id', $this->kelas->id)
                ->where('mapel_id', $this->katakunciMapel)
                ->with(['kelas', 'mapel', 'author'])->latest('wkt_masuk')->paginate($this->perpage);
        }
        $kelasAktif = LogKelasOnline::where('user_id', Auth::id())->where('status', true)->get();
        $pembelajaran = Pembelajaran::where('kelas_id', $this->kelas->id)->with(['mapel.guru'])->get();
        return view('livewire.siswa.kelas-online', [
            'kelons' => $kelon, 'pembelajaran' => $pembelajaran, 'kelasAktif' => $kelasAktif
        ]);
    }

    public function masukKelas($kelonId)
    {
        $siswaid = Siswa::where('user_id', Auth::id())->get()->first()->id;

        LogKelasOnline::updateOrCreate([
            'kelon_id' => $kelonId,
            'user_id' => Auth::id()
        ], [
            'kelon_id' => $kelonId,
            'siswa_id' => $siswaid,
            'user_id' => Auth::id(),
            'status' => true
        ]);

        redirect('/siswa/kelasonline/detail/' . $kelonId);
    }

    public function today()
    {
        $now = date("Y-m-d", time());
        $this->resetPage();
        $this->katakunciTgl = $now;
    }

    public function clearSearch()
    {
        $this->katakunciTgl = $this->katakunciMapel = null;
    }
}
