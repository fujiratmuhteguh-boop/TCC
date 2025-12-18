<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;
use Illuminate\Support\Facades\Auth;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = \App\Models\Identitas::latest()->get()->map(function ($item) {
            // Sensor NIK (Hanya tampilkan 6 angka awal)
            $item->nik = substr($item->nik, 0, 6) . str_repeat('*', strlen($item->nik) - 6);
            
            // Sensor Email (Contoh: t***@example.com)
            $item->email = preg_replace('/(?<=.).(?=[^@]*?@)/', '*', $item->email);
            
            // Sensor Alamat (Hanya tampilkan 10 karakter awal)
            $item->alamat = substr($item->alamat, 0, 10) . '... (Disensor)';
            
            return $item;
        });

        return view('index', compact('identitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'required|digits_between:15,20|numeric',
            'alamat' => 'required|string|max:255',
            'email'  => 'required|email:rfc,dns',
        ]);

        Identitas::create([
            'nama'   => $request->nama,
            'nik'    => $request->nik,
            'alamat' => $request->alamat,
            'email'  => $request->email,
        ]);

        return redirect()->route('home')->with('success', 'Data berhasil disimpan!');
    }
}