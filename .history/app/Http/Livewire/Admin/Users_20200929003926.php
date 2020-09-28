<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class Users extends Component
{
    use WithPagination;

    public $level, $nama, $username, $password, $repass, $userId, $perpage = 10;
    public $modeEdit = false;

    public $heading;
    public function heading()
    {
        return [
            'judul' => "User ".ucwords($this->level),
            'keterangan' => ""
        ];
    }

    public function mount(){
        $this->level = request()->segment(3);
        $this->heading = $this->heading();
        if($this->level == 'siswa'){
            $this->perpage = 100;
        }
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::whereHas('roles', function($q){$q->where('name', $this->level);})->paginate($this->perpage)
        ]);
    }

    public function simpanUser()
    {
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'repass' => 'required_with:password|same:password'
        ]);

        $user = User::updateOrCreate([
            'email' => $this->username
        ],[
            'name' => $this->nama,
            'email' => $this->username,
            'password' => Hash::make($this->password)
        ]);

        $user->attachRole($this->level);
        $this->emit('closeModalUser');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.ucwords($this->level)]);
        $this->clearFormUser();
    }

    public function doEditUser(){
        $this->validateDate = $this->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'nullable|min:6',
            'repass' => 'sometimes|required_with:password|same:password'
        ]);

        $data = [
            'name' => $this->nama,
            'email' => preg_replace('/\s+/', '', $this->username)
        ];

        if($this->modeEdit == false){
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate([
            'email' => $this->username,
        ],$data);

        $this->emit('closeModalUser');
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil mengubah '.$user->name]);
        $this->clearFormUser();
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $this->nama = $user->name;
        $this->username = $user->email;
        $this->password = null;
        $this->repass = null;
        $this->modeEdit = true;
    }

    public function userReset($id)
    {
        $user = User::find($id);
        $user->update(['password' => Hash::make($user->username)]);
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $nama = $user->name;
        $user->delete();
        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => $nama." dihapus !"]);
    }

    public function clearFormUser()
    {
        $this->nama = '';
        $this->username = '';
        $this->password = '';
        $this->repass = '';
        $this->modeEdit = false;
    }

    public function export($level)
    {
         return Excel::download(new UsersExport($level), $level.'.xlsx');
    }


}
