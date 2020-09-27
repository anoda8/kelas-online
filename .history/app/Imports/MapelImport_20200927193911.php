<?php

namespace App\Imports;

use App\Models\Mapel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class MapelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if($row[0] != "Nama Mapel"){
                Mapel::create([
                    'guru_id' => $row[2],
                    'author_id' => Auth::id(),
                    'nama' => $row[0]
                ]);
            }
        }
    }
}
