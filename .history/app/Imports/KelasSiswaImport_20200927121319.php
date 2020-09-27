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
                $nis = substr($row[1], -1, strlen($row[1]));
                $siswa = Siswa::where('nis', $row[1])->update(['kelas_id' => $this->kelasid]);
            }
        }
    }
}
