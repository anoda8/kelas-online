<?php

namespace App\Http\Livewire\Siswa;

use App\Events\KelonChatEvent;
use App\Models\Kelas;
use App\Models\KelasOnline;
use App\Models\Komentar;
use App\Models\LogKelasOnline;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid, $inputChat;
    protected $listeners;
    public $here = [];
    public $komentar = [];

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

        $this->listeners = [
            "echo-presence:kelonChat" . $this->kelonid . ",here" => "here",
            "echo-presence:kelonChat" . $this->kelonid . ",joining" => "joining",
            "echo-presence:kelonChat" . $this->kelonid . ",leaving" => "leaving"
        ];

        $this->komentar =
            $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelas = KelasOnline::find($this->kelonid);
        $this->pesan = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get()->reverse()->values()->toArray();
        return view('livewire.siswa.detail-kelas-online', [
            'kelas' => $kelas, 'komentare' => $this->pesan
        ]);
    }

    public function here($data)
    {
    }

    public function joining()
    {
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Ada yang gabung gaes']);
    }
}
