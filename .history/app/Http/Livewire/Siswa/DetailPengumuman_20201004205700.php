<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailPengumuman extends Component
{
    public $pengId;

    public $heading;

    public function mount($pengId){
        $this->level = request()->segment(3);

        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
        $this->pengId = $pengId;
    }


    public function render()
    {
        $peng = Pengumuman::where('id', $this->pengId)->get()->first();
        $this->heading['judul'] = $peng->judul;
        $this->heading['keterangan'] = "Detail Pengumuman";
        return view('livewire.siswa.detail-pengumuman', [
            'peng' => $peng
        ]);
    }
}
