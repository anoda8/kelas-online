<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $users, $email, $password, $name, $thajaran;

    public function render()
    {
        $data = [['kode_th' => "20211", 'ket' => "Tahun Pelajaran 2020/2021 Semester 1"],['kode_th' => "20212", 'ket' => "Tahun Pelajaran 2020/2021 Semester 2"],];
        return view('livewire.login', ['thajaran' => $data]);
    }

    private function resetInputField(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        $this->validatedDate = $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            session()->flash('message', "You are Login successful.");
            $user = User::find(Auth::id());
            return redirect()->to('/'.$user->roles[0]->name);
        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }

}
