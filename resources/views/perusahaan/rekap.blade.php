<!doctype html><meta charset="utf-8">
<h2>Detail Mahasiswa Magang</h2>
<p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>

@php($m = $penempatan->mahasiswa)

<div style="margin:10px 0;">
  <strong>Nama:</strong> {{ $m->nama ?? '-' }}<br>
  <strong>NPM:</strong> {{ $m->npm ?? '-' }}<br>
  <strong>Program Studi:</strong> {{ $m->jurusan ?? '-' }}<br>
  <strong>Kontak Mahasiswa:</strong> {{ $m->kontak_pribadi ?? '-' }}<br>
  <strong>Periode:</strong> {{ $penempatan->mulai }} s/d {{ $penempatan->selesai ?? 'sekarang' }}
</div>

<div style="margin:10px 0;">
  @if(!$todayRow)
    <strong>Status Hari Ini:</strong> Belum absen
  @elseif(!$todayRow->jam_pulang)
    <strong>Status Hari Ini:</strong> Sudah absen masuk ({{ $todayRow->jam_masuk }}) — belum pulang
  @else
    <strong>Status Hari Ini:</strong> Lengkap ({{ $todayRow->jam_masuk }} - {{ $todayRow->jam_pulang }})
  @endif
</div>

<h3>Riwayat Absensi</h3>
@if($absensi->count())
  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Status</th>
        <th>Catatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($absensi as $a)
        <tr>
          <td>{{ $a->tanggal }}</td>
          <td>{{ $a->jam_masuk ?? '-' }}</td>
          <td>{{ $a->jam_pulang ?? '-' }}</td>
          <td>{{ ucfirst($a->status) }}</td>
          <td>{{ $a->catatan ?? '-' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>Tidak ada data absensi.</p>
@endif
