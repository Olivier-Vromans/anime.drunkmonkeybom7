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
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/anime', [AnimeController::class, 'index']);
//Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
Route::resource('anime', AnimeController::class);

Auth::routes();
