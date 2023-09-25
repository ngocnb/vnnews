<?php

use App\Http\Controllers\API\PostAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('posts', App\Http\Controllers\API\PostAPIController::class)
    ->except(['create', 'edit']);

Route::resource('users', App\Http\Controllers\API\UserAPIController::class)
    ->except(['create', 'edit']);

Route::resource('tags', App\Http\Controllers\API\TagAPIController::class)
    ->except(['create', 'edit']);

Route::post('/loadData', [PostAPIController::class, 'loadData']);
Route::get('/getNewsById/{id}', [PostAPIController::class, 'getNewsById']);
Route::get('/search/{input?}/{count?}', [PostAPIController::class, 'search']);
Route::get('/getSourceNames', [PostAPIController::class, 'getSourceNames']);

Route::post('/login', [UserAPIController::class, 'login']);

Route::middleware('api_token')->group(function () {
    Route::Post('getUser', [UserAPIController::class, 'getUser']);
});
