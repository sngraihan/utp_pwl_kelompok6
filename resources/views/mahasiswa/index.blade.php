<h3>Mahasiswa</h3>
<p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>
@if(session('ok'))
  <div style="color: green;">{{ session('ok') }}</div>
@endif

<p><a href="{{ route('mahasiswa.create') }}">Tambah</a></p>

@if($data->count())
  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>NPM</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Angkatan</th>
        <th>Email Login</th>
        <th>Password Default</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $i => $m)
        <tr>
          <td>{{ $data->firstItem() + $i }}</td>
          <td>{{ $m->npm }}</td>
          <td>{{ $m->nama }}</td>
          <td>{{ $m->jurusan ?? '-' }}</td>
          <td>{{ $m->angkatan ?? '-' }}</td>
          <td>{{ $m->user->email ?? '-' }}</td>
          <td>12345678</td>
          <td>
            <a href="{{ route('mahasiswa.edit', $m) }}">Edit</a>
            <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
              @csrf
              @method('DELETE')
              <button type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:10px;">{{ $data->links() }}</div>
@else
  <p>Tidak ada data.</p>
@endif
