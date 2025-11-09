<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Absensi Penempatan</title>
  <style>
    :root {
      --dark-blue: #334EAC;
      --mid-blue: #3479e0ff;
      --cream: #FFF9F0;
      --text-dark: #333;
      --text-light: #FFF;
      --gray-light: #f7f9ff;
      --border-light: #e2e8ff;
    }

    /* Layout dasar */
    body {
      font-family: "Poppins", Arial, sans-serif;
      background-color: var(--cream);
      color: var(--text-dark);
      margin: 0;
      line-height: 1.6;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 40px 20px 80px;
    }

    /* Judul */
    h3, h4 {
      color: var(--dark-blue);
      margin-bottom: 16px;
    }

    h3 {
      font-size: 1.8rem;
      font-weight: 600;
      border-left: 6px solid var(--mid-blue);
      padding-left: 14px;
    }

    h4 {
      font-size: 1.2rem;
      font-weight: 600;
      border-left: 4px solid var(--mid-blue);
      padding-left: 12px;
    }

    /* Kartu konten */
    .card {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 25px 30px;
      margin-bottom: 28px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    /* Alert */
    .alert {
      padding: 14px 18px;
      margin-bottom: 24px;
      border-radius: 8px;
      font-weight: 500;
    }

    .alert-warning {
      background: #fff3cd;
      color: #856404;
      border-left: 6px solid #ffc107;
    }

    /* Grid layout */
    .grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 28px;
    }

    @media (min-width: 900px) {
      .grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    /* Informasi ringkasan */
    .meta {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      margin-bottom: 10px;
    }

    .meta div {
      background: var(--gray-light);
      border: 1px solid var(--border-light);
      padding: 14px 16px;
      border-radius: 8px;
    }

    .meta strong {
      display: block;
      color: var(--dark-blue);
      margin-bottom: 6px;
    }

    /* Tombol */
    .btn {
      display: inline-block;
      padding: 10px 18px;
      background: var(--mid-blue);
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.3s ease;
      margin-top: 12px;
    }

    .btn:hover {
      background: var(--dark-blue);
    }

    /* Tabel */
    .table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 10px;
      margin-top: 10px;
    }

    .table thead {
      background: var(--mid-blue);
      color: var(--text-light);
    }

    .table th, .table td {
      padding: 12px 14px;
      border-bottom: 1px solid #eee;
      text-align: left;
      font-size: 0.95rem;
    }

    .table tr:last-child td {
      border-bottom: none;
    }

    /* Status label */
    .status {
      padding: 5px 9px;
      border-radius: 6px;
      color: #fff;
      font-weight: 500;
      font-size: 0.85rem;
      text-transform: capitalize;
    }

    .status-hadir { background-color: #28a745; }
    .status-izin { background-color: #ffc107; color: #333; }
    .status-sakit { background-color: #dc3545; }

    /* Teks tambahan */
    .muted {
      color: #666;
      font-size: 0.9rem;
      margin-top: 6px;
    }
  </style>
</head>
<body>
@include('layouts.header')

<div class="container">
  <h3>Rekap Absensi Penempatan</h3>

  @if (!$active)
    <div class="alert alert-warning">
      Belum ada penempatan untuk akun ini. Hubungi admin.
    </div>
  @else
    <div class="card">
      <h4>Ringkasan</h4>
      <div class="meta">
        <div>
          <strong>Perusahaan</strong>
          {{ optional($active->perusahaan)->nama ?? '-' }}
        </div>
        <div>
          <strong>Periode</strong>
          {{ \Carbon\Carbon::parse($periodStart)->isoFormat('D MMM Y') }} —
          @if($periodEnd)
            {{ \Carbon\Carbon::parse($periodEnd)->isoFormat('D MMM Y') }}
          @else
            <em>Berjalan</em>
          @endif
        </div>
        <div>
          <strong>Total Hari</strong>
          @php
            $totalHariEnd = $periodEnd ? \Carbon\Carbon::parse($periodEnd) : \Carbon\Carbon::parse($rangeEnd);
          @endphp
          {{ \Carbon\Carbon::parse($periodStart)->diffInDays($totalHariEnd) + 1 }} hari
        </div>
        <div>
          <strong>Sudah Absen</strong>
          {{ $records->count() }} hari
        </div>
        <div>
          <strong>Belum Absen</strong>
          {{ count($missing) }} hari
        </div>
      </div>

      <p class="muted">
        Catatan: Rekap mencakup setiap tanggal dalam periode penempatan (termasuk akhir pekan).
      </p>

      <a class="btn" href="{{ route('absensi.index') }}">Kembali ke Halaman Absensi</a>
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
