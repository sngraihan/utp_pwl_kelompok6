<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PerusahaanController extends Controller
{
    public function index()
    {
        $data = Perusahaan::with('owner')->latest()->paginate(10);
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
            'email' => 'nullable|email|unique:users,email',
        ]);

        // Determine login email for perusahaan owner
        $email = $r->input('email');
        if (!$email) {
            $base = Str::slug($v['nama'], '.');
            $domain = 'company.local';
            $email = ($base ?: 'company') . '@' . $domain;
            $try = 1;
            while (User::where('email', $email)->exists()) {
                $email = ($base ?: 'company') . "+$try@" . $domain;
                $try++;
            }
        }

        // Create owner user with default password
        $user = User::create([
            'name' => $v['nama'],
            'email' => $email,
            'password' => Hash::make('12345678'),
            'role' => 'perusahaan',
        ]);

        // Create perusahaan linked to owner user
        $pData = collect($v)->except(['email'])->toArray();
        $pData['owner_user_id'] = $user->id;
        Perusahaan::create($pData);

        return redirect('/perusahaan')->with('ok', 'Perusahaan dibuat. Login: ' . $email . ' / 12345678');
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
