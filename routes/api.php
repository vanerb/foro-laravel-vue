<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\UserController;
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

Route::resource('foro', ForoController::class)->only(['index', 'store', 'update', 'show', 'destroy']);
Route::resource('category', Category::class)->only(['index', 'store', 'update', 'show', 'destroy']);
Route::resource('comment', CommentsController::class)->only(['index', 'store', 'update', 'show', 'destroy']);
Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'show', 'destroy']);
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/foroall', [ForoController::class, 'foroall'])->name('foroall');