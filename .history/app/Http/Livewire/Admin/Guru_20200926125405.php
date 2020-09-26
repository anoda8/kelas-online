<?php

namespace App\Http\Livewire\Admin;

use App\Exports\GuruExport;
use App\Imports\GuruImport;
use App\Models\Guru as ModelsGuru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;

class Guru extends Component
{
    use WithFileUploads;

    public $user_id, $nama, $nik, $nip;
    public $modeEdit = false;
    public $buatUser = 'checked';
    public $loginUser = 'nip';
    public $fileimport;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "Data Guru",
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
    }

    public function render()
    {
        return view('livewire.admin.guru', [
            'gurus' => ModelsGuru::with('user')->get()
        ]);
    }

    public function simpan()
    {
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'nik' => 'required'
        ]);

        $user = User::updateOrCreate([
            'email' => $this->nip
        ],[
            'name' => $this->nama,
            'email' => $this->nip,
            'password' => Hash::make($this->nip)
        ]);

        if(!$this->modeEdit){
            $user->attachRole('guru');
        }

        $guru = ModelsGuru::updateOrCreate([
            'nik' => $this->nik
        ],[
            'nama' => $this->nama,
            'nip' => $this->nip,
            'nik' => $this->nik,
            'user_id' => $user->id
        ]);

        $this->emit('closeAddForm');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.$this->nama]);
        $this->celarForm();
    }

    public function edit($id)
    {
        $guru = ModelsGuru::find($id);
        $this->nama = $guru->nama;
        $this->nik = $guru->nik;
        $this->nip = $guru->nip;
        $this->modeEdit = true;
    }

    public function hapus($id)
    {
        $guru = ModelsGuru::find($id);
        $user = User::find($guru->user_id);
        $nama = $guru->nama;
        $guru->delete();
        $user->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => "Guru ".$nama." berhasil dihapus"]);
    }

    public function celarForm()
    {
        $this->nama = '';
        $this->nik = '';
        $this->nip = '';
        $this->modeEdit = false;
    }

    public function import(){
        // dd(request()->file('fileimport'));
        $this->validate([
            'fileimport' => 'mimes:xls,xlsx'
        ]);

        $this->fileimport->store('import_temp', 'guru_temp');
        Excel::import(new GuruImport, 'users.xlsx');
    }

    public function export()
    {
        $tgl = date('Y-m-d H-i-s');
        return Excel::download(new GuruExport, 'guru_'.$tgl.'.xlsx');
    }

}
