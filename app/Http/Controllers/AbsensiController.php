<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Penempatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman absensi dan riwayat
     */
    public function index()
    {
        // ... (Tidak ada perubahan di method index)
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

    /**
     * Menyimpan data absensi baru (HANYA CREATE, TIDAK BISA UPDATE)
     */
    public function store(Request $r)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'mahasiswa') {
            abort(403);
        }

        // 1. Validasi Input Form (Sama seperti sebelumnya)
        $validated = $r->validate([
            'tanggal' => 'required|date',
            'status' => ['required', Rule::in(['hadir', 'izin', 'sakit'])],
            'jam_masuk' => 'required_if:status,hadir|nullable|date_format:H:i',
            'jam_pulang' => 'required_if:status,hadir|nullable|date_format:H:i|after_or_equal:jam_masuk',
            'catatan' => 'nullable|string|max:500',
        ]);

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return back()->with('warning', 'Data mahasiswa tidak ditemukan.');
        }

        // 2. Cari Penempatan Aktif (Sama seperti sebelumnya)
        $active = Penempatan::where('mahasiswa_id', $mahasiswa->id)
            ->whereDate('mulai', '<=', $validated['tanggal'])
            ->where(function ($q) use ($validated) {
                $q->whereNull('selesai')->orWhereDate('selesai', '>=', $validated['tanggal']);
            })
            ->latest('mulai')
            ->first();

        if (!$active) {
            return back()->with('warning', 'Kamu tidak memiliki penempatan aktif pada tanggal tersebut.');
        }

        // --- PERUBAHAN LOGIKA DIMULAI DI SINI ---

        // 3. Cek apakah data absensi sudah ada
        $existingAbsensi = Absensi::where('penempatan_id', $active->id)
            ->where('tanggal', $validated['tanggal'])
            ->first();

        // 4. Jika sudah ada, kembalikan pesan error dan hentikan proses
        if ($existingAbsensi) {
            return back()->with('warning', 'Absensi untuk tanggal ' . $validated['tanggal'] . ' sudah tersimpan dan tidak bisa diubah.');
        }

        // 5. Jika belum ada, buat data baru
        Absensi::create([
            'penempatan_id' => $active->id,
            'tanggal' => $validated['tanggal'],
            'status' => $validated['status'],
            'jam_masuk' => ($validated['status'] == 'hadir') ? $validated['jam_masuk'] : null,
            'jam_pulang' => ($validated['status'] == 'hadir') ? $validated['jam_pulang'] : null,
            'catatan' => $validated['catatan'],
        ]);

        // --- PERUBAHAN LOGIKA SELESAI ---

        return back()->with('ok', 'Data absensi berhasil disimpan.');
    }
}