<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::latest()->paginate(10);
        return view('mahasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $r)
    {
        $v = $r->validate([
            'npm' => 'required|unique:mahasiswas,npm',
            'nama' => 'required|string|max:150',
            'jurusan' => 'nullable|string|max:150',
            'angkatan' => 'nullable|integer|min:2000|max:2100',
            'kontak_pribadi' => 'nullable|string|max:255',
        ]);
        Mahasiswa::create($v);
        return redirect('/mahasiswa')->with('ok', 'Data mahasiswa ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $r, Mahasiswa $mahasiswa)
    {
        $v = $r->validate([
            'npm' => 'required|unique:mahasiswas,npm,' . $mahasiswa->id,
            'nama' => 'required|string|max:150',
            'jurusan' => 'nullable|string|max:150',
            'angkatan' => 'nullable|integer|min:2000|max:2100',
            'kontak_pribadi' => 'nullable|string|max:255',
        ]);
        $mahasiswa->update($v);
        return redirect('/mahasiswa')->with('ok', 'Data diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return back()->with('ok', 'Data dihapus');
    }
}
