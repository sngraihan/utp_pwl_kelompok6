<h3>Edit Perusahaan</h3>
<p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>

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

<form method="POST" action="{{ route('perusahaan.update', $perusahaan) }}">
  @csrf
  @method('PUT')

  <div>
    <label for="nama">Nama Perusahaan</label>
    <input id="nama" name="nama" value="{{ old('nama', $perusahaan->nama) }}" required>
    @error('nama')
      <span style="color:red">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat">{{ old('alamat', $perusahaan->alamat) }}</textarea>
    @error('alamat')
      <span style="color:red">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="pic">PIC</label>
    <input id="pic" name="pic" value="{{ old('pic', $perusahaan->pic) }}">
    @error('pic')
      <span style="color:red">{{ $message }}</span>
    @enderror
  </div><br>

  <div>
    <label for="kontak">Kontak</label>
    <input id="kontak" name="kontak" value="{{ old('kontak', $perusahaan->kontak) }}">
    @error('kontak')
      <span style="color:red">{{ $message }}</span>
    @enderror
  </div><br>

  <button type="submit">Update</button>
  <a href="{{ route('perusahaan.index') }}">Batal</a>
</form>
