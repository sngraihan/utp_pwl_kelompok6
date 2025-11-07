<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">

  <div class="bg-white border-2 border-[#7096D1] shadow-lg rounded-2xl p-8 w-11/12 max-w-lg">
    <h2 class="text-3xl font-bold text-center text-[#334EAC] mb-6">Register</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        @foreach ($errors->all() as $e)
          <div>{{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/register" class="space-y-4">
      @csrf
      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Daftar Sebagai</label>
        <select name="role" id="role" required onchange="toggleSections()"
                class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
          <option value="mahasiswa" {{ old('role')==='mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
          <option value="perusahaan" {{ old('role')==='perusahaan' ? 'selected' : '' }}>Perusahaan</option>
        </select>
      </div>

      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <hr class="my-4 border-[#7096D1]/40">

      <!-- Mahasiswa Section -->
      <div id="student-fields" class="space-y-3">
        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">NPM</label>
          <input type="text" name="npm" value="{{ old('npm') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Jurusan (opsional)</label>
          <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Angkatan (opsional)</label>
          <input type="number" name="angkatan" value="{{ old('angkatan') }}" min="2000" max="2100"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Kontak Pribadi (opsional)</label>
          <input type="text" name="kontak_pribadi" value="{{ old('kontak_pribadi') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>
      </div>

      <!-- Perusahaan Section -->
      <div id="company-fields" style="display:none" class="space-y-3">
        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Nama Perusahaan</label>
          <input type="text" name="company_name" value="{{ old('company_name') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Alamat (opsional)</label>
          <textarea name="alamat"
                    class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">{{ old('alamat') }}</textarea>
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">PIC (opsional)</label>
          <input type="text" name="pic" value="{{ old('pic') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>

        <div>
          <label class="block font-semibold text-[#334EAC] mb-1">Kontak (opsional)</label>
          <input type="text" name="kontak" value="{{ old('kontak') }}"
                 class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:ring-2 focus:ring-[#334EAC] transition">
        </div>
      </div>

      <button type="submit"
              class="w-full bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 rounded-lg hover:bg-[#7096D1] transition">
        Daftar
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-[#334EAC]">
      Sudah punya akun?
      <a href="/login" class="font-semibold hover:underline text-[#7096D1]">Login</a>
    </p>
  </div>

  <script>
  function toggleSections() {
    var role = document.getElementById('role').value;
    document.getElementById('student-fields').style.display = (role === 'mahasiswa') ? 'block' : 'none';
    document.getElementById('company-fields').style.display = (role === 'perusahaan') ? 'block' : 'none';
  }
  toggleSections();
  </script>
</body>
</html>
