<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Perusahaan</title>
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

      <!-- Navigasi Tengah -->
      <nav class="absolute left-1/2 -translate-x-1/2 flex gap-6 text-sm font-medium">
        <a href="{{ route('dashboard') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Dashboard</a>
        <a href="{{ route('mahasiswa.index') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Mahasiswa</a>
        <a href="{{ route('perusahaan.index') }}" class="bg-[#7096D1] px-3 py-1.5 rounded-md transition">Perusahaan</a>
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

    <!-- Tombol kembali -->
    <div class="w-full flex justify-start pl-10 pb-4">
      <a href="{{ route('dashboard') }}"
         class="text-[#7096D1] hover:text-[#334EAC] font-semibold text-sm transition">
        &larr; Kembali ke Dashboard
      </a>
    </div>

    <!-- Card utama -->
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-xl">
      <h3 class="text-2xl font-bold text-[#334EAC] mb-6 text-center">Edit Perusahaan</h3>

      @if(session('ok'))
        <div class="mb-4 text-green-700 font-medium bg-green-100 border border-green-300 rounded-md p-3 text-center">
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

      <form method="POST" action="{{ route('perusahaan.update', $perusahaan) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
          <label for="nama" class="block font-semibold text-[#334EAC] mb-1">Nama Perusahaan</label>
          <input id="nama" name="nama" value="{{ old('nama', $perusahaan->nama) }}" required
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('nama')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="alamat" class="block font-semibold text-[#334EAC] mb-1">Alamat</label>
          <textarea id="alamat" name="alamat"
                    class="w-full border border-[#7096D1] rounded-lg px-3 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">{{ old('alamat', $perusahaan->alamat) }}</textarea>
          @error('alamat')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="pic" class="block font-semibold text-[#334EAC] mb-1">PIC</label>
          <input id="pic" name="pic" value="{{ old('pic', $perusahaan->pic) }}"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('pic')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="kontak" class="block font-semibold text-[#334EAC] mb-1">Kontak</label>
          <input id="kontak" name="kontak" value="{{ old('kontak', $perusahaan->kontak) }}"
                 class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          @error('kontak')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex items-center justify-center gap-4 pt-4">
          <button type="submit"
                  class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
            Update
          </button>
          <a href="{{ route('perusahaan.index') }}"
             class="text-[#7096D1] hover:text-[#334EAC] font-semibold transition">
            Batal
          </a>
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
