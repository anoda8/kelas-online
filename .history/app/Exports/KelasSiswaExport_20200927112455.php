<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KelasSiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $kelasid;

    function __construct($kelasid)
    {
        $this->kelasid = $kelasid;
    }

    public function view(): View
    {
        return view('exports.kelassiswa', [
            'siswas' => Siswa::where('kelas_id', $this->kelasid)->with(['kelas'])->get()
        ]);
    }
}
