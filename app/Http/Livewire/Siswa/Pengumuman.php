<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Pengumuman as ModelsPengumuman;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Pengumuman extends Component
{
    use WithPagination;

    public $siswa, $kelas;
    public $perpage = 5;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Pengumuman",
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
        $pengumuman = ModelsPengumuman::orWhere('kelas_id', $this->kelas->id)->orWhere('tujuan', 'all')
            ->orWhere('jurusan_id', $this->kelas->jurusan_id)->latest('published_at')->paginate($this->perpage);

        return view('livewire.siswa.pengumuman', [
            'pengumuman' => $pengumuman
        ]);
    }
}
