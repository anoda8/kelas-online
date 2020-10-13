<?php

namespace App\Http\Livewire\Guru;

use App\Events\KelonChatEvent;
use App\Events\KelonPesanEvent;
use App\Models\KelasOnline;
use App\Models\Komentar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;
    public $chat, $inputChat = null;
    public $here = [];
    public $komentar = [];

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Detail Kelas",
            'keterangan' => ""
        ];
    }

    public function mount($kelonid)
    {
        $this->level = request()->segment(3);
        $this->kelonid = $kelonid;
    }

    public function render()
    {
        $kelons = KelasOnline::where('id', $this->kelonid)->with(['kelas', 'mapel', 'author'])->get()->first();
        $this->heading = [
            'judul' => "Kelas Online " . $kelons->kelas->nama . " [" . $kelons->mapel->nama . "]",
            'keterangan' => $kelons->materi
        ];
        $komentare = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get();
        return view('livewire.guru.detail-kelas-online', [
            'kelons' => $kelons, 'komentare' => $komentare
        ]);
    }

    public function simpanKomen()
    {
        if ($this->inputChat != null) {
            $komentar = Komentar::create([
                'kelon_id' => $this->kelonid,
                'author_id' => Auth::id(),
                'komentar' => $this->inputChat
            ]);
            event(new KelonPesanEvent(Auth::user(), $komentar));
        }
    }

    public function getListeners()
    {
        return [
            "echo-presence:kelonChat" . $this->kelonid . ",here" => "here",
            "echo-presence:kelonChat" . $this->kelonid . ",joining" => "joining",
            "echo-presence:kelonChat" . $this->kelonid . ",leaving" => "leaving",
        ];
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

    public function cetak($kelonid)
    {
    }

    public function pesanMasuk($data)
    {
        dd($data);
    }
}
