<?php

namespace App\Http\Livewire\Admin;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\Siswa as ModelsSiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Siswa extends Component
{
    public $user_id, $kelas_id, $nama, $nis, $jenkel, $tgl_lahir;
    public $modeEdit = false;

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

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'nis'=> 'required',
            'jenkel' => 'required',
            'tgl_lahir' => 'required'
        ]);

        $user = User::updateOrCreate([
            'email' => $this->nis
        ],[
            'name' => $this->nama,
            'email' => $this->nis,
            'password' => Hash::make($this->nis)
        ]);

        if(!$this->modeEdit){
            $user->attachRole('siswa');
        }

        ModelsSiswa::updateOrCreate([
            'nis' => $this->nis
        ], [
            'nama' => $this->nama,
            'nis' => $this->nis,
            'jenkel' => $this->jenkel,
            'tgl_lahir' => $this->tgl_lahir,
            'user_id' => $user->id,
            'kelas_id' => '0'
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->clearForm();
    }

    public function edit($id)
    {
        $siswa = ModelsSiswa::find($id);
        $this->nama = $siswa->nama;
        $this->nis = $siswa->nis;
        $this->tgl_lahir = $siswa->tgl_lahir;
        $this->jenkel = $siswa->jenkel;
        $this->modeEdit = true;
    }

    public function clearForm()
    {
        $this->nama = '';
        $this->nis = '';
        $this->tgl_lahir = '';
        $this->jenkel = '';
    }

    public function hapus($id)
    {
        $siswa = ModelsSiswa::find($id);
        $user = User::find($siswa->user_id);
        $nama = $siswa->nama;
        $siswa->delete();
        $user->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Siswa ".$nama." berhasil dihapus"]);
    }

    public function import(){
        $this->validate([
            'fileimport' => 'mimes:xls,xlsx'
        ]);

        $namafile = 'siswa_temp.'.$this->fileimport->extension();
        $this->fileimport->storeAs('import_temp', $namafile);
        Excel::import(new SiswaImport, storage_path('app/import_temp/'.$namafile));
        $this->emit('closeImportForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Guru mengimport file"]);
    }

    public function export()
    {
        $tgl = date('Y-m-d H-i-s');
        return Excel::download(new SiswaExport, 'siswa_'.$tgl.'.xlsx');
    }
}
