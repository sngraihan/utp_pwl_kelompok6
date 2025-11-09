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
      --cream: #FFF9F0;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, var(--cream), #E8F0FF);
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
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 10;
    }

    .logout-btn {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.4);
      padding: 0.5rem 1.2rem;
      border-radius: 25px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 500;
    }

    .logout-btn:hover {
      background: white;
      color: var(--blue-dark);
    }

    /* JUDUL */
    .page-title {
      text-align: center;
      color: var(--blue-dark);
      font-size: 1.9rem;
      font-weight: 600;
      margin-top: 3.5rem;
      margin-bottom: 1.5rem;
      text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* CARD UTAMA */
    main {
      flex: 1;
      width: 90%;
      max-width: 950px;
      background: white;
      margin: 0 auto 3rem;
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
      animation: fadeIn 0.6s ease;
      position: relative;
      z-index: 5;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h3 {
      color: var(--blue-dark);
      font-weight: 600;
      border-left: 4px solid var(--blue-light);
      padding-left: 10px;
      margin-top: 2rem;
      margin-bottom: 1rem;
      font-size: 1.2rem;
    }

    .info p {
      margin-bottom: 6px;
      line-height: 1.6;
      font-size: 0.95rem;
    }

    .info strong {
      color: var(--blue-dark);
    }

    .status {
      margin: 1.5rem 0 2rem;
      padding: 1rem 1.2rem;
      background: #f4f7ff;
      border-left: 4px solid var(--blue-light);
      border-radius: 10px;
      font-weight: 500;
      color: var(--blue-dark);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      border-radius: 10px;
      overflow: hidden;
      font-size: 0.95rem;
    }

    th {
      background-color: var(--blue-dark);
      color: white;
      padding: 12px;
      text-align: center;
    }

    td {
      background-color: #eef3ff;
      padding: 10px;
      text-align: center;
    }

    tr:nth-child(even) td {
      background-color: #f7f9ff;
    }

    tr:hover td {
      background-color: rgba(112, 150, 209, 0.2);
    }

    .no-data {
      text-align: center;
      padding: 1rem;
      color: var(--blue-dark);
      font-style: italic;
      background: #f9f9ff;
      border-radius: 10px;
    }

    /* TOMBOL KEMBALI */
    .back-btn-container {
      width: 90%;
      max-width: 950px;
      margin: 0 auto 5rem;
      text-align: center;
      position: relative;
      z-index: 5;
    }

    .back-btn {
      display: inline-block;
      background: var(--blue-dark);
      color: white;
      padding: 12px 24px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(51, 78, 172, 0.3);
    }

    .back-btn:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(112, 150, 209, 0.4);
    }

    /* FOOTER */
    footer {
      background: var(--blue-dark);
      color: white;
      text-align: center;
      padding: 1rem;
      font-size: 0.85rem;
      margin-top: auto;
      box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
      z-index: 10;
    }

    footer span {
      color: var(--blue-light);
      font-weight: 500;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      main, .back-btn-container {
        width: 94%;
        padding: 1.5rem;
      }
      table td, table th {
        padding: 8px;
      }
    }

    @media (max-width: 480px) {
      .page-title { font-size: 1.5rem; }
      main, .back-btn-container {
        width: 95%;
      }
    }
  </style>
</head>
<body>

  @include('layouts.header')

  <h2 class="page-title">Detail Mahasiswa Magang</h2>

  <main>
    @php($m = $penempatan->mahasiswa)

    <div class="info">
      <p><strong>Nama:</strong> {{ $m->nama ?? '-' }}</p>
      <p><strong>NPM:</strong> {{ $m->npm ?? '-' }}</p>
      <p><strong>Program Studi:</strong> {{ $m->jurusan ?? '-' }}</p>
      <p><strong>Kontak Mahasiswa:</strong> {{ $m->kontak_pribadi ?? '-' }}</p>
      <p><strong>Periode:</strong> {{ $penempatan->mulai }} s/d {{ $penempatan->selesai ?? 'sekarang' }}</p>
    </div>

    <div class="status">
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
  </main>

  <div class="back-btn-container">
    <a href="{{ route('dashboard') }}" class="back-btn">Kembali ke Dashboard</a>
  </div>

  @include('layouts.footer')

</body>
</html>
