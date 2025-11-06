<h3>Tambah Mahasiswa</h3>
@if(session('ok'))
  <div style="color: green;">{{ session('ok') }}</div>
@endif
@if($errors->any())
  <div style="color: red;">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form method="POST" action="{{ route('mahasiswa.store') }}">
  @csrf
  <div>
    <label for="npm">NPM</label>
    <input id="npm" name="npm" value="{{ old('npm') }}" placeholder="NPM" required>
    @error('npm')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>
  <div>
    <label for="nama">Nama</label>
    <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama" required>
    @error('nama')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>
  <div>
    <label for="jurusan">Jurusan</label>
    <input id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Jurusan">
    @error('jurusan')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>
  <div>
    <label for="angkatan">Angkatan</label>
    <input type="number" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="Angkatan">
    @error('angkatan')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>
  <div>
    <label for="kontak_pribadi">Kontak pribadi</label>
    <textarea id="kontak_pribadi" name="kontak_pribadi"
      placeholder="Kontak pribadi">{{ old('kontak_pribadi') }}</textarea>
    @error('kontak_pribadi')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>
  <button type="submit">Simpan</button>
</form>