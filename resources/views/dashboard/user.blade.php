<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Dashboard Mahasiswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF9F0;
      margin: 0;
      padding: 0;
      color: #333;
    }

    /* ===== HEADER ===== */
    header {
      position: sticky;
      top: 0;
      background: linear-gradient(135deg, #334EAC, #7096D1);
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 50px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      z-index: 1000;
    }

    .logo {
      font-size: 22px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 25px;
      font-weight: 500;
      transition: opacity 0.2s ease;
    }

    nav a:hover {
      opacity: 0.8;
    }

    /* ===== MAIN CONTENT ===== */
    main {
      max-width: 800px;
      margin: 60px auto;
      background: white;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    h2 {
      color: #334EAC;
      margin-top: 0;
      border-bottom: 3px solid #7096D1;
      padding-bottom: 8px;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      margin: 10px 0 18px 0;
    }

    a {
      color: #334EAC;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    a:hover {
      color: #7096D1;
      text-decoration: underline;
    }

    .card-info {
      background-color: #EEF3FF;
      border-left: 6px solid #334EAC;
      padding: 18px 22px;
      border-radius: 10px;
      margin-bottom: 25px;
    }

    .btn-logout {
      background-color: #334EAC;
      color: white;
      border: none;
      padding: 10px 22px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
      font-weight: 600;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .btn-logout:hover {
      background-color: #7096D1;
      transform: scale(1.03);
    }

    footer {
      text-align: center;
      margin-top: 60px;
      color: #777;
      font-size: 13px;
    }
  </style>
</head>
<body>

  @include('layouts.header')

  <!-- MAIN CONTENT -->
  <main>
    <h2>Selamat Datang 👋</h2>

    <div class="card-info">
      <p>Halo, <strong>{{ auth()->user()->name }}</strong></p>

      @if(isset($penempatan) && $penempatan)
        <p>Tempat Magang: <strong>{{ $penempatan->perusahaan->nama }}</strong></p>
      @else
        <p>Belum ada penempatan aktif. Silakan hubungi admin untuk penempatan.</p>
      @endif
    </div>

    <p><a href="{{ route('absensi.index') }}">📋 Buka Halaman Absensi</a></p>
  </main>

  @include('layouts.footer')

</body>
</html>
