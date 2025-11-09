<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>
<body>

  <!-- ===== HEADER ===== -->
  <header class="bg-[#334EAC] text-white shadow-md">
    <div class="flex justify-between items-center px-6 py-3 relative">
      <h2 class="text-lg font-semibold tracking-wide">Dashboard Admin</h2>

      <nav class="absolute left-1/2 -translate-x-1/2 flex gap-6 text-sm font-medium">
        <a href="{{ route('dashboard') }}" class="hover:bg-[#7096D1] px-3 py-1.5 rounded-md transition">Dashboard</a>
        <a href="{{ route('mahasiswa.index') }}" class="bg-[#7096D1] px-3 py-1.5 rounded-md transition">Mahasiswa</a>
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

  <main class="max-w-3xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
    <h3 class="text-2xl font-semibold text-[#334EAC] border-l-4 border-[#7096D1] pl-3 mb-6">
      Detail Mahasiswa
    </h3>

    <table class="w-full text-gray-700">
      <tr class="border-b">
        <td class="py-3 font-semibold text-[#334EAC] w-1/3">NPM</td>
        <td class="py-3">: {{ $mahasiswa->npm }}</td>
      </tr>
      <tr class="border-b">
        <td class="py-3 font-semibold text-[#334EAC]">Nama</td>
        <td class="py-3">: {{ $mahasiswa->nama }}</td>
      </tr>
      <tr class="border-b">
        <td class="py-3 font-semibold text-[#334EAC]">Program Studi</td>
        <td class="py-3">: {{ $mahasiswa->jurusan ?? '-' }}</td>
      </tr>
      <tr class="border-b">
        <td class="py-3 font-semibold text-[#334EAC]">Angkatan</td>
        <td class="py-3">: {{ $mahasiswa->angkatan ?? '-' }}</td>
      </tr>
      <tr>
        <td class="py-3 font-semibold text-[#334EAC]">Kontak Pribadi</td>
        <td class="py-3">: {{ $mahasiswa->kontak_pribadi ?? '-' }}</td>
      </tr>
    </table>

    <div class="flex justify-between items-center mt-8">
      <a href="{{ route('dashboard') }}"
         class="bg-[#7096D1] text-white font-medium px-5 py-2 rounded-lg hover:bg-[#5b82c7] transition">
         ⬅ Kembali ke Dashboard
      </a>

      <a href="{{ route('mahasiswa.edit', $mahasiswa) }}"
         class="bg-[#334EAC] text-white font-medium px-5 py-2 rounded-lg hover:bg-[#263c8c] transition">
         Edit Data
      </a>
    </div>
  </main>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#334EAC] text-white text-center py-3 text-sm mt-10">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
