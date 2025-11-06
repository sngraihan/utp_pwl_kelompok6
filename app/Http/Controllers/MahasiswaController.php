<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::with('user')->latest()->paginate(10);
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
            'email' => 'nullable|email|unique:users,email',
        ]);
        // Determine login email
        $email = $r->input('email');
        if (!$email) {
            $baseLocal = preg_replace('/[^a-zA-Z0-9_.-]/', '', $v['npm']);
            $domain = 'student.local';
            $email = $baseLocal . '@' . $domain;
            // ensure uniqueness for generated email
            $try = 1;
            while (\App\Models\User::where('email', $email)->exists()) {
                $email = $baseLocal . "+$try@" . $domain;
                $try++;
            }
        }

        // Create user account with default password
        $user = \App\Models\User::create([
            'name' => $v['nama'],
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        // Create Mahasiswa linked to user
        $mData = collect($v)->except(['email'])->toArray();
        $mData['user_id'] = $user->id;
        Mahasiswa::create($mData);

        return redirect('/mahasiswa')->with('ok', 'Mahasiswa dibuat. Login: ' . $email . ' / 12345678');
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
