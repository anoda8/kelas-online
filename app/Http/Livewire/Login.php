<?php

namespace App\Http\Livewire;

use App\Models\ThAjaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $users, $email, $password, $name, $thajaran;
    public $thterpilih;

    public function mount()
    {
        $this->thajaran = ThAjaran::all();
        $this->thterpilih = $this->thajaran->firstWhere('status', 1)->kode;
    }

    public function render()
    {
        return view('livewire.login');
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
            session(['thajaran' => $this->thterpilih]);
            $user = User::find(Auth::id());
            return redirect()->to('/'.$user->roles[0]->name);
        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }
}
