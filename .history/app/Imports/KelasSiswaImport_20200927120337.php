<?php

namespace App\Imports;

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

    public function collection(Collection $collection)
    {

    }
}
