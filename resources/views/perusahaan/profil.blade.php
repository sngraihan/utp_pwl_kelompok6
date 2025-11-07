<!doctype html>
<meta charset="utf-8">
<h2>Profil Perusahaan</h2>
<p>
  <a href="{{ route('dashboard') }}"
    style="display:inline-block;padding:6px 12px;border:1px solid #ccc;border-radius:6px;text-decoration:none;background:#f7f7f7;">&larr;
    Kembali ke Dashboard</a>
  <span style="color:#888; font-size:0.9em; margin-left:6px;"></span>

</p>

@if(session('ok'))
  <div style="color: green;">{{ session('ok') }}</div>
@endif
@if($errors->any())
  <div style="color: red;">
    <ul>
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div style="display:flex; gap:24px; align-items:flex-start;">
  <div>
    <div
      style="width:120px;height:120px;border:1px solid #ddd;border-radius:8px;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#f9f9f9;">
      @if($perusahaan->logo)
        <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo"
          style="max-width:100%; max-height:100%; object-fit:cover;">
      @else
        <span style="color:#888;">Belum ada logo</span>
      @endif
    </div>
  </div>

  <form method="POST" action="{{ route('perusahaan.profil.update') }}" enctype="multipart/form-data" style="flex:1;">
    @csrf
    <div style="margin-bottom:10px;">
      <label>Nama Perusahaan</label><br>
      <input type="text" name="nama" value="{{ old('nama', $perusahaan->nama) }}" required>
    </div>
    <div style="margin-bottom:10px;">
      <label>Logo (jpg/png/svg/gif, maks 2MB)</label><br>
      <input type="file" name="logo" accept="image/*">
    </div>
    <button type="submit">Simpan Perubahan</button>
    <a href="{{ route('dashboard') }}">Kembali</a>
  </form>
</div>

<p style="margin-top:16px;color:#666;font-size:0.9em;">Catatan: Pastikan sudah menjalankan perintah
  <code>php artisan storage:link</code> agar logo tampil.</p>