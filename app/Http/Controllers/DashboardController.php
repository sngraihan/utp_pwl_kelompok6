<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Perusahaan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin');
        }

        if ($user->role === 'perusahaan') {
            $perusahaan = $user->perusahaan; // relasi owner_user_id
            $penempatans = $perusahaan
                ? $perusahaan->penempatans()->with('mahasiswa')->get()
                : collect();

            return view('dashboard.perusahaan', compact('perusahaan', 'penempatans'));
        }

        // role 'user' (mahasiswa)
        // cari penempatan aktif kalau ada (opsional; aman kalau belum ada)
        $penempatan = $user->relationLoaded('mahasiswa') ? $user->mahasiswa->penempatan ?? null : null;
        // kalau model User tidak punya relasi ke Mahasiswa, skip saja
        return view('dashboard.user', compact('penempatan'));
    }
}
