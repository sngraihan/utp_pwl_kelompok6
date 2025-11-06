<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('penempatan_id', 1)->orderBy('tanggal','desc')->get();
        return view('absensi.index', compact('absensi'));
    }

    public function store()
    {
        $today = now()->toDateString();

        $exists = Absensi::where('penempatan_id', 1)
            ->where('tanggal', $today)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Kamu sudah absen hari ini.');
        }

        Absensi::create([
            'penempatan_id' => 1, // nanti otomatis dari user login
            'tanggal' => $today,
            'jam_masuk' => now()->format('H:i:s'),
            'status' => 'hadir',
        ]);

        return back()->with('ok', 'Absensi berhasil.');
    }
}
