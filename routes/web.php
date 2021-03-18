<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\talkController;
use App\Http\Controllers\testController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/index', function () {
    return view('index');
});

Route::get('/', [talkController::class, 'talk']);


