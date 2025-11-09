<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Absensi Penempatan</title>
  <style>
    :root {
      --dark-blue: #334EAC;
      --mid-blue: #7096D1;
      --cream: #FFF9F0;
      --text-dark: #333;
      --text-light: #FFF;
    }

    body { font-family: "Poppins", Arial, sans-serif; background-color: var(--cream); color: var(--text-dark); margin:0; }
    .container { max-width: 1000px; margin: 0 auto; padding: 25px; }
    h3, h4 { color: var(--dark-blue); border-left: 6px solid var(--mid-blue); padding-left: 12px; margin-bottom: 15px; }
    .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); padding: 25px; margin-bottom: 24px; }
    .alert { padding: 12px; margin-bottom: 16px; border-radius: 6px; font-weight: 500; }
    .alert-warning { background: #fff3cd; color: #856404; border-left: 5px solid #ffc107; }
    .grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
    @media (min-width: 900px) { .grid { grid-template-columns: 1fr 1fr; } }
    .meta { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
    .meta div { background:#f7f9ff; border:1px solid #e2e8ff; padding:12px; border-radius:8px; }
    .table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 10px; }
    .table thead { background: var(--mid-blue); color: var(--text-light); }
    .table th, .table td { padding: 10px 12px; border-bottom: 1px solid #eee; text-align: left; font-size: 0.95rem; }
    .status { padding: 5px 9px; border-radius: 5px; color: #fff; font-weight: 500; font-size: 0.85rem; }
    .status-hadir { background-color: #28a745; }
    .status-izin { background-color: #ffc107; color: #333; }
    .status-sakit { background-color: #dc3545; }
    .btn { display:inline-block; padding: 10px 16px; background: var(--mid-blue); color:#fff; border-radius:8px; text-decoration:none; font-weight:600; }
    .muted { color:#666; font-size: 0.9rem; }
  </style>
  </head>
<body>
@include('layouts.header')

<div class="container">
  <h3>Rekap Absensi Penempatan</h3>

  @if (!$active)
    <div class="alert alert-warning">Belum ada penempatan untuk akun ini. Hubungi admin.</div>
  @else
    <div class="card">
      <h4>Ringkasan</h4>
      <div class="meta">
        <div>
          <strong>Perusahaan</strong><br>
          {{ optional($active->perusahaan)->nama ?? '-' }}
        </div>
        <div>
          <strong>Periode</strong><br>
          {{ \Carbon\Carbon::parse($rangeStart)->isoFormat('D MMM Y') }} — {{ \Carbon\Carbon::parse($rangeEnd)->isoFormat('D MMM Y') }}
        </div>
        <div>
          <strong>Total Hari</strong><br>
          {{ \Carbon\Carbon::parse($rangeStart)->diffInDays(\Carbon\Carbon::parse($rangeEnd)) + 1 }} hari
        </div>
        <div>
          <strong>Sudah Absen</strong><br>
          {{ $records->count() }} hari
        </div>
        <div>
          <strong>Belum Absen</strong><br>
          {{ count($missing) }} hari
        </div>
      </div>
      <p class="muted" style="margin-top:10px">Catatan: Rekap mencakup setiap tanggal dalam periode penempatan (termasuk akhir pekan).</p>
      <div style="margin-top:12px">
        <a class="btn" href="{{ route('absensi.index') }}">Kembali ke Halaman Absensi</a>
      </div>
    </div>

    <div class="grid">
      <div class="card">
        <h4>Sudah Absen</h4>
        @if($records->count())
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($records as $a)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($a->tanggal)->isoFormat('dddd, D MMM Y') }}</td>
                  <td><span class="status status-{{$a->status}}">{{ $a->status }}</span></td>
                  <td>{{ $a->jam_masuk ? \Carbon\Carbon::parse($a->jam_masuk)->format('H:i') : '-' }}</td>
                  <td>{{ $a->jam_pulang ? \Carbon\Carbon::parse($a->jam_pulang)->format('H:i') : '-' }}</td>
                  <td>{{ Str::limit($a->catatan, 50) ?? '-' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="muted">Belum ada data absensi pada periode ini.</p>
        @endif
      </div>

      <div class="card">
        <h4>Belum Absen</h4>
        @if(count($missing))
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Hari</th>
              </tr>
            </thead>
            <tbody>
              @foreach($missing as $d)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($d)->isoFormat('D MMM Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($d)->isoFormat('dddd') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="muted">Semua tanggal pada periode ini sudah diabsen.</p>
        @endif
      </div>
    </div>
  @endif
</div>

@include('layouts.footer')
</body>
</html>

