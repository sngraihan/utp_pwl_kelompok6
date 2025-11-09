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
      padding: 2rem;
      flex: 1;
      max-width: 1100px;
      width: 100%;
      margin: auto;
      padding-bottom: 5rem; /* ➤ tambahkan jarak bawah agar tidak ketimpa footer */
    }

    h3 {
      color: var(--blue-dark);
      text-align: center;
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
    }

    /* Kotak tabel */
    .table-container {
      background: #fff;
      border: 2px solid var(--blue-light);
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    /* Tombol tambah */
    .top-action {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 1rem;
    }

    .btn-add {
      background: var(--blue-dark);
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      padding: 0.6rem 1.2rem;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-add:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
    }

    /* Tabel */
    table {
      width: 100%;
      border-collapse: separate; /* ➤ ubah ke separate agar radius berfungsi */
      border-spacing: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    thead {
      background: var(--blue-dark);
      color: white;
    }

    th, td {
      border: 1px solid var(--blue-light);
      padding: 0.8rem 1rem;
      text-align: center;
      font-size: 0.95rem;
    }

    thead th:first-child {
      border-top-left-radius: 10px; /* ➤ buat sudut tabel tumpul */
    }
    thead th:last-child {
      border-top-right-radius: 10px;
    }
    tbody tr:last-child td:first-child {
      border-bottom-left-radius: 10px;
    }
    tbody tr:last-child td:last-child {
      border-bottom-right-radius: 10px;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #f1f1f1;
    }

    /* Tombol aksi */
    .action-links {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-edit {
      background: var(--blue-light);
      color: white;
      border: none;
      padding: 0.4rem 0.9rem;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-edit:hover {
      background: var(--blue-dark);
    }

    .btn-delete {
      background: #e53935;
      color: white;
      border: none;
      padding: 0.4rem 0.9rem;
      border-radius: 6px;
      font-weight: 500;
      transition: 0.2s;
    }

    .btn-delete:hover {
      background: #c62828;
    }

    /* Tombol kembali */
    .btn-back {
      display: block;
      background: var(--blue-dark);
      color: white;
      text-align: center;
      font-weight: 600;
      padding: 1rem;
      border-radius: 12px;
      text-decoration: none;
      margin-top: 2rem;
      transition: 0.3s;
    }

    .btn-back:hover {
      background: var(--blue-light);
    }

    /* Footer tetap di bawah */
    footer {
      background: var(--blue-dark);
      color: white;
      text-align: center;
      padding: 0.8rem;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  @include('layouts.header')

  <main>
    <h3>Data Penempatan</h3>

    @if(session('ok'))
      <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    <div class="table-container">
      <div class="top-action">
        <a href="{{ route('penempatan.create') }}" class="btn-add">+ Tambah</a>
      </div>

      <table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Mahasiswa</th>
            <th>Perusahaan</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penempatans as $i => $p)
            <tr>
              <td>{{ $penempatans->firstItem() + $i }}</td>
              <td>{{ $p->mahasiswa->nama ?? '-' }}</td>
              <td>{{ $p->perusahaan->nama ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($p->mulai)->isoFormat('D MMM YYYY') }}</td>
              <td>{{ $p->selesai ? \Carbon\Carbon::parse($p->selesai)->isoFormat('D MMM YYYY') : '-' }}</td>
              <td>
                <div class="action-links">
                  <a href="{{ route('penempatan.edit', $p) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('penempatan.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus penempatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:1rem;">Belum ada data penempatan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <a href="{{ route('dashboard') }}" class="btn-back">Kembali ke Dashboard</a>
  </main>

  @include('layouts.footer')

</body>
</html>
