<h3>Absensi</h3>

@if (session('ok'))
  <div style="color: green;">{{ session('ok') }}</div>
@endif
@if (session('warning'))
  <div style="color: darkorange;">{{ session('warning') }}</div>
@endif

@if (!$active)
  <p>Belum ada penempatan aktif. Hubungi admin.</p>
@else
  <form method="POST" action="{{ route('absensi.store') }}">
    @csrf
    <button type="submit">
      @php
        $today = now()->toDateString();
        $todayRow = $absensi->firstWhere('tanggal', $today);
      @endphp
      @if (!$todayRow)
        Absen Masuk
      @elseif (!$todayRow->jam_pulang)
        Absen Pulang
      @else
        Sudah Absen Hari Ini
      @endif
    </button>
  </form>

  <h4>Riwayat (30 hari terakhir)</h4>
  @if($absensi->count())
    <table border="1" cellpadding="6" cellspacing="0">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Masuk</th>
          <th>Pulang</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($absensi as $a)
          <tr>
            <td>{{ $a->tanggal }}</td>
            <td>{{ $a->jam_masuk ?? '-' }}</td>
            <td>{{ $a->jam_pulang ?? '-' }}</td>
            <td>{{ ucfirst($a->status) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Belum ada data absensi.</p>
  @endif
@endif
