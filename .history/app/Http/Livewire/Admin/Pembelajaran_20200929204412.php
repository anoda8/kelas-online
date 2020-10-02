<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran as ModelsPembelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pembelajaran extends Component
{
    public $mapel, $kelas;
    public $mapelTerpilihId = null, $mapelTerpilihNama, $mapelTerpilihGuru;
    public $kelasid = [0];

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Pembelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $mapel = Mapel::with(['guru'])->get();
        $kelas = Kelas::with(['jurusan'])->get();
        $pembl = ModelsPembelajaran::where('thajaran', session('thajaran'))->with(['mapel.guru', 'kelas', 'author'])->get();
        return view('livewire.admin.pembelajaran', [
            'mapels' => $mapel, 'kelases' => $kelas, 'pembelajarans' => $pembl
        ]);
    }

    public function pilihMapel($id)
    {
        $mapel = Mapel::where('id', $id)->with(['guru'])->get()->first();
        $this->mapelTerpilihId  = $id;
        $this->mapelTerpilihGuru = $mapel->guru->nama;
        $this->mapelTerpilihNama = $mapel->nama;
    }

    public function collectKelas($id)
    {
        if(array_search($id, $this->kelasid, true)){
            array_splice($this->kelasid, array_search($id, $this->kelasid ), 1);
        }else{
            array_push($this->kelasid, $id);
        }
    }

    public function simpan()
    {
        if((count($this->kelasid) > 1) && ($this->mapelTerpilihId != null)){
            // dd($this->kelasid, $this->mapelTerpilihId);
            $pembl = [];
            foreach($this->kelasid as $key => $kelasid){
                if($kelasid != 0){
                    $pembl[] =  ModelsPembelajaran::updateOrCreate([
                        'mapel_id' => $this->mapelTerpilihId,
                        'kelas_id' => $kelasid,
                        'thajaran' => session('thajaran')
                    ], [
                        'mapel_id' => $this->mapelTerpilihId,
                        'kelas_id' => $kelasid,
                        'thajaran' => session('thajaran'),
                        'author_id' => Auth::id()
                    ]);
                }
            }
            // dd($pembl);
        }
    }

    public function hapus($id)
    {
        $pembl = ModelsPembelajaran::find($id);
        $pembl->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Berhasil menghapus pembelajaran"]);
    }
}