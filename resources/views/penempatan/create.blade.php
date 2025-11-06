<h3>Tambah Penempatan</h3>
@if ($errors->any())
  <div style="color:red">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
@endif

<form method="POST" action="{{ route('penempatan.store') }}">
  @csrf
  <label>Mahasiswa</label><br>
  <select name="mahasiswa_id" required>
    <option value="">-- pilih --</option>
    @foreach($mahasiswas as $m)
      <option value="{{ $m->id }}">{{ $m->npm }} - {{ $m->nama }}</option>
    @endforeach
  </select><br><br>

  <label>Perusahaan</label><br>
  <select name="perusahaan_id" required>
    <option value="">-- pilih --</option>
    @foreach($perusahaans as $c)
      <option value="{{ $c->id }}">{{ $c->nama }}</option>
    @endforeach
  </select><br><br>

  <label>Tanggal Mulai</label><br>
  <input type="date" name="mulai" required><br><br>

  <label>Tanggal Selesai (opsional)</label><br>
  <input type="date" name="selesai"><br><br>

  <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('penempatan.index') }}">Kembali</a></p>
