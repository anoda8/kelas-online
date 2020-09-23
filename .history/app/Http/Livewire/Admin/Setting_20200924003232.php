<?php

namespace App\Http\Livewire\Admin;

use App\Models\ThAjaran;
use Livewire\Component;

class Setting extends Component
{
    public $tambah_tahun, $tambah_semester, $tambah_status = 0, $coba;
    public $list_thajaran;

    public function mount()
    {
        $this->list_thajaran = ThAjaran::latest()->get();
    }

    public function render()
    {
        $data['list_thajaran'] = $this->list_thajaran;
        return view('livewire.admin.setting', $data);
    }

    public function store()
    {
        $this->validatedDate = $this->validate([
            'tambah_tahun' => 'required|numeric',
            'tambah_semester' => 'required'
        ]);

        $akhir = substr(($this->tambah_tahun + 1), 2, 2);
        $awal = substr($this->tambah_tahun, 2, 2);
        $keterangan = "Tahun Pelajaran ".$this->tambah_tahun."/".($this->tambah_tahun + 1)." Semester ".$this->tambah_semester;

        $newThAjaran = ThAjaran::create([
            'kode' => $awal.$akhir.$this->tambah_semester,
            'semester' => $this->tambah_semester,
            'keterangan' => $keterangan
        ]);

        $this->list_thajaran->prepend($newThAjaran);
    }


}
