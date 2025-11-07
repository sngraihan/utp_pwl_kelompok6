<h3>Detail Mahasiswa</h3>
<p><a href="{{ route('mahasiswa.index') }}">&larr; Kembali ke Daftar</a> | <a href="{{ route('dashboard') }}">Dashboard</a></p>

<table border="0" cellpadding="6" cellspacing="0">
  <tr>
    <td style="min-width:160px;">NPM</td>
    <td>: {{ $mahasiswa->npm }}</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>: {{ $mahasiswa->nama }}</td>
  </tr>
  <tr>
    <td>Program Studi</td>
    <td>: {{ $mahasiswa->jurusan ?? '-' }}</td>
  </tr>
  <tr>
    <td>Angkatan</td>
    <td>: {{ $mahasiswa->angkatan ?? '-' }}</td>
  </tr>
  <tr>
    <td>Kontak Pribadi </td>
    <td>: {{ $mahasiswa->kontak_pribadi ?? '-' }}</td>
  </tr>
</table>

<p style="margin-top:12px;">
  <a href="{{ route('mahasiswa.edit', $mahasiswa) }}">Edit</a>
</p>

