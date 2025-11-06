<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        $cred = $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($cred)) {
            $r->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $r)
    {
        $base = $r->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:mahasiswa,perusahaan',
        ]);

        $user = User::create([
            'name' => $base['name'],
            'email' => $base['email'],
            'password' => Hash::make($base['password']),
            'role' => $base['role'],
        ]);

        if ($base['role'] === 'mahasiswa') {
            // If admin already created a Mahasiswa with this NPM, claim it; otherwise create new
            $studentData = $r->validate([
                'npm' => 'required|string|max:20',
                'jurusan' => 'nullable|string|max:150',
                'angkatan' => 'nullable|integer|min:2000|max:2100',
                'kontak_pribadi' => 'nullable|string|max:255',
            ]);

            $existing = \App\Models\Mahasiswa::where('npm', $studentData['npm'])->first();

            if ($existing) {
                if ($existing->user_id) {
                    return back()->withErrors(['npm' => 'NPM ini sudah memiliki akun.'])->withInput();
                }
                $existing->update(['user_id' => $user->id] + collect($studentData)->except('npm')->toArray());
            } else {
                \App\Models\Mahasiswa::create([
                    'user_id' => $user->id,
                    'npm' => $studentData['npm'],
                    'nama' => $base['name'],
                    'jurusan' => $studentData['jurusan'] ?? null,
                    'angkatan' => $studentData['angkatan'] ?? null,
                    'kontak_pribadi' => $studentData['kontak_pribadi'] ?? null,
                ]);
            }
        } else {
            // perusahaan
            $companyData = $r->validate([
                'company_name' => 'required|string|max:150',
                'alamat' => 'nullable|string|max:255',
                'pic' => 'nullable|string|max:150',
                'kontak' => 'nullable|string|max:150',
            ]);

            $existing = \App\Models\Perusahaan::where('nama', $companyData['company_name'])->first();
            if ($existing) {
                if ($existing->owner_user_id) {
                    return back()->withErrors(['company_name' => 'Perusahaan ini sudah memiliki akun.'])->withInput();
                }
                $existing->update([
                    'owner_user_id' => $user->id,
                    'alamat' => $companyData['alamat'] ?? $existing->alamat,
                    'pic' => $companyData['pic'] ?? $existing->pic,
                    'kontak' => $companyData['kontak'] ?? $existing->kontak,
                ]);
            } else {
                \App\Models\Perusahaan::create([
                    'owner_user_id' => $user->id,
                    'nama' => $companyData['company_name'],
                    'alamat' => $companyData['alamat'] ?? null,
                    'pic' => $companyData['pic'] ?? null,
                    'kontak' => $companyData['kontak'] ?? null,
                ]);
            }
        }

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/login');
    }
}
