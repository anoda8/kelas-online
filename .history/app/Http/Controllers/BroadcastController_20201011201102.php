<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function authenticate(Request $request)
    {
        return Broadcast::auth($request);
    }
}
