<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Halaman Publik (Tanpa Login)
Route::get('/', [IdentitasController::class, 'index'])->name('home');

// Routes Login/Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Khusus Admin
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin (Tempat input data pegawai)
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard', function () {
        $absensis = \App\Models\Absensi::where('user_id', auth()->id())->latest()->get();
        return view('user_dashboard', compact('absensis'));
    })->name('dashboard');

    Route::post('/absen/store', function () {
        \App\Models\Absensi::create([
            'user_id' => auth()->id(),
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'status' => 'Hadir'
        ]);
        return back()->with('success', 'Absen berhasil dicatat!');
    })->name('user.absen.store');
    
    // Proses Simpan Data Pegawai
    Route::post('/admin/identitas/store', [AdminController::class, 'storeIdentitas'])->name('admin.identitas.store');

    // TAMBAHAN PENTING: Proses Simpan Akun User Baru (Untuk mengatasi error Route not defined)
    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
});