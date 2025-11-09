<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penempatan</title>
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

      <nav class="absolute left-1/2 -translate-x-1/2 flex gap-6 text-sm font-medium">
        <a href="{{ route('mahasiswa.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Mahasiswa</a>
        <a href="{{ route('perusahaan.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Perusahaan</a>
        <a href="{{ route('penempatan.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Penempatan</a>
      </nav>

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
  <main class="flex-1 flex items-center justify-center py-10">
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-2xl">

      <h3 class="text-2xl font-bold text-[#334EAC] mb-6 text-center">Tambah Penempatan</h3>

      @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-700 rounded-md p-3">
          @foreach($errors->all() as $e)
            <div>{{ $e }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('penempatan.store') }}" class="space-y-5">
        @csrf

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Mahasiswa</label>
          <select name="mahasiswa_id" required
                  class="w-full border border-[#7096D1] rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
            <option value="">-- pilih --</option>
            @foreach($mahasiswas as $m)
              <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>
                {{ $m->npm }} - {{ $m->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Perusahaan</label>
          <select name="perusahaan_id" required
                  class="w-full border border-[#7096D1] rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
            <option value="">-- pilih --</option>
            @foreach($perusahaans as $c)
              <option value="{{ $c->id }}" {{ old('perusahaan_id') == $c->id ? 'selected' : '' }}>
                {{ $c->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Tanggal Mulai</label>
          <input type="date" name="mulai" value="{{ old('mulai') }}" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Tanggal Selesai (opsional)</label>
          <input type="date" name="selesai" value="{{ old('selesai') }}"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-between pt-6">
          <a href="{{ route('penempatan.index') }}"
             class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
             Kembali
          </a>

          <button type="submit"
                  class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
