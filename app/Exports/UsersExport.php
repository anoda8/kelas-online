<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $level;

    function __construct($level)
    {
        $this->level = $level;
    }

    public function view(): View
    {
        return view('exports.users', [
            'users' => User::whereHas('roles', function($q){$q->where('name', $this->level);})->get()
        ]);
    }

}
