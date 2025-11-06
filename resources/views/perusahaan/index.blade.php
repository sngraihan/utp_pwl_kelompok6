<h3>Perusahaan</h3>
<p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>
@if(session('ok'))
  <div style="color: green;">{{ session('ok') }}</div>
@endif

<p><a href="{{ route('perusahaan.create') }}">Tambah</a></p>

@if($data->count())
  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>PIC</th>
        <th>Kontak</th>
        <th>Email Login</th>
        <th>Password Default</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $i => $p)
        <tr>
          <td>{{ $data->firstItem() + $i }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->alamat ?? '-' }}</td>
          <td>{{ $p->pic ?? '-' }}</td>
          <td>{{ $p->kontak ?? '-' }}</td>
          <td>{{ $p->owner->email ?? '-' }}</td>
          <td>12345678</td>
          <td>
            <a href="{{ route('perusahaan.edit', $p) }}">Edit</a>
            <form action="{{ route('perusahaan.destroy', $p) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
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
