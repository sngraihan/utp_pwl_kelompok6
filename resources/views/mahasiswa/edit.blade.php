<h3>Edit Mahasiswa</h3>
<form method="POST" action="{{ route('mahasiswa.update',$mahasiswa) }}">@csrf @method('PUT')
  <input name="npm" value="{{ $mahasiswa->npm }}" required><br>
  <input name="nama" value="{{ $mahasiswa->nama }}" required><br>
  <input name="jurusan" value="{{ $mahasiswa->jurusan }}"><br>
  <input type="number" name="angkatan" value="{{ $mahasiswa->angkatan }}"><br>
  <textarea name="kontak_pribadi">{{ $mahasiswa->kontak_pribadi }}</textarea><br>
  <button type="submit">Update</button>
</form>
