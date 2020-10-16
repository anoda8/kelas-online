<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Auth::user()->hasRole('admin'));
        if (Auth::user()->hasRole('admin')) {
            redirect('/home/admin');
        }

        if (Auth::user()->hasRole('guru')) {
            redirect('/home/guru');
        }

        if (Auth::user()->hasRole('siswa')) {
            redirect('/home/siswa');
        }
        // return view('home');
    }
}
