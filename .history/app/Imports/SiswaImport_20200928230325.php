<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    private $data;

    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if($row[0] != "Nama"){
                $username = $row[1];
                $user = User::updateOrCreate([
                    'email' => $username
                ],[
                    'name' => $row[0],
                    'email' => $username,
                    'password' => Hash::make($username)
                ]);

                if($user->roles != 'siswa'){
                    $user->attachRole('siswa');
                }

                $data = [
                    'nama' => $row[0],
                    'nis' => $row[1],
                    'jenkel' => $row[2],
                    'tgl_lahir' => $row[3],
                    'user_id' => $user->id,
                    'kelas_id' => 0
                ];
            }
        }

        Siswa::insert($data);
    }
}
