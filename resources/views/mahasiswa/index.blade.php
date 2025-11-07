<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
    table th, table td {
      text-align: center;
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

    <!-- Tombol kembali -->
    <div class="w-full flex justify-start pl-10 pb-4">
      <a href="{{ route('dashboard') }}"
         class="text-[#7096D1] hover:text-[#334EAC] font-semibold text-sm transition">
        &larr; Kembali ke Dashboard
      </a>
    </div>

    <!-- Card utama -->
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-6xl">
      <h3 class="text-2xl font-bold text-[#334EAC] mb-6 text-center">Mahasiswa</h3>

      @if(session('ok'))
        <div class="mb-4 text-green-700 font-medium bg-green-100 border border-green-300 rounded-md p-3 text-center">
          {{ session('ok') }}
        </div>
      @endif

      <div class="flex justify-end mb-4">
        <a href="{{ route('mahasiswa.create') }}"
           class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-5 rounded-lg hover:bg-[#7096D1] transition">
          + Tambah
        </a>
      </div>

      @if($data->count())
        <div class="overflow-x-auto">
          <table class="min-w-full border border-[#7096D1] rounded-lg">
            <thead class="bg-[#334EAC] text-[#FFF9F0]">
              <tr>
                <th class="py-2 px-3 border border-[#7096D1]">#</th>
                <th class="py-2 px-3 border border-[#7096D1]">NPM</th>
                <th class="py-2 px-3 border border-[#7096D1]">Nama</th>
                <th class="py-2 px-3 border border-[#7096D1]">Jurusan</th>
                <th class="py-2 px-3 border border-[#7096D1]">Angkatan</th>
                <th class="py-2 px-3 border border-[#7096D1]">Email Login</th>
                <th class="py-2 px-3 border border-[#7096D1]">Password Default</th>
                <th class="py-2 px-3 border border-[#7096D1]">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $i => $m)
                <tr class="hover:bg-[#FFF9F0] even:bg-[#f3f6fc] transition">
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $data->firstItem() + $i }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $m->npm }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $m->nama }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $m->jurusan ?? '-' }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $m->angkatan ?? '-' }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">{{ $m->user->email ?? '-' }}</td>
                  <td class="py-2 px-3 border border-[#7096D1]">12345678</td>
                  <td class="py-2 px-3 border border-[#7096D1]">
                    <div class="flex items-center justify-center gap-2">
                      <a href="{{ route('mahasiswa.show', $m) }}"
                         class="bg-[#334EAC] text-white px-3 py-1 rounded-lg text-sm hover:bg-[#1d2f6f] transition">
                        Detail
                      </a>
                      <a href="{{ route('mahasiswa.edit', $m) }}"
                         class="bg-[#7096D1] text-white px-3 py-1 rounded-lg text-sm hover:bg-[#334EAC] transition">
                        Edit
                      </a>
                      <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-6 flex justify-center">
          {{ $data->links() }}
        </div>
      @else
        <p class="text-center text-[#334EAC] font-medium mt-4">Tidak ada data.</p>
      @endif
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm mt-8">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
