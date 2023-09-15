<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostAPIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.homepage');
});

Route::get('/homepage', function () {
    return view('user.homepage');
});

Route::get('/search/{input}', [PostAPIController::class, 'searchPage']);
