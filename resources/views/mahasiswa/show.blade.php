<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Mahasiswa</title>
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
  <main class="flex-1 flex flex-col items-center py-12">
    <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-xl w-11/12 max-w-3xl p-10">

      <h3 class="text-3xl font-semibold text-[#334EAC] text-center mb-8 border-b-4 border-[#7096D1] pb-3">
        Detail Mahasiswa
      </h3>

      <div class="overflow-hidden rounded-lg border border-[#E5E7EB]">
        <table class="w-full text-gray-700">
          <tbody class="divide-y divide-gray-200">
            <tr>
              <td class="py-3 px-5 font-semibold text-[#334EAC] w-1/3">NPM</td>
              <td class="py-3 px-5">: {{ $mahasiswa->npm }}</td>
            </tr>
            <tr>
              <td class="py-3 px-5 font-semibold text-[#334EAC]">Nama</td>
              <td class="py-3 px-5">: {{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
              <td class="py-3 px-5 font-semibold text-[#334EAC]">Program Studi</td>
              <td class="py-3 px-5">: {{ $mahasiswa->jurusan ?? '-' }}</td>
            </tr>
            <tr>
              <td class="py-3 px-5 font-semibold text-[#334EAC]">Angkatan</td>
              <td class="py-3 px-5">: {{ $mahasiswa->angkatan ?? '-' }}</td>
            </tr>
            <tr>
              <td class="py-3 px-5 font-semibold text-[#334EAC]">Kontak Pribadi</td>
              <td class="py-3 px-5">: {{ $mahasiswa->kontak_pribadi ?? '-' }}</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

    <!-- Tombol di luar card -->
    <div class="flex justify-center gap-5 mt-10">
      <a href="{{ route('dashboard') }}"
         class="bg-[#334EAC] text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-[#263c8c] hover:shadow-lg transition">
        Kembali ke Dashboard
      </a>
      <a href="{{ route('mahasiswa.edit', $mahasiswa) }}"
         class="bg-[#334EAC] text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:bg-[#263c8c] hover:shadow-lg transition">
         Edit Data
      </a>
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm mt-12">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
