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

        // role 'mahasiswa'
        if ($user->role === 'mahasiswa') {
            $today = now()->toDateString();
            $m = $user->mahasiswa;
            $penempatan = null;
            if ($m) {
                $penempatan = \App\Models\Penempatan::with('perusahaan')->where('mahasiswa_id', $m->id)
                    ->whereDate('mulai', '<=', $today)
                    ->where(function ($q) use ($today) {
                        $q->whereNull('selesai')->orWhereDate('selesai', '>=', $today);
                    })
                    ->latest('mulai')
                    ->first();
            }
            return view('dashboard.user', compact('penempatan'));
        }

        // fallback
        return view('dashboard.user', ['penempatan' => null]);
    }
}
