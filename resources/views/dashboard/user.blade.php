<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Dashboard Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #FFF9F0 0%, #F3F6FF 100%);
      font-family: 'Poppins', sans-serif;
      color: #333;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">

  {{-- HEADER --}}
  @include('layouts.header')

  <!-- KONTEN UTAMA -->
  <main class="flex-grow flex flex-col items-center justify-start px-6 py-12 mb-24">

    <!-- Judul Halaman -->
    <h2 class="text-3xl font-bold text-[#334EAC] mb-10 text-center tracking-wide drop-shadow-sm">
      Selamat Datang di Dashboard Mahasiswa
    </h2>

    <!-- Container Card -->
    <div class="w-full max-w-4xl bg-white border border-[#7096D1]/40 rounded-3xl shadow-lg p-8 md:p-10">

      <!-- Bagian Atas: Profil Mahasiswa -->
      <div class="flex flex-col md:flex-row items-center gap-8 mb-8">
        <!-- Avatar / Icon Mahasiswa -->
        <div class="flex-shrink-0 w-28 h-28 bg-[#EEF3FF] border-4 border-[#7096D1] rounded-full flex items-center justify-center shadow-inner">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-[#334EAC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4z" />
            <circle cx="12" cy="7" r="4" stroke-width="1.8" />
          </svg>
        </div>

        <!-- Info Mahasiswa -->
        <div class="flex-1 text-center md:text-left">
          <p class="text-lg text-gray-700">Halo,</p>
          <h3 class="text-2xl font-semibold text-[#334EAC] mb-2">{{ auth()->user()->name }}</h3>

          @if(isset($penempatan) && $penempatan)
            <p class="text-gray-700">Tempat Magang:
              <span class="font-medium text-[#334EAC]">{{ $penempatan->perusahaan->nama }}</span>
            </p>
          @else
            <p class="text-gray-600 italic">
              Belum ada penempatan aktif. <br>
              <span class="text-sm text-gray-500">Silakan hubungi admin untuk penempatan.</span>
            </p>
          @endif
        </div>
      </div>

      <!-- Garis Pemisah -->
      <div class="border-t border-[#7096D1]/40 my-6"></div>

      <!-- Card Info Tambahan -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-[#EEF3FF] rounded-2xl p-6 shadow-sm border-l-4 border-[#334EAC]">
          <h4 class="font-semibold text-[#334EAC] mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#334EAC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7l9-4 9 4M4 10h16v10H4V10z" />
            </svg>
            Status Magang
          </h4>
          @if(isset($penempatan) && $penempatan)
            <p class="text-gray-700 leading-relaxed">
              Kamu sedang magang di <strong>{{ $penempatan->perusahaan->nama }}</strong>.
            </p>
          @else
            <p class="text-gray-700">Belum ada status magang aktif.</p>
          @endif
        </div>

        <div class="bg-[#EEF3FF] rounded-2xl p-6 shadow-sm border-l-4 border-[#7096D1]">
          <h4 class="font-semibold text-[#334EAC] mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#334EAC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-8H3v8a2 2 0 002 2z" />
            </svg>
            Jadwal & Kehadiran
          </h4>
          <p class="text-gray-700">Akses menu absensi untuk melakukan kehadiran harian.</p>
          <div class="mt-4">
            <a href="/absensi"
              class="inline-block bg-[#334EAC] text-[#FFF9F0] font-semibold py-2.5 px-6 rounded-lg hover:bg-[#7096D1] transition shadow">
              Buka Halaman Absensi
            </a>
          </div>
        </div>
      </div>
    </div>

  </main>

  {{-- FOOTER --}}
  @include('layouts.footer')

</body>
</html>
