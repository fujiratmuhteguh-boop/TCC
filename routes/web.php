<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/

// Halaman login utama (default)
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK HALAMAN USER BIASA (FORM IDENTITAS)
|--------------------------------------------------------------------------
*/
Route::get('/identitas', [IdentitasController::class, 'index'])->name('home')->middleware('auth');
Route::post('/identitas/simpan', [IdentitasController::class, 'store'])->name('simpan')->middleware('auth');


/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');
