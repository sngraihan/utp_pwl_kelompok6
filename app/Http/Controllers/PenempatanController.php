<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index()
    {
        $penempatans = Penempatan::with(['mahasiswa', 'perusahaan'])
            ->latest()
            ->paginate(10);

        return view('penempatan.index', compact('penempatans'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $perusahaans = Perusahaan::orderBy('nama')->get();

        return view('penempatan.create', compact('mahasiswas', 'perusahaans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'mulai' => 'required|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
        ]);

        // Cegah duplikat mahasiswa di perusahaan yang sama dalam periode sama
        $exists = Penempatan::where('mahasiswa_id', $data['mahasiswa_id'])
            ->where('perusahaan_id', $data['perusahaan_id'])
            ->whereNull('selesai')
            ->exists();

        if ($exists) {
            return back()->withErrors(['mahasiswa_id' => 'Mahasiswa ini sudah ditempatkan di perusahaan tersebut.']);
        }

        Penempatan::create($data);
        return redirect()->route('penempatan.index')->with('ok', 'Penempatan berhasil dibuat');
    }

    public function edit(Penempatan $penempatan)
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $perusahaans = Perusahaan::orderBy('nama')->get();

        return view('penempatan.edit', compact('penempatan', 'mahasiswas', 'perusahaans'));
    }

    public function update(Request $request, Penempatan $penempatan)
    {
        $data = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'mulai' => 'required|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
        ]);

        $penempatan->update($data);
        return redirect()->route('penempatan.index')->with('ok', 'Penempatan diperbarui');
    }

    public function destroy(Penempatan $penempatan)
    {
        $penempatan->delete();
        return back()->with('ok', 'Penempatan dihapus');
    }
}
