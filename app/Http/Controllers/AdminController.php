<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa buka halaman ini
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak!');
        }

        // Ambil semua data dari tabel identitas
        $data = Identitas::all();

        return view('dashboard', compact('data'));
    }
}
