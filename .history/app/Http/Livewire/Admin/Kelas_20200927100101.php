<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jurusan;
use App\Models\Kelas as ModelsKelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kelas extends Component
{
    public $nama, $jurusan, $author;

    public $detailKelasNama, $detailKelasId = null;
    public $cariNama = null, $cariNis = null;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Kelas",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $jurusans = Jurusan::all();
        $kelases = ModelsKelas::with(['jurusan', 'author'])->get();
        $detailSiswa = $cariSiswa = [];

        if($this->detailKelasId != null){
            $detailSiswa = Siswa::where('kelas_id', $this->detailKelasId)->get();
        }

        if(($this->cariNama != null) || ($this->cariNis != null)){
            $cariSiswa = Siswa::where('nama', 'like', "%".$this->cariNama."%")->orWhere('nis', 'like', "%".$this->cariNis."%")->get();
        }

        return view('livewire.admin.kelas',[
            'jurusans' => $jurusans, 'kelases' => $kelases, 'siswas' => $detailSiswa, 'carisiswa' => $cariSiswa
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'jurusan' => 'required'
        ]);

        ModelsKelas::create([
            'nama' => $this->nama,
            'jurusan_id' => $this->jurusan,
            'author_id' => Auth::id()
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->nama = '';
        $this->jurusan = '';
        $this->author = '';
    }

    public function hapus($id)
    {
        $kelas = ModelsKelas::find($id);
        $nama = $kelas->nama;
        $kelas->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menghapus '.$this->nama]);
    }

    //Detail Kelas
    public function detailKelas($id)
    {
        $kelas = ModelsKelas::find($id);
        $this->detailKelasNama = $kelas->nama;
        $this->detailKelasId = $kelas->id;
    }
}
