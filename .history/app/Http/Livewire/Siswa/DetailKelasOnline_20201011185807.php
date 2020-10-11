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


        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelas = KelasOnline::find($this->kelonid);
        $this->komentar = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get()->reverse()->values()->toArray();
        return view('livewire.siswa.detail-kelas-online', [
            'kelas' => $kelas, 'komentare' => $this->komentar
        ]);
    }

    public function getListeners()
    {
        return [
            "echo-presence:kelonChat" . $this->kelonid . ",here" => "here",
            "echo-presence:kelonChat" . $this->kelonid . ",joining" => "joining",
            "echo-presence:kelonChat" . $this->kelonid . ",leaving" => "leaving",
            // "echo:kelonChat" . $this->kelonid . ",KelonChatEvent" => "cekRicek"
        ];
    }

    public function simpanKomen()
    {
        if ($this->inputChat != null) {
            $komentar = Komentar::create([
                'kelon_id' => $this->kelonid,
                'author_id' => Auth::id(),
                'komentar' => $this->inputChat
            ]);
            broadcast(new KelonChatEvent($komentar));
        }
    }


    public function here($data)
    {
        $this->here = $data;
    }

    public function joining($data)
    {
        $this->here[] = $data;
    }

    public function leaving($data)
    {
        $here = collect($this->here);
        $firstIndex = $here->search(function ($authData) use ($data) {
            return $authData['user'] == $data['user'];
        });
        $here->splice($firstIndex, 1);
        $this->here = $here->toArray();
    }
}
