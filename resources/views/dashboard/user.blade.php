<!doctype html><meta charset="utf-8">
<h2>Dashboard Mahasiswa</h2>
<p>Halo, {{ auth()->user()->name }}</p>

@if(isset($penempatan) && $penempatan)
  <p>Tempat Magang: <strong>{{ $penempatan->perusahaan->nama }}</strong></p>
@else
  <p>Belum ada penempatan magang.</p>
@endif

<p><a href="/absensi">Absensi</a> (akan kita aktifkan setelah controller absensi siap)</p>

<form method="POST" action="/logout">@csrf<button>Logout</button></form>
