<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --blue-dark: #334EAC;
      --blue-light: #7096D1;
      --background: #FFF9F0;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: var(--background);
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== MAIN CONTENT ===== */
    main {
      padding: 2rem 3rem;
      flex: 1;
      max-width: 1300px;
      margin: auto;
    }

    h3 {
      color: var(--blue-dark);
      margin-bottom: 2rem;
      text-align: center;
      font-size: 1.4rem;
      font-weight: 600;
    }

    /* ===== MENU GRID ===== */
    .menu-grid {
      display: flex;
      justify-content: center;
      align-items: stretch;
      gap: 2rem;
      flex-wrap: nowrap;
    }

    .card {
      background: white;
      flex: 1;
      min-width: 320px;
      max-width: 400px;
      padding: 1.8rem;
      border-radius: 16px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
      text-align: center;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    }

    .card h4 {
      color: var(--blue-dark);
      margin-bottom: 0.5rem;
      font-size: 1.1rem;
      font-weight: 600;
    }

    .card p {
      color: #555;
      font-size: 0.95rem;
      margin-bottom: 1.2rem;
      line-height: 1.5;
    }

    .btn {
      background: var(--blue-dark);
      color: white;
      border: none;
      padding: 0.5rem 1.2rem;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: all 0.25s ease;
      cursor: pointer;
      display: inline-block;
    }

    .btn:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
    }

    /* ===== FOOTER ===== */
    footer {
      text-align: center;
      padding: 1rem;
      background: var(--blue-dark);
      color: white;
      margin-top: 2rem;
      font-size: 0.9rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 950px) {
      .menu-grid {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>

  {{-- HEADER --}}
  @include('layouts.header')

  {{-- MAIN CONTENT --}}
  <main>
    <h3>Selamat Datang di Dashboard Admin</h3>

    <div class="menu-grid">
      <div class="card">
        <h4>Data Mahasiswa</h4>
        <p>Kelola dan tambahkan data mahasiswa.</p>
        <a href="{{ route('mahasiswa.create') }}" class="btn">+ Tambah Mahasiswa</a>
      </div>

      <div class="card">
        <h4>Data Perusahaan</h4>
        <p>Kelola data perusahaan mitra kampus.</p>
        <a href="{{ route('perusahaan.create') }}" class="btn">+ Tambah Perusahaan</a>
      </div>

      <div class="card">
        <h4>Data Penempatan</h4>
        <p>Atur penempatan mahasiswa ke perusahaan.</p>
        <a href="{{ route('penempatan.create') }}" class="btn">+ Tambah Penempatan</a>
      </div>
    </div>
  </main>

  {{-- FOOTER --}}
  @include('layouts.footer')

</body>
</html>
