<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KelasSiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    protected $kelasid;

    function __construct($kelasid)
    {
        $this->kelasid = $kelasid;
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if($row[0] != 'Nama'){
                $siswa = Siswa::where('nis', $row[1]);
                $siswa->kelas_id = $this->kelasid;
                $siswa->save();
            }
        }
    }
}
