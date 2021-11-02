<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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
Route::post('anime/favorite', [AnimeController::class, 'favorite'])->name('favorite')->middleware('auth.basic');
Route::post('anime/unfavorite', [AnimeController::class, 'unfavorite'])->name('unfavorite')->middleware('auth.basic');
Route::post('/anime/changeStatus', [AnimeController::class, 'updateStatus']);

Route::get('/anime/admin', [AnimeController::class, 'admin'])->name('admin')->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('anime', AnimeController::class);

Route::get('/anime/{genre}', [AnimeController::class, 'showGenre'])->name('genre');

Auth::routes();


//Storage Link
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
