<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>404 - Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center text-center px-4">

  <div class="bg-white border-2 border-[#7096D1] rounded-2xl shadow-lg p-10 max-w-lg w-full">
    <h1 class="text-4xl font-bold text-[#334EAC] mb-4">404 - Halaman Tidak Ditemukan</h1>
    <p class="text-gray-700 mb-6">
      Halaman yang Anda cari tidak ditemukan atau sudah dipindahkan.
    </p>

    <a href="/"
       class="inline-block bg-[#334EAC] text-white font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
      &larr; Kembali ke Beranda
    </a>
  </div>

  <footer class="mt-10 text-sm text-[#334EAC]">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
