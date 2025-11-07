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

    /* ===== HEADER ===== */
    header {
      background: var(--blue-dark);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      position: relative;
      z-index: 10;
    }

    header h2 {
      font-weight: 600;
      font-size: 1.2rem;
      letter-spacing: 0.4px;
    }

    /* ===== CENTERED MENU ===== */
    .nav-center {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      align-items: center;
      gap: 1.25rem;
    }

    .nav-center a {
      background: transparent;
      border: none;
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.25s ease;
    }

    .nav-center a:hover {
      background: var(--blue-light);
      color: white;
      transform: translateY(-1px);
    }

    /* ===== LOGOUT BUTTON ===== */
    .logout-btn {
      background: var(--blue-light);
      color: white;
      border: none;
      padding: 0.4rem 0.9rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .logout-btn:hover {
      background: white;
      color: var(--blue-dark);
      transform: translateY(-1px);
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

    /* ===== MENU GRID (Horizontal Layout) ===== */
    .menu-grid {
      display: flex;
      justify-content: center;
      align-items: stretch;
      gap: 2rem;
      flex-wrap: nowrap; /* Pastikan tetap horizontal di layar besar */
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
        flex-wrap: wrap; /* Biar turun ke bawah kalau layar kecil */
      }
    }

    @media (max-width: 820px) {
      .nav-center {
        position: static;
        transform: none;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 0.5rem;
      }

      header {
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
      }

      .logout-btn {
        margin-top: 0.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <h2>Dashboard Admin</h2>

    <div class="nav-center">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
      <a href="{{ route('perusahaan.index') }}">Perusahaan</a>
      <a href="{{ route('penempatan.index') }}">Penempatan</a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </header>

  <!-- MAIN -->
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

  <footer>
    &copy; {{ date('Y') }} Sistem Penempatan Mahasiswa - Dashboard Admin
  </footer>

</body>
</html>
