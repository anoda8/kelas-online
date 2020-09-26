<?php

namespace App\Http\Livewire\Admin;

use App\Models\Siswa as ModelsSiswa;
use Livewire\Component;

class Siswa extends Component
{
    public $user_id, $kelas_id, $nama, $nis, $jenkel, $tgl_lahir;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Siswa",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.siswa', [
            'siswas' => ModelsSiswa::all()
        ]);
    }


}
