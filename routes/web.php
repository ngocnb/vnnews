<?php

use App\Http\Controllers\API\PostAPIController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostAPIController::class, 'homePage']);

Route::get('/homepage/{action?}/{page?}', [PostAPIController::class, 'homePage'])->name('homepage');

Route::get('/postdetailpage/{id}', [PostAPIController::class, 'postDetailPage'])->name('postdetailpage');

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/signup', function () {
    return view('user.signup');
});
