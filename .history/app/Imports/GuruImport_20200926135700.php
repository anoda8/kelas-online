<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuruImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if($row[0] != "Nama"){
                $username = $row[2] ?? $row[1];
                User::create([
                    'name' => $row[0],
                    'email' => $username,
                    'password' => Hash::make($username)
                ])
            }
        }
    }
}
