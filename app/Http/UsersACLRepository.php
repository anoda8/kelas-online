<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        return \Auth::id();
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {

        if(Auth::user()->hasRole('guru')){
            $username = auth()->user()->name;
            if(!Storage::disk('public')->exists('kelasonline/'.$username)){
                Storage::disk('public')->makeDirectory('kelasonline/'.$username, 0775, true);
            }
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1],
                ['disk' => 'public', 'path' => 'kelasonline', 'access' => 1],
                ['disk' => 'public', 'path' => 'kelasonline/'.$username, 'access' => 1],
                ['disk' => 'public', 'path' => 'kelasonline/'.$username.'/*', 'access' => 2]
            ];
        }
        // if (Auth::id() === 1) {
        //
        // }

        // return [
        //     ['disk' => 'disk-name', 'path' => '/', 'access' => 1],                                  // main folder - read
        //     ['disk' => 'disk-name', 'path' => 'users', 'access' => 1],                              // only read
        //     ['disk' => 'disk-name', 'path' => 'users/'. Auth::user()->name, 'access' => 1],        // only read
        //     ['disk' => 'disk-name', 'path' => 'users/'. Auth::user()->name .'/*', 'access' => 2],  // read and write
        // ];
    }
}
