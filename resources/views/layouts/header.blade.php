<!-- HEADER UTAMA (Kondisi Berdasarkan Role User) -->
@php
  $role = Auth::user()->role ?? null;
@endphp

@if($role === 'admin')
  <!-- HEADER ADMIN -->
  <header>
    <h2>Dashboard Admin</h2>

    <div class="nav-center">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
      <a href="{{ route('perusahaan.index') }}">Perusahaan</a>
      <a href="{{ route('penempatan.index') }}">Penempatan</a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </header>

@elseif($role === 'perusahaan')
  <!-- HEADER PERUSAHAAN -->
  <header>
    <div class="header-left">
      <img src="/images/logo-perusahaan.png" alt="Logo">
      <div class="header-text">
        <h2>Dashboard Perusahaan</h2>
        <p>{{ Auth::user()->perusahaan->nama ?? 'Perusahaan' }}</p>
      </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </header>

@elseif($role === 'mahasiswa')
  <!-- HEADER MAHASISWA -->
  <header>
    <div class="logo">🎓 Sistem Magang</div>
    <nav>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('absensi.index') }}">Absensi</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button class="btn-logout" style="padding:6px 14px;font-size:14px;">Logout</button>
      </form>
    </nav>
  </header>

@else
  <!-- DEFAULT HEADER (Jika tidak terdeteksi role) -->
  <header>
    <h2>Dashboard</h2>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </header>
@endif
