<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;
use App\Models\User; // Pastikan Model User di-import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Untuk password

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak!');
        }

        // Ambil data Identitas untuk tabel pegawai
        $identitas = Identitas::with('user.absensis')->latest()->get(); 
        
        // Ambil data User untuk tabel akun (Mengatasi error Undefined variable $users)
        $users = User::with('absensis')->get();

        // Kirim $identitas DAN $users ke view dashboard (atau index jika itu file admin Anda)
        // Perhatikan: Saya mendeteksi file admin Anda mungkin bernama 'index.blade.php' berdasarkan error log
        return view('dashboard', compact('identitas', 'users')); // UBAH JADI INI
    }

    public function storeIdentitas(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'nik'    => 'required|numeric',
            'alamat' => 'required',
            'email'  => 'required|email',
        ]);

        // 1. Simpan ke tabel Identitas
        Identitas::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        // 2. Simpan ke tabel Users agar bisa login
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Default sebagai user biasa
        ]);

        return back()->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Fungsi untuk menambah User Baru (Mengatasi error Route not defined)
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }
}