<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return view('welcome');
})->middleware('checksession')->name('home');

Route::middleware('checksession')->group(function () {
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');