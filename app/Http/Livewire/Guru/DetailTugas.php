<?php

namespace App\Http\Livewire\Guru;

use App\Models\ResponTugas;
use App\Models\Tugas;
use Livewire\Component;
use Livewire\WithPagination;

class DetailTugas extends Component
{
    use WithPagination;

    public $tugasid;
    public $inputKomen, $inputNilai;
    public $perpage = 10;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Detail Tugas",
            'keterangan' => ""
        ];
    }

    public function mount($tugasid){
        $this->level = request()->segment(3);
        $this->tugasid = $tugasid;
    }

    public function render()
    {
        $tugas = Tugas::where('id', $this->tugasid)->with(['kelas', 'mapel'])->get()->first();
        $this->heading = [
            'judul' => "Tugas ".$tugas->kelas->nama." [".$tugas->mapel->nama."]",
            'keterangan' => $tugas->judul
        ];
        $respon = ResponTugas::where('tugas_id', $this->tugasid)->with(['author'])->paginate($this->perpage);
        return view('livewire.guru.detail-tugas', [
            'tugas' => $tugas, 'respons' => $respon
        ]);
    }

    public function simpanKomen($id)
    {
        $respon = ResponTugas::find($id);
        $respon->komentar = $this->inputKomen;
        $respon->save();
        $this->inputKomen = null;
    }

    public function simpanNilai($id)
    {
        $respon = ResponTugas::find($id);
        if(is_numeric($this->inputNilai)){
            $respon->nilai = $this->inputNilai;
            $respon->save();
            $this->dispatchBrowserEvent('toast', ['icon' => 'success', 'title' => 'Berhasil menyimpan nilai']);
            $this->inputNilai = null;
        }else{
            $this->dispatchBrowserEvent('toast', ['icon' => 'error', 'title' => 'Nilai harus berupa angka']);
            $this->inputNilai = null;
        }


    }
}
