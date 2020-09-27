<?php

namespace App\Imports;

use App\Models\Mapel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MapelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if($row[0] != "Nama Mapel")
            Mapel::create([
                'guru_id' => $this->guru,
                'author_id' => Auth::id(),
                'nama' => $this->nama
            ]);
        }
    }
}
