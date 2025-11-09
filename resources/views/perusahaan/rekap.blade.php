<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Detail Mahasiswa Magang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-start py-10">

  <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8 w-11/12 max-w-4xl">

    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-[#334EAC]">Detail Mahasiswa Magang</h2>
      <a href="{{ route('dashboard') }}"
        class="inline-block px-4 py-2 border border-[#7096D1] rounded-md bg-[#7096D1]/10 text-[#334EAC] font-medium hover:bg-[#7096D1] hover:text-white transition">
        &larr; Kembali ke Dashboard
      </a>
    </div>

    @php($m = $penempatan->mahasiswa)

    <div class="mb-6 space-y-2 text-gray-700">
      <p><strong class="text-[#334EAC]">Nama:</strong> {{ $m->nama ?? '-' }}</p>
      <p><strong class="text-[#334EAC]">NPM:</strong> {{ $m->npm ?? '-' }}</p>
      <p><strong class="text-[#334EAC]">Program Studi:</strong> {{ $m->jurusan ?? '-' }}</p>
      <p><strong class="text-[#334EAC]">Kontak Mahasiswa:</strong> {{ $m->kontak_pribadi ?? '-' }}</p>
      <p><strong class="text-[#334EAC]">Periode:</strong> {{ $penempatan->mulai }} s/d {{ $penempatan->selesai ?? 'sekarang' }}</p>
    </div>

    <div class="mb-8 text-gray-700">
      @if(!$todayRow)
        <p><strong class="text-[#334EAC]">Status Hari Ini:</strong> Belum absen</p>
      @elseif(!$todayRow->jam_pulang)
        <p><strong class="text-[#334EAC]">Status Hari Ini:</strong> Sudah absen masuk ({{ $todayRow->jam_masuk }}) — belum pulang</p>
      @else
        <p><strong class="text-[#334EAC]">Status Hari Ini:</strong> Lengkap ({{ $todayRow->jam_masuk }} - {{ $todayRow->jam_pulang }})</p>
      @endif
    </div>

    <h3 class="text-xl font-bold text-[#334EAC] mb-4">Riwayat Absensi</h3>

    @if($absensi->count())
      <div class="overflow-x-auto">
        <table class="min-w-full border border-[#7096D1] rounded-lg text-center">
          <thead class="bg-[#334EAC] text-[#FFF9F0]">
            <tr>
              <th class="py-2 px-3 border border-[#7096D1]">Tanggal</th>
              <th class="py-2 px-3 border border-[#7096D1]">Masuk</th>
              <th class="py-2 px-3 border border-[#7096D1]">Pulang</th>
              <th class="py-2 px-3 border border-[#7096D1]">Status</th>
              <th class="py-2 px-3 border border-[#7096D1]">Catatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($absensi as $a)
              <tr class="hover:bg-[#FFF9F0] even:bg-[#f3f6fc] transition">
                <td class="py-2 px-3 border border-[#7096D1]">{{ $a->tanggal }}</td>
                <td class="py-2 px-3 border border-[#7096D1]">{{ $a->jam_masuk ?? '-' }}</td>
                <td class="py-2 px-3 border border-[#7096D1]">{{ $a->jam_pulang ?? '-' }}</td>
                <td class="py-2 px-3 border border-[#7096D1]">{{ ucfirst($a->status) }}</td>
                <td class="py-2 px-3 border border-[#7096D1]">{{ $a->catatan ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="text-center text-[#334EAC] font-medium mt-4">Tidak ada data absensi.</p>
    @endif

  </div>

</body>
</html>
