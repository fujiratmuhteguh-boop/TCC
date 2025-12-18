<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function store(Request $request) {
        Absensi::create([
            'user_id' => auth()->id(),
            'tanggal' => now()->format('Y-m-d'),
            'jam_masuk' => now()->format('H:i:s'),
            'status' => 'Hadir',
        ]);
        return back()->with('success', 'Berhasil Absen Masuk!');
    }

    public function riwayat() {
        $riwayat = Absensi::where('user_id', auth()->id())->latest()->get();
        return view('user.riwayat_absen', compact('riwayat'));
    }
}
