<?php

namespace App\Exports;

use App\Models\Mapel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.siswa', [
            'mapels' => Mapel::all()
        ]);
    }
}
