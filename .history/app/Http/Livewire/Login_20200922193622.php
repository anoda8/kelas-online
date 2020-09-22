<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $users, $email, $password, $name;

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
            $user = User::find(Auth::id());
            return redirect()->to('/'.$user->roles->name);
        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }

}
