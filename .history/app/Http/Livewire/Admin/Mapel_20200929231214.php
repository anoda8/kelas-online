<?php

namespace App\Http\Livewire\Admin;

use App\Exports\MapelExport;
use App\Imports\MapelImport;
use App\Models\Guru;
use App\Models\Mapel as ModelsMapel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Mapel extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $guru, $author_id, $nama;
    public $fileimport;
    public $perpage = 10;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Mata Pelajaran",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        $mapels = ModelsMapel::where('thajaran', session('thajaran'))->with(['guru', 'author'])->paginate($this->perpage);
        $gurus = Guru::all();
        return view('livewire.admin.mapel', [
            'mapels' => $mapels, 'gurus' => $gurus
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'guru' => 'required'
        ]);

        ModelsMapel::create([
            'guru_id' => $this->guru,
            'author_id' => Auth::id(),
            'nama' => $this->nama,
            'thajaran' => session('thajaran')
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->nama = '';
        $this->guru = '';
        $this->author_id = '';
    }

    public function hapus($id)
    {
        $mapel = ModelsMapel::find($id);
        $nama = $mapel->nama;
        $mapel->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil mennghapus '.$nama]);
    }

    public function import(){
        $this->validate([
            'fileimport' => 'mimes:xls,xlsx'
        ]);

        $namafile = 'mapel_temp.'.$this->fileimport->extension();
        $this->fileimport->storeAs('import_temp', $namafile);
        Excel::import(new MapelImport, storage_path('app/import_temp/'.$namafile));
        $this->emit('closeImportForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Berhasil mengimport file"]);
    }

    public function export()
    {
        $tgl = date('Y-m-d H-i-s');
        return Excel::download(new MapelExport, 'mapel_'.$tgl.'.xlsx');
    }
}
