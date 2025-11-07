<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>419 - Page Expired</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #FFF9F0;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen text-center">

  <div class="p-8 bg-white rounded-2xl border-2 border-[#7096D1] shadow-lg max-w-md">
    <div class="mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-[#334EAC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 19a7 7 0 100-14 7 7 0 000 14z" />
      </svg>
    </div>

    <h1 class="text-3xl font-bold text-[#334EAC] mb-2">419 - Page Expired</h1>
    <p class="text-[#334EAC] mb-6">Sesi kamu telah berakhir atau token CSRF tidak valid.<br>Coba ulangi beberapa saat lagi.</p>

    <a href="/" 
       class="inline-block bg-[#334EAC] text-[#FFF9F0] font-semibold py-2 px-6 rounded-lg hover:bg-[#7096D1] transition">
      Kembali ke Beranda
    </a>
  </div>

  <footer class="mt-8 text-sm text-[#7096D1]">
    &copy; {{ date('Y') }} Sistem Informasi Magang. Semua hak dilindungi.
  </footer>

</body>
</html>
