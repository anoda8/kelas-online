<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kelas;
use App\Models\KelasOnline;
use App\Models\Komentar;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Kelas Online",
            'keterangan' => ""
        ];
    }

    public function mount($kelonid)
    {
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        $this->kelonid = $kelonid;
        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelas = KelasOnline::find($this->kelonid);
        $komentare = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get();
        return view('livewire.siswa.detail-kelas-online',[
            'kelas' => $kelas, 'komentare' => $komentare
        ]);
    }

    public function masuk(Request $request)
    {
        $token = $request->session()->get('_token');
        if(!$request->session()->exists('_openClass')){

            session(['_openClass'=> $token, '_classId' => $this->kelonid]);

        }
    }

    public function keluar(Request $request)
    {
        $request->session()->forget('_openClass');
    }
}
