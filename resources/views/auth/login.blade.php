<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">

  <div class="bg-white border-2 border-[#7096D1] shadow-lg rounded-2xl p-8 w-80 md:w-96">
    <h2 class="text-3xl font-bold text-center text-[#334EAC] mb-6">Login</h2>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        @foreach ($errors->all() as $e)
          <div>{{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/login" class="space-y-4">
      @csrf
      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div>
        <label class="block font-semibold text-[#334EAC] mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-3 py-2 border border-[#7096D1] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#334EAC] transition">
      </div>

      <div class="flex items-center justify-between text-sm text-[#334EAC]">
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="remember" class="accent-[#334EAC]">
          <span>Remember me</span>
        </label>
      </div>

      <button type="submit"
              class="w-full bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 rounded-lg hover:bg-[#7096D1] transition">
        Login
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-[#334EAC]">
      Belum punya akun?
      <a href="/register" class="font-semibold hover:underline text-[#7096D1]">Register</a>
    </p>
  </div>

</body>
</html>
