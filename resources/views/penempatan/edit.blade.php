<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Penempatan - Admin</title>
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
      flex: 1;
      max-width: 800px;
      width: 100%;
      margin: 2rem auto 4rem auto; /* jarak aman dari footer */
      padding: 0 2rem;
    }

    h3 {
      color: var(--blue-dark);
      text-align: center;
      margin: 1.2rem 0 1.5rem 0;
      font-size: 1.5rem;
      font-weight: 600;
    }

    /* Alert Error */
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
      border: 1px solid #f5c6cb;
      border-radius: 8px;
    }

    .alert-danger ul {
      margin-left: 1rem;
      padding-left: 1rem;
    }

    /* Card */
    .card {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #555;
    }

    .form-control {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 0.95rem;
      font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--blue-light);
      box-shadow: 0 0 5px rgba(112, 150, 209, 0.5);
    }

    /* Tombol */
    .btn {
      background: var(--blue-dark);
      color: white;
      border: none;
      padding: 0.6rem 1.3rem;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.25s ease;
      cursor: pointer;
      display: inline-block;
    }

    .btn:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
    }

    /* Area tombol di luar card */
    .button-area {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1.8rem;
      margin-bottom: 3.5rem; /* jarak dari footer */
    }

  </style>
</head>
<body>

  @include('layouts.header')

  <main>
    <h3>Edit Penempatan</h3>

    @if ($errors->any())
      <div class="alert-danger">
        <strong>Oops! Ada kesalahan:</strong>
        <ul>
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <form method="POST" action="{{ route('penempatan.update', $penempatan) }}">
        @csrf 
        @method('PUT')

        <div class="form-group">
          <label for="mahasiswa" class="form-label">Mahasiswa</label>
          <select name="mahasiswa_id" id="mahasiswa" class="form-control" required>
            @foreach($mahasiswas as $m)
              <option value="{{ $m->id }}" {{ $penempatan->mahasiswa_id == $m->id ? 'selected' : '' }}>
                {{ $m->npm }} - {{ $m->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="perusahaan" class="form-label">Perusahaan</label>
          <select name="perusahaan_id" id="perusahaan" class="form-control" required>
            @foreach($perusahaans as $c)
              <option value="{{ $c->id }}" {{ $penempatan->perusahaan_id == $c->id ? 'selected' : '' }}>
                {{ $c->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="mulai" class="form-label">Tanggal Mulai</label>
          <input type="date" name="mulai" id="mulai" class="form-control" value="{{ old('mulai', $penempatan->mulai) }}" required>
        </div>

        <div class="form-group">
          <label for="selesai" class="form-label">Tanggal Selesai (opsional)</label>
          <input type="date" name="selesai" id="selesai" class="form-control" value="{{ old('selesai', $penempatan->selesai) }}">
        </div>

        <!-- Tombol submit di luar card -->
      </form>
    </div>

    <!-- 🔹 Tombol di luar card -->
    <div class="button-area">
      <a href="{{ route('penempatan.index') }}" class="btn">Batal</a>
      <button type="submit" form="updateForm" class="btn">Update Penempatan</button>
    </div>

  </main>

  @include('layouts.footer')

</body>
</html>
