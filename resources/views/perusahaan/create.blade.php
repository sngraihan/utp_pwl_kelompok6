<h3>Tambah Perusahaan</h3>
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

<form method="POST" action="{{ route('perusahaan.store') }}">
  @csrf
  <div>
    <label for="nama">Nama Perusahaan</label>
    <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama" required>
    @error('nama')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
    @error('alamat')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="pic">PIC</label>
    <input id="pic" name="pic" value="{{ old('pic') }}" placeholder="Nama PIC">
    @error('pic')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="kontak">Kontak</label>
    <input id="kontak" name="kontak" value="{{ old('kontak') }}" placeholder="Kontak (HP/Email)">
    @error('kontak')
      <span style="color: red;">{{ $message }}</span>
    @enderror
  </div><br>

  <button type="submit">Simpan</button>
  <a href="{{ route('perusahaan.index') }}">Batal</a>
  
</form>
