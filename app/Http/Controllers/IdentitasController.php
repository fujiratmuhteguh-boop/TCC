<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;

class IdentitasController extends Controller
{
    public function index()
    {
        // Ambil semua data dari database (urut terbaru)
        $identitas = Identitas::latest()->get()->map(function ($item) {
            // Masking NIK & Email sebelum ditampilkan
            $item->nik = substr($item->nik, 0, 6) . str_repeat('*', strlen($item->nik) - 6);
            $item->email = preg_replace('/(?<=.).(?=[^@]*?@)/', '*', $item->email);
            return $item;
        });

        // Kirim ke view
        return view('index', compact('identitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'required|digits_between:15,20|numeric',
            'alamat' => 'required|string|max:255',
            'email'  => 'required|email:rfc,dns',
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'nik.required'    => 'NIK wajib diisi.',
            'nik.digits_between' => 'NIK harus minimal 15 angka dan maksimal 20 angka.',
            'nik.numeric'     => 'NIK hanya boleh berisi angka.',
            'alamat.required' => 'Alamat wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Email harus valid (contoh: nama@gmail.com).',
        ]);

        // Simpan data ke database
        Identitas::create([
            'nama'   => $request->nama,
            'nik'    => $request->nik,
            'alamat' => $request->alamat,
            'email'  => $request->email,
        ]);

        // Redirect kembali agar tidak double submit, dengan pesan sukses
        return redirect()->route('home')->with('success', 'Data berhasil disimpan ke database!');
    }
}
