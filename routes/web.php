<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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

//Home URL
Route::get('/', [Controller::class, 'index']);


//SubUrl inside the websites
Route::get('/about', [AboutController::class, 'index']);

Route::get('/anime/admin', [AnimeController::class, 'admin'])->name('admin');
Route::get('/anime/{genre}', [AnimeController::class, 'showGenre'])->name('genre');
Route::post('/anime/addAnime', [AnimeController::class, 'create'])->name('add');

Route::resource('anime', AnimeController::class);
Route::resource('profile', ProfileController::class);

Auth::routes();
