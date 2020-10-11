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
        // $kelasaktif = LogKelasOnline::where('user_id', Auth::id())->where('status', true)->get();
        // if ($kelasaktif->count() > 0) {
        //     if ($kelasaktif->first()->kelon_id != $this->kelonid) {
        //         redirect('/siswa/kelasonline');
        //     }
        // }

        $this->siswa = Siswa::where('user_id', Auth::id())->get()->first();
        $this->kelas = Kelas::where('id', $this->siswa->kelas_id)->get()->first();
    }

    public function render()
    {
        $kelas = KelasOnline::find($this->kelonid);
        $komentare = Komentar::where('kelon_id', $this->kelonid)->orderBy('created_at', 'ASC')->get();
        return view('livewire.siswa.detail-kelas-online', [
            'kelas' => $kelas, 'komentare' => $komentare, 'listonline' => $this->listOnline()
        ]);
    }

    public function masuk(Request $request)
    {
        $token = $request->session()->get('_token');

        if (!$request->session()->exists('_openClass')) {

            $kelasaktif = LogKelasOnline::where('user_id', Auth::id())->where('status', true)->get();

            // if ($kelasaktif->count() > 0) {

            //     if ($kelasaktif->first()->kelon_id != $this->kelonid) {

            //         $this->dispatchBrowserEvent('toast', ['icon' => 'error', 'title' => 'Anda masih aktif di kelas lain, silahkan keluar kelas dulu !']);
            //     }
            // } else {
            session(['_openClass' => $token, '_classId' => $this->kelonid]);

            LogKelasOnline::updateOrCreate([
                'kelon_id' => $this->kelonid,
                'user_id' => Auth::id()
            ], [
                'kelon_id' => $this->kelonid,
                'user_id' => Auth::id(),
                'status' => true
            ]);
            // }
        }
    }

    public function keluar(Request $request)
    {
        $request->session()->forget('_openClass');
        $request->session()->forget('_classId');
    }

    public function simpanKomen()
    {
        // if ($this->inputChat != null) {
        //     Komentar::create([
        //         'kelon_id' => $this->kelonid,
        //         'author_id' => Auth::id(),
        //         'komentar' => $this->inputChat
        //     ]);
        //     $this->inputChat = null;
        // }
        $user = User::find(Auth::id());
        event(new KelonChatEvent($this->inputChat, $user, $this->kelonid));
    }

    public function listOnline()
    {
        $listonline = LogKelasOnline::where('kelon_id', $this->kelonid)->where('status', true)->with(['user'])->latest()->get();
        return $listonline;
    }

    public function getListeners()
    {
        return [
            "echo-presence:kelonChat" . $this->kelonid . ",joining" => "joining"
        ];
    }

    public function joining()
    {
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Ada yang gabung gaes']);
    }
}
