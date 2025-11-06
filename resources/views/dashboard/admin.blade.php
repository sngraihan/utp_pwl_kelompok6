<!doctype html><meta charset="utf-8">
<h2>Dashboard Admin</h2>

<div style="margin: 12px 0; display:flex; gap:8px; flex-wrap: wrap;">
  <a href="{{ route('dashboard') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">Dashboard</a>
  <a href="{{ route('mahasiswa.index') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">Kelola Mahasiswa</a>
  <a href="{{ route('perusahaan.index') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">Kelola Perusahaan</a>
  <a href="{{ route('penempatan.index') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">Penempatan</a>
  <a href="{{ route('mahasiswa.create') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">+ Mahasiswa</a>
  <a href="{{ route('perusahaan.create') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">+ Perusahaan</a>
  <a href="{{ route('penempatan.create') }}" style="padding:8px 12px; border:1px solid #ccc; text-decoration:none;">+ Penempatan</a>
  <form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button style="padding:8px 12px; border:1px solid #ccc; background:#f8f8f8; cursor:pointer;">Logout</button>
  </form>
  
</div>
