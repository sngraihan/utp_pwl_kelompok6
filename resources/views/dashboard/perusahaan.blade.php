<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Perusahaan</title>
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

    h3 {
      color: var(--blue-dark);
      border-left: 4px solid var(--blue-light);
      padding-left: 10px;
      margin-bottom: 1rem;
      font-weight: 600;
      font-size: clamp(1rem, 2vw, 1.2rem);
    }

    .table-container {
      width: 100%;
      overflow-x: auto;
      border-radius: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: clamp(0.8rem, 1.6vw, 0.95rem);
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: var(--blue-dark);
      color: white;
      padding: 10px 12px;
      text-align: left;
      white-space: nowrap;
    }

    td {
      background-color: #e8f0ff;
      padding: 10px 12px;
      white-space: nowrap;
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
    <h3>Mahasiswa Magang</h3>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>NPM</th>
            <th>Program Studi</th>
            <th>Periode</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penempatans as $p)
            <tr>
              <td>{{ $p->mahasiswa->nama ?? '-' }}</td>
              <td>{{ $p->mahasiswa->npm ?? '-' }}</td>
              <td>{{ $p->mahasiswa->jurusan ?? '-' }}</td>
              <td>{{ $p->mulai }} s/d {{ $p->selesai ?? 'sekarang' }}</td>
              <td><a href="{{ route('perusahaan.magang.detail', $p) }}">Detail</a></td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="no-data">Belum ada mahasiswa magang yang terdaftar.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  @include('layouts.footer')

</body>
</html>
