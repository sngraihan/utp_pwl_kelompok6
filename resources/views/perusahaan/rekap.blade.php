<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa Magang</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue-dark: #334EAC;
      --blue-light: #7096D1;
      --white: #ffffff;
      --cream: #F9FAFB;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(160deg, #FFF9F0);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #333;
    }

    /* HEADER */
    header {
      background: linear-gradient(135deg, var(--blue-dark), var(--blue-light));
      color: white;
      padding: 0.8rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: nowrap;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .header-left img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: white;
      object-fit: cover;
      padding: 3px;
    }

    .header-text h2 {
      font-size: clamp(1rem, 2vw, 1.3rem);
      font-weight: 600;
    }

    .header-text p {
      font-size: clamp(0.75rem, 1.5vw, 0.9rem);
      opacity: 0.9;
    }

    .logout-btn {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.4);
      padding: 0.5rem 1.2rem;
      border-radius: 25px;
      cursor: pointer;
      font-size: clamp(0.75rem, 1.5vw, 0.9rem);
      transition: 0.3s;
    }

    .logout-btn:hover {
      background: white;
      color: var(--blue-dark);
    }

    /* MAIN */
    main {
      flex: 1;
      width: 90%;
      max-width: 950px;
      background: white;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    h2, h3 {
      color: var(--blue-dark);
      font-weight: 600;
    }

    h3 {
      border-left: 4px solid var(--blue-light);
      padding-left: 10px;
      margin-bottom: 1rem;
      font-size: clamp(1rem, 2vw, 1.2rem);
    }

    .info p {
      margin-bottom: 6px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: var(--blue-dark);
      color: white;
      padding: 10px;
      text-align: center;
    }

    td {
      background-color: #e8f0ff;
      padding: 10px;
      text-align: center;
    }

    tr:hover td {
      background-color: rgba(112, 150, 209, 0.1);
    }

    .no-data {
      text-align: center;
      padding: 1rem;
      color: var(--blue-dark);
      font-style: italic;
      background: #f9f9ff;
      border-radius: 10px;
    }

    .back-btn {
      display: inline-block;
      margin-top: 1.5rem;
      background: var(--blue-dark);
      color: white;
      padding: 8px 18px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .back-btn:hover {
      background: var(--blue-light);
    }

    /* FOOTER */
    footer {
      background: var(--blue-dark);
      color: white;
      text-align: center;
      padding: 0.8rem;
      font-size: clamp(0.7rem, 1.5vw, 0.9rem);
      margin-top: auto;
    }

    footer span {
      color: var(--blue-light);
      font-weight: 500;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      header {
        padding: 0.6rem 1rem;
      }

      .header-left img {
        width: 38px;
        height: 38px;
      }

      main {
        width: 95%;
        padding: 1.2rem;
      }
    }

    @media (max-width: 480px) {
      main {
        width: 96%;
        padding: 1rem;
      }

      .logout-btn {
        padding: 0.4rem 1rem;
      }
    }
  </style>
</head>
<body>

  @include('layouts.header')

  <main>
    <h2>Detail Mahasiswa Magang</h2>

    @php($m = $penempatan->mahasiswa)

    <div class="info">
      <p><strong>Nama:</strong> {{ $m->nama ?? '-' }}</p>
      <p><strong>NPM:</strong> {{ $m->npm ?? '-' }}</p>
      <p><strong>Program Studi:</strong> {{ $m->jurusan ?? '-' }}</p>
      <p><strong>Kontak Mahasiswa:</strong> {{ $m->kontak_pribadi ?? '-' }}</p>
      <p><strong>Periode:</strong> {{ $penempatan->mulai }} s/d {{ $penempatan->selesai ?? 'sekarang' }}</p>
    </div>

    <div class="status" style="margin: 15px 0;">
      @if(!$todayRow)
        <p><strong>Status Hari Ini:</strong> Belum absen</p>
      @elseif(!$todayRow->jam_pulang)
        <p><strong>Status Hari Ini:</strong> Sudah absen masuk ({{ $todayRow->jam_masuk }}) — belum pulang</p>
      @else
        <p><strong>Status Hari Ini:</strong> Lengkap ({{ $todayRow->jam_masuk }} - {{ $todayRow->jam_pulang }})</p>
      @endif
    </div>

    <h3>Riwayat Absensi</h3>
    @if($absensi->count())
      <table>
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
      <p class="no-data">Tidak ada data absensi.</p>
    @endif

    <a href="{{ route('dashboard') }}" class="back-btn">&larr; Kembali ke Dashboard</a>
  </main>

  @include('layouts.footer')

</body>
</html>
