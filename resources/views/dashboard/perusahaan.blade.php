<!doctype html>
<meta charset="utf-8">
<h2>Dashboard Perusahaan</h2>

@if($perusahaan)
  <p>Perusahaan: <strong>{{ $perusahaan->nama }}</strong></p>

  <h3>Mahasiswa Magang</h3>

  @if($penempatans->isEmpty())
    <p>Belum ada mahasiswa.</p>
  @else
    <table border="1" cellspacing="0" cellpadding="6">
      <tr>
        <th>Nama</th>
        <th>NPM</th>
        <th>Program Studi</th>
      </tr>
      @foreach($penempatans as $p)
        <tr>
          <td>{{ $p->mahasiswa->nama ?? '-' }}</td>
          <td>{{ $p->mahasiswa->npm ?? '-' }}</td>
          <td>{{ $p->mahasiswa->prodi ?? 'S1 Ilmu Komputer' }}</td>
        </tr>
      @endforeach
    </table>
  @endif
@else
  <p>Belum terhubung ke data perusahaan.</p>
@endif

<form method="POST" action="/logout">
  @csrf
  <button>Logout</button>
</form>
