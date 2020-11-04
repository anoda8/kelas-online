<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use App\Models\ThAjaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester, $tambah_status = 0;
    public $list_thajaran;

    public $settings = [
        'NamaSekolah' => '', 'Alamat' => '', 'NamaKepsek' => '', 'NIPKepsek' => '', 'EmailKepsek' => ''
    ];

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Halaman Pengaturan",
            'keterangan' => ""
        ];
    }

    public function mount()
    {
        $this->heading = $this->heading();
        $this->list_thajaran = ThAjaran::latest()->get();
    }

    public function render()
    {
        $data['list_thajaran'] = $this->list_thajaran;
        $settings = Settings::get()->toArray();
        dd($settings);
        // $this->settings = $settings;

        return view('livewire.admin.setting', $data);
    }

    public function thAjaranClearSettingForm()
    {
        $this->tambah_tahun = '';
        $this->tambah_status = 0;
        $this->tambah_semester = '';
    }

    public function thAjaranStore()
    {
        $this->validatedDate = $this->validate([
            'tambah_tahun' => 'required|numeric',
            'tambah_semester' => 'required'
        ]);

        $akhir = substr(($this->tambah_tahun + 1), 2, 2);
        $awal = substr($this->tambah_tahun, 2, 2);
        $keterangan = "Tahun Pelajaran " . $this->tambah_tahun . "/" . ($this->tambah_tahun + 1) . " Semester " . $this->tambah_semester;

        if ($this->tambah_status == 1) {
            ThAjaran::query()->update(['status' => 0]);
        }

        $newThAjaran = ThAjaran::create([
            'kode' => $awal . $akhir . $this->tambah_semester,
            'semester' => $this->tambah_semester,
            'keterangan' => $keterangan,
            'status' => $this->tambah_status
        ]);

        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil nambah']);
        $this->list_thajaran->prepend($newThAjaran);
        $this->thAjaranClearSettingForm();
    }

    public function thAjaranAktif($id)
    {
        ThAjaran::query()->update(['status' => 0]);
        $thajaran = ThAjaran::find($id);
        $thajaran->update(['status' => 1]);
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => $thajaran->keterangan . " Aktif"]);
        $this->mount();
    }

    public function thAjaranHapus($id)
    {
        $thajaran = ThAjaran::find($id);
        $keterangan = $thajaran->keterangan;
        $thajaran->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => $keterangan . " dihapus !"]);
        $this->mount();
    }

    public function storeSettings()
    {
        foreach ($this->settings as $key => $value) {
            Settings::updateOrCreate(['key' => $key], [
                'value' => $value, 'user_id' => Auth::id()
            ]);
        }
        $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => "Berhasil menyimpan pengaturan"]);
    }
}
