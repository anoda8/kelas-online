<?php

namespace App\Imports;

use App\Models\Guru;
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
            if($row[0] != "Name"){
                $row[1] = preg_replace('/\s+/', '', $row[1]);
                $row[2] = preg_replace('/\s+/', '', $row[2]);
                $username = ($row[1] == '' ? $row[2] : $row[1]);
                $user = User::updateOrCreate([
                    'email' => $username
                ],[
                    'name' => $row[0],
                    'email' => $username,
                    'password' => Hash::make($username)
                ]);

                if($user->roles != 'guru'){
                    $user->attachRole('guru');
                }

                Guru::updateOrCreate([
                    'nik' => $row[1]
                ], [
                    'nama' => $row[0],
                    'nip' => $row[1],
                    'nik' => $row[2],
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
