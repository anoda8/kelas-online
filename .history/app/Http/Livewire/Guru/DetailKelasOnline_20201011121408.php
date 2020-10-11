<?php

namespace App\Http\Livewire\Guru;

use App\Events\KelonChatEvent;
use App\Models\KelasOnline;
use App\Models\Komentar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailKelasOnline extends Component
{
    public $kelonid;
    public $chat, $inputChat = null;

    protected $listeners = null;

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
        $this->listeners = ['echo:pesan-kelon-' . $this->kelonid . ',KelonChatEvent' => 'notifChat'];
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
            // Komentar::create([
            //     'kelon_id' => $this->kelonid,
            //     'author_id' => Auth::id(),
            //     'komentar' => $this->inputChat
            // ]);
            $user = User::find(Auth::id());
            event(new KelonChatEvent($this->inputChat, $user, $this->kelonid));

            // $this->inputChat = null;
        }
    }

    public function notifChat()
    {
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Ada yang gabung gaes']);
    }
}
