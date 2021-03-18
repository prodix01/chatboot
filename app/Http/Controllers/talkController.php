<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class talkController extends Controller
{
    public function talk() {
        return view('talk');
    }
}
