<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">

  <!-- ===== HEADER ===== -->
  <header class="bg-[#334EAC] text-white shadow-md">
    <div class="flex justify-between items-center px-6 py-3 relative">
      <h2 class="text-lg font-semibold tracking-wide">Dashboard Admin</h2>

      <!-- Navigasi tengah -->
      <nav class="absolute left-1/2 -translate-x-1/2 flex gap-6 text-sm font-medium">
        <a href="{{ route('dashboard') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Dashboard</a>
        <a href="{{ route('mahasiswa.index') }}" class="bg-[#7096D1] px-3 py-1.5 rounded-md transition">Mahasiswa</a>
        <a href="{{ route('perusahaan.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Perusahaan</a>
        <a href="{{ route('penempatan.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Penempatan</a>
      </nav>

      <!-- Tombol Logout -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
          class="bg-[#7096D1] text-white px-4 py-1.5 rounded-lg font-medium hover:bg-white hover:text-[#334EAC] transition">
          Logout
        </button>
      </form>
    </div>
  </header>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="flex-1 flex flex-col items-center justify-start py-10 w-full">
    <h3 class="text-2xl font-bold text-[#334EAC] mb-6 text-center">Edit Mahasiswa</h3>

    <!-- Card utama -->
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-xl">
      <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">NPM</label>
          <input name="npm" value="{{ $mahasiswa->npm }}" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Nama</label>
          <input name="nama" value="{{ $mahasiswa->nama }}" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Jurusan</label>
          <input name="jurusan" value="{{ $mahasiswa->jurusan }}"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Angkatan</label>
          <input type="number" name="angkatan" value="{{ $mahasiswa->angkatan }}"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Kontak Pribadi</label>
          <textarea name="kontak_pribadi"
                    class="w-full border border-[#7096D1] rounded-lg px-3 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">{{ $mahasiswa->kontak_pribadi }}</textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-between items-center pt-6">
          <a href="{{ route('mahasiswa.index') }}"
             class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
            Batal
          </a>

          <button type="submit"
                  class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
            Update
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm mt-8">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
