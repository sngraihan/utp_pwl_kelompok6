<h3>Edit Penempatan</h3>
<h3>Edit Penempatan</h3>
@if ($errors->any())
  <div style="color:red">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
@endif

<form method="POST" action="{{ route('penempatan.update', $penempatan) }}">
  @csrf @method('PUT')

  <label>Mahasiswa</label><br>
  <select name="mahasiswa_id" required>
    @foreach($mahasiswas as $m)
      <option value="{{ $m->id }}" {{ $penempatan->mahasiswa_id == $m->id ? 'selected' : '' }}>
        {{ $m->npm }} - {{ $m->nama }}
      </option>
    @endforeach
  </select><br><br>

  <label>Perusahaan</label><br>
  <select name="perusahaan_id" required>
    @foreach($perusahaans as $c)
      <option value="{{ $c->id }}" {{ $penempatan->perusahaan_id == $c->id ? 'selected' : '' }}>
        {{ $c->nama }}
      </option>
    @endforeach
  </select><br><br>

  <label>Tanggal Mulai</label><br>
  <input type="date" name="mulai" value="{{ $penempatan->mulai }}" required><br><br>

  <label>Tanggal Selesai (opsional)</label><br>
  <input type="date" name="selesai" value="{{ $penempatan->selesai }}"><br><br>

  <button type="submit">Update</button>
</form>

<p><a href="{{ route('penempatan.index') }}">Kembali</a></p>
