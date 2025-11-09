<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Profil Perusahaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">

  {{-- HEADER --}}
  @include('layouts.header')

  <!-- Bagian Konten -->
  <main class="flex flex-col items-center justify-start flex-grow px-4 pt-12 pb-24">
    <h2 class="text-2xl font-bold text-[#334EAC] mb-8 text-center">Profil Perusahaan</h2>

    <div class="w-full max-w-3xl bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-8">

      @if(session('ok'))
        <div class="mb-4 text-green-700 font-medium bg-green-100 border border-green-300 rounded-md p-3">
          {{ session('ok') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-700 rounded-md p-3">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="flex flex-col md:flex-row gap-8 items-start">

        <!-- Logo -->
        <div class="flex-shrink-0">
          <div class="w-36 h-36 border border-[#7096D1] rounded-xl flex items-center justify-center overflow-hidden bg-[#f9f9f9]">
            @if($perusahaan->logo)
              <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo" class="object-cover w-full h-full">
            @else
              <span class="text-gray-400 text-sm">Belum ada logo</span>
            @endif
          </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('perusahaan.profil.update') }}" enctype="multipart/form-data" class="flex-1 space-y-5">
          @csrf

          <div>
            <label class="block font-semibold text-[#334EAC] mb-1">Nama Perusahaan</label>
            <input type="text" name="nama" value="{{ old('nama', $perusahaan->nama) }}" required
                   class="w-full border border-[#7096D1] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#334EAC] focus:outline-none transition">
          </div>

          <div>
            <label class="block font-semibold text-[#334EAC] mb-1">Logo (jpg/png/svg/gif, maks 2MB)</label>
            <input type="file" name="logo" accept="image/*"
                   class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-[#7096D1]/20 file:text-[#334EAC] hover:file:bg-[#7096D1]/40 transition">
          </div>

          <div class="flex items-center gap-4 pt-4">
            <button type="submit"
                    class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
              Simpan Perubahan
            </button>
            <a href="{{ route('dashboard') }}"
               class="bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition text-center">
              Kembali
            </a>
          </div>
        </form>
      </div>
    </div>
  </main>

  {{-- FOOTER --}}
  @include('layouts.footer')

</body>
</html>
