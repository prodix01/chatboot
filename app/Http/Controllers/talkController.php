<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class talkController extends Controller

//talk view に連結
{
    public function talk() {
        return view('talk');
    }
}
