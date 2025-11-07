<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Penempatan - Admin</title>
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

    main {
      padding: 1.5rem 3rem 3rem;
      flex: 1;
      max-width: 1300px;
      width: 100%;
      margin: 1rem auto;
    }

    h3 {
      color: var(--blue-dark);
      margin-bottom: 1.2rem;
      font-size: 1.4rem;
      font-weight: 600;
    }

    /* Tombol umum */
    .btn, .btn-danger {
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

    .btn-link {
      color: var(--blue-dark);
      text-decoration: none;
      font-weight: 500;
    }

    .btn-danger {
      background: #dc3545;
    }

    .btn-danger:hover {
      background: #c82333;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
      border: 1px solid #c3e6cb;
      border-radius: 8px;
    }

    .table-container {
      background: white;
      padding: 1.8rem;
      border-radius: 16px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
      overflow-x: auto;
    }

    .table-styled {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      min-width: 600px; /* agar kolom tetap proporsional di layar kecil */
    }

    .table-styled th, .table-styled td {
      padding: 0.8rem 1rem;
      text-align: left;
      border-bottom: 1px solid #eee;
      font-size: 0.95rem;
      white-space: nowrap;
    }

    .table-styled thead {
      background: var(--blue-dark);
      color: white;
    }

    .table-styled thead th {
      font-weight: 600;
    }

    .table-styled tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .table-styled tbody tr:hover {
      background-color: var(--background);
    }

    .table-styled td form {
      margin: 0;
    }

    .table-styled .action-links {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      flex-wrap: wrap;
    }

    .pagination {
      margin-top: 1.5rem;
    }

    .pagination a, .pagination span {
      padding: 0.5rem 0.75rem;
      text-decoration: none;
      color: var(--blue-dark);
      background: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin: 0 2px;
      font-size: 0.9rem;
    }

    .pagination span[aria-current="page"] {
      background: var(--blue-dark);
      color: white;
      border-color: var(--blue-dark);
    }

    /* Tombol kembali */
    .back-button-container {
      margin-top: 1.8rem;
      margin-bottom: 2.5rem;
    }

    .btn-back {
      background: var(--blue-dark);
      color: white;
      border: none;
      padding: 0.9rem 1.4rem;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      font-size: 1rem;
      transition: all 0.25s ease;
      display: block;
      width: 100%;
      text-align: center;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-back:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
    }

    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 992px) {
      main {
        padding: 1rem 1.5rem 2.5rem;
      }
      .table-container {
        padding: 1.2rem;
      }
      h3 {
        font-size: 1.2rem;
        text-align: center;
      }
      .btn {
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
      }
    }

    @media (max-width: 768px) {
      .table-styled th, .table-styled td {
        padding: 0.6rem 0.8rem;
        font-size: 0.85rem;
      }
      .btn-back {
        font-size: 0.9rem;
        padding: 0.8rem 1rem;
        width: 100%;
      }
      .action-links {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media (max-width: 576px) {
      main {
        padding: 1rem;
      }
      h3 {
        font-size: 1.1rem;
      }
      .table-container {
        padding: 1rem;
      }
      .btn, .btn-danger {
        width: 100%;
        text-align: center;
        margin-bottom: 0.5rem;
      }
      .btn-back {
        font-size: 0.95rem;
        padding: 0.9rem;
      }
    }

  </style>
</head>
<body>

  @include('layouts.header')

  <main>
    <h3>Data Penempatan</h3>
    
    @if(session('ok'))
      <div class="alert-success">{{ session('ok') }}</div>
    @endif

    <div class="table-container">
      <a href="{{ route('penempatan.create') }}" class="btn">+ Tambah Penempatan</a>

      <table class="table-styled">
        <thead>
          <tr>
            <th>Mahasiswa</th>
            <th>Perusahaan</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penempatans as $p)
            <tr>
              <td>{{ $p->mahasiswa->nama ?? '-' }}</td>
              <td>{{ $p->perusahaan->nama ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($p->mulai)->isoFormat('D MMM YYYY') }}</td>
              <td>{{ $p->selesai ? \Carbon\Carbon::parse($p->selesai)->isoFormat('D MMM YYYY') : '-' }}</td>
              <td>
                <div class="action-links">
                  <a href="{{ route('penempatan.edit', $p) }}" class="btn-link">Edit</a>
                  <form action="{{ route('penempatan.destroy', $p) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus penempatan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger" style="padding: 0.3rem 0.8rem; font-size: 0.8rem;">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 1.5rem;">Belum ada data penempatan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{ $penempatans->links('pagination::simple-bootstrap-4') }}
    </div>

    <!-- Tombol kembali di luar tabel dan tidak nempel footer -->
    <div class="back-button-container">
      <a href="{{ route('dashboard') }}" class="btn-back">Kembali ke Dashboard</a>
    </div>
  </main>

  @include('layouts.footer')
  
</body>
</html>
