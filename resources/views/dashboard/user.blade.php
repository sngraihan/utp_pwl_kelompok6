<!doctype html><meta charset="utf-8">
<h2>Dashboard Mahasiswa</h2>
<p>Halo, {{ auth()->user()->name }}</p>

@if($penempatan)
  <div>
    <p>Tempat Magang: <strong>{{ $penempatan->perusahaan?->nama ?? '-' }}</strong></p>
    <p>Periode: {{ $penempatan->mulai }} s/d {{ $penempatan->selesai ?? 'sekarang' }}</p>
    <p><a href="{{ route('absensi.index') }}">Buka Halaman Absensi</a></p>
  </div>
@else
  <p>Belum ada penempatan aktif. Silakan hubungi admin untuk penempatan.</p>
@endif

<form method="POST" action="{{ route('logout') }}">@csrf<button>Logout</button></form>
