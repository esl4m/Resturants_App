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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/resturants', [ResturantController::class, 'index' ])->name('resturants');
Route::get('/resturants/sorting/{keyword}', [ResturantController::class, 'sorting' ])->name('sorting');
