<h3>Data Penempatan</h3>
<p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>
@if(session('ok')) <div style="color:green">{{ session('ok') }}</div> @endif
<p><a href="{{ route('penempatan.create') }}">Tambah Penempatan</a></p>

<table border="1" cellspacing="0" cellpadding="6">
  <tr>
    <th>Mahasiswa</th><th>Perusahaan</th><th>Mulai</th><th>Selesai</th><th>Aksi</th>
  </tr>
  @forelse($penempatans as $p)
    <tr>
      <td>{{ $p->mahasiswa->nama ?? '-' }}</td>
      <td>{{ $p->perusahaan->nama ?? '-' }}</td>
      <td>{{ $p->mulai }}</td>
      <td>{{ $p->selesai ?? '-' }}</td>
      <td>
        <a href="{{ route('penempatan.edit', $p) }}">Edit</a>
        <form action="{{ route('penempatan.destroy', $p) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button onclick="return confirm('Hapus penempatan?')">Hapus</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="5">Belum ada penempatan.</td></tr>
  @endforelse
</table>

{{ $penempatans->links() }}
