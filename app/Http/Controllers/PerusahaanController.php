<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $data = Perusahaan::latest()->paginate(10);
        return view('perusahaan.index', compact('data'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $r)
    {
        $v = $r->validate([
            'nama' => 'required|unique:perusahaans,nama',
            'alamat' => 'nullable|string|max:255',
            'pic' => 'nullable|string|max:150',
            'kontak' => 'nullable|string|max:150',
        ]);
        Perusahaan::create($v);
        return redirect('/perusahaan')->with('ok', 'Data perusahaan ditambahkan');
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $r, Perusahaan $perusahaan)
    {
        $v = $r->validate([
            'nama' => 'required|unique:perusahaans,nama,'.$perusahaan->id,
            'alamat' => 'nullable|string|max:255',
            'pic' => 'nullable|string|max:150',
            'kontak' => 'nullable|string|max:150',
        ]);
        $perusahaan->update($v);
        return redirect('/perusahaan')->with('ok', 'Data diperbarui');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return back()->with('ok', 'Data dihapus');
    }
}
