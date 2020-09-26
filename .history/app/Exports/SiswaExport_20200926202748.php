<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FormView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return view('exports.guru', [
            'siswas' => Siswa::all()
        ]);
    }
}
