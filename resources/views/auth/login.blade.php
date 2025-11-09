<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login | Sistem Absensi Magang Unila</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF9F0;
      background-image: radial-gradient(circle at 20% 30%, #7096D120 0%, transparent 60%),
                        radial-gradient(circle at 80% 70%, #334EAC15 0%, transparent 60%);
      min-height: 100vh;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen px-4">

  <!-- Header -->
  <header class="text-center mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-[#334EAC] mb-2 tracking-wide">
      Sistem Absensi Magang Mahasiswa <br> Ilmu Komputer
    </h1>
    <p class="text-[#7096D1] text-sm md:text-base">
      S1 Ilmu Komputer • S1 Sistem Informasi • D3 Manajemen Informatika
    </p>
  </header>

  <!-- Card Login -->
  <div class="bg-white border border-[#7096D1]/50 shadow-lg shadow-[#7096D120] rounded-2xl p-8 w-full max-w-md transition duration-300 hover:shadow-[#334EAC40] hover:scale-[1.02]">
    <h2 class="text-2xl font-semibold text-center text-[#334EAC] mb-6">Login</h2>

    @if ($errors->any())
      <div class="mb-4 bg-red-100 text-red-700 border border-red-300 rounded-lg p-3 text-sm">
        @foreach ($errors->all() as $e)
          <div>• {{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/login" class="space-y-5">
      @csrf
      <div>
        <label class="block font-medium text-[#334EAC] mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full px-4 py-2 border border-[#7096D1] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div>
        <label class="block font-medium text-[#334EAC] mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2 border border-[#7096D1] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div class="flex items-center justify-between text-sm text-[#334EAC]">
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="remember" class="accent-[#334EAC]">
          <span>Ingat saya</span>
        </label>
      </div>

      <button type="submit"
              class="w-full bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 rounded-lg hover:bg-[#7096D1] hover:-translate-y-[1px] transition-all duration-200 shadow-md">
        Masuk Sekarang
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-[#334EAC]">
      Belum punya akun?
      <a href="/register" class="font-semibold hover:underline text-[#7096D1]">Daftar di sini</a>
    </p>
  </div>

  <!-- Footer -->
  <footer class="mt-10 text-xs md:text-sm text-[#7096D1] text-center">
    © 2025 Fakultas Ilmu Komputer — Universitas Lampung
  </footer>

</body>
</html>
