<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResturantController;

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

Route::get('/', [ResturantController::class, 'index' ])->name('resturants');
Route::post('/sorting', [ResturantController::class, 'sorting'])->name('sorting');
Route::post('/fav', [ResturantController::class, 'addFav'])->name('favorite');
Route::delete('/fav', [ResturantController::class, 'removeFav'])->name('unfavorite');
