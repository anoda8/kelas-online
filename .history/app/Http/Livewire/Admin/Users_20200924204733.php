<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $level, $users, $nama, $username, $password, $repass;

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

        $this->users = User::whereHas(
            'roles', function($q){
                $q->where('name', $this->level);
            }
        )->get();
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

        $this->dispatchBrowserEvent('toast', ['icon' => 'success','title' => 'Berhasil menambahkan '.ucwords($this->level)]);
        $this->users->prepend($user);
        $this->emit('closeModalUser');
    }

    public function render()
    {
        return view('livewire.admin.users');
    }


}
