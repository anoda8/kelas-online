<?php

namespace App\Http\Livewire\Admin;

use App\Exports\KelasSiswaExport;
use App\Imports\KelasSiswaImport;
use App\Models\Jurusan;
use App\Models\Kelas as ModelsKelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Kelas extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $nama, $jurusan, $author;

    public $detailKelasNama, $detailKelasId = null;
    public $cariNama = null, $cariNis = null;
    public $perpage = 10;

    public $fileimport;

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
        $kelases = ModelsKelas::with(['jurusan', 'author', 'siswa'])->paginate($this->perpage);
        $detailSiswa = $cariSiswa = [];

        if($this->detailKelasId != null){
            $detailSiswa = Siswa::where('kelas_id', $this->detailKelasId)->orderBy('updated_at', 'DESC')->get();
        }

        if(($this->cariNama != null) || ($this->cariNis != null)){
            $cariSiswa = Siswa::orWhere('nama', 'like', "%".$this->cariNama."%")->where('nis', 'like', "%".$this->cariNis."%")->get();
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

    public function tambahkanSiswa($id)
    {
        $siswa = Siswa::find($id);
        $siswa->kelas_id = $this->detailKelasId;
        $siswa->save();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$siswa->nama]);
    }

    public function hapusSiswa($id)
    {
        $siswa = Siswa::find($id);
        $siswa->kelas_id = 0;
        $siswa->save();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menghapus '.$siswa->nama]);
    }

    public function exportsiswa($kelasid)
    {
        $tgl = date('Y-m-d H-i-s');
        return Excel::download(new KelasSiswaExport($kelasid), 'siswa_'.$tgl.'.xlsx');
    }

    public function import()
    {
        $this->validate([
            'fileimport' => 'mimes:xls,xlsx'
        ]);

        $namafile = 'kelassiswa_temp.'.$this->fileimport->extension();
        $this->fileimport->storeAs('import_temp', $namafile);
        Excel::import(new KelasSiswaImport($this->detailKelasId), storage_path('app/import_temp/'.$namafile));
        $this->emit('closeImportForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Guru mengimport file"]);
    }
}
