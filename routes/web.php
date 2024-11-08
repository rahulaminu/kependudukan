<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
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
    return view('welcome');
});

Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');