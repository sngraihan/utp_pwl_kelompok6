<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Penempatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative">

  <!-- Link kembali di luar card, kiri atas -->
  <div class="absolute top-6 left-6">
    <a href="{{ route('dashboard') }}" class="text-[#7096D1] hover:text-[#334EAC] font-semibold text-sm transition">
      &larr; Kembali ke Dashboard
    </a>
  </div>

  <!-- Card utama -->
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

      <div class="text-center pt-2">
        <button type="submit"
                class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
          Simpan
        </button>
      </div>
    </form>

    <p class="mt-6 text-center text-sm">
      <a href="{{ route('penempatan.index') }}" class="text-[#7096D1] hover:text-[#334EAC] font-semibold transition">
        &larr; Kembali
      </a>
    </p>
  </div>

</body>
</html>
