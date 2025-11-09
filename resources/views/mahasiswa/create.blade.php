<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Mahasiswa</title>
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

  <!-- ===== MAIN ===== -->
  <main class="flex-1 flex items-center justify-center py-10">
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-2xl">

      <h3 class="text-2xl font-bold text-[#334EAC] mb-6 text-center">Tambah Mahasiswa</h3>

      @if(session('ok'))
        <div class="mb-4 text-green-700 font-medium bg-green-100 border border-green-300 rounded-md p-3">
          {{ session('ok') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-700 rounded-md p-3">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('mahasiswa.store') }}" class="space-y-4">
        @csrf

        <div>
          <label for="npm" class="block font-semibold text-[#334EAC] mb-1">NPM</label>
          <input id="npm" name="npm" value="{{ old('npm') }}" placeholder="NPM" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('npm')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="email" class="block font-semibold text-[#334EAC] mb-1">Email Login (opsional)</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="contoh: npm@student.local"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          <small class="text-sm text-[#7096D1]">Jika dikosongkan, sistem akan membuat email otomatis berbasis NPM.</small>
          @error('email')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="nama" class="block font-semibold text-[#334EAC] mb-1">Nama</label>
          <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('nama')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="jurusan" class="block font-semibold text-[#334EAC] mb-1">Jurusan</label>
          <input id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Jurusan"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('jurusan')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="angkatan" class="block font-semibold text-[#334EAC] mb-1">Angkatan</label>
          <input type="number" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="Angkatan"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('angkatan')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="kontak_pribadi" class="block font-semibold text-[#334EAC] mb-1">Kontak pribadi</label>
          <textarea id="kontak_pribadi" name="kontak_pribadi" placeholder="Kontak pribadi"
                    class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">{{ old('kontak_pribadi') }}</textarea>
          @error('kontak_pribadi')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex justify-between pt-6">
          <a href="{{ route('mahasiswa.index') }}"
             class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
             Kembali
          </a>

          <button type="submit"
                  class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
            Simpan
          </button>
      </form>
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
