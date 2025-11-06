<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Penempatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'mahasiswa') {
            abort(403);
        }

        $today = now()->toDateString();
        $mahasiswa = $user->mahasiswa;
        $active = null;
        $absensi = collect();

        if ($mahasiswa) {
            $active = Penempatan::where('mahasiswa_id', $mahasiswa->id)
                ->whereDate('mulai', '<=', $today)
                ->where(function ($q) use ($today) {
                    $q->whereNull('selesai')->orWhereDate('selesai', '>=', $today);
                })
                ->latest('mulai')
                ->first();

            if ($active) {
                $absensi = Absensi::where('penempatan_id', $active->id)
                    ->orderBy('tanggal', 'desc')
                    ->limit(30)
                    ->get();
            }
        }

        return view('absensi.index', compact('absensi', 'active'));
    }

    public function store(Request $r)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'mahasiswa') {
            abort(403);
        }

        $today = now()->toDateString();
        $nowTime = now()->format('H:i:s');
        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return back()->with('warning', 'Data mahasiswa tidak ditemukan.');
        }

        $active = Penempatan::where('mahasiswa_id', $mahasiswa->id)
            ->whereDate('mulai', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->whereNull('selesai')->orWhereDate('selesai', '>=', $today);
            })
            ->latest('mulai')
            ->first();

        if (!$active) {
            return back()->with('warning', 'Kamu belum memiliki penempatan aktif.');
        }

        $todayRow = Absensi::where('penempatan_id', $active->id)
            ->where('tanggal', $today)
            ->first();

        if ($todayRow) {
            if (!$todayRow->jam_pulang) {
                $todayRow->update(['jam_pulang' => $nowTime]);
                return back()->with('ok', 'Jam pulang tercatat.');
            }
            return back()->with('warning', 'Absensi hari ini sudah lengkap.');
        }

        Absensi::create([
            'penempatan_id' => $active->id,
            'tanggal' => $today,
            'jam_masuk' => $nowTime,
            'status' => 'hadir',
        ]);

        return back()->with('ok', 'Jam masuk tercatat.');
    }
}
