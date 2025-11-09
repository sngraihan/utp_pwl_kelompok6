<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Penempatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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

    /**
     * Rekap: daftar tanggal yang sudah dan belum diabsen selama rentang penempatan.
     */
    public function rekap()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'mahasiswa') {
            abort(403);
        }

        $mahasiswa = $user->mahasiswa;
        $active = null;

        if ($mahasiswa) {
            $today = Carbon::today()->toDateString();
            $active = Penempatan::where('mahasiswa_id', $mahasiswa->id)
                ->whereDate('mulai', '<=', $today)
                ->where(function ($q) use ($today) {
                    $q->whereNull('selesai')->orWhereDate('selesai', '>=', $today);
                })
                ->latest('mulai')
                ->first();
        }

        if (!$active) {
            return view('absensi.rekap', [
                'active' => null,
                'rangeStart' => null,
                'rangeEnd' => null,
                'records' => collect(),
                'missing' => [],
            ]);
        }

        $today = Carbon::today();
        $start = Carbon::parse($active->mulai)->startOfDay();
        $periodEnd = $active->selesai ? Carbon::parse($active->selesai)->startOfDay() : null; // untuk tampilan Periode
        // Untuk rekap, gunakan akhir penempatan jika ada; jika belum ditentukan, gunakan hari ini
        $end = $periodEnd ? $periodEnd->copy() : $today->copy();

        $allDates = [];
        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $allDates[] = $d->toDateString();
        }

        $records = Absensi::where('penempatan_id', $active->id)
            ->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
            ->orderBy('tanggal')
            ->get();

        $byDate = $records->keyBy('tanggal');
        $missing = array_values(array_filter($allDates, function ($date) use ($byDate) {
            return !$byDate->has($date);
        }));

        return view('absensi.rekap', [
            'active' => $active,
            'rangeStart' => $start->toDateString(),
            'rangeEnd' => $end->toDateString(),
            'periodStart' => $start->toDateString(),
            'periodEnd' => $periodEnd ? $periodEnd->toDateString() : null,
            'records' => $records,
            'missing' => $missing,
        ]);
    }
}
