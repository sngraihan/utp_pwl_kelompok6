<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Dashboard Mahasiswa</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF9F0;
      margin: 0;
      padding: 0;
      color: #333;
    }

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
  </style>
</head>
<body>

  @include('layouts.header')

  <main>
    <h2>Selamat Datang </h2>

    <div class="card-info">
      <p>Halo, <strong>{{ auth()->user()->name }}</strong></p>

      @if(isset($penempatan) && $penempatan)
        <p>Tempat Magang: <strong>{{ $penempatan->perusahaan->nama }}</strong></p>
      @else
        <p>Belum ada penempatan aktif. Silakan hubungi admin untuk penempatan.</p>
      @endif
    </div>

    <p><a href="/absensi">Buka Halaman Absensi</a></p>
  </main>

  @include('layouts.footer')

</body>
</html>