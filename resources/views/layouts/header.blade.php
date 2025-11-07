@php
  $role = Auth::user()->role ?? null;
@endphp

<style>
  :root {
    --blue-dark: #334EAC;
    --blue-light: #7096D1;
    --background: #FFF9F0;
  }

  header {
    background: var(--blue-dark);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    position: relative;
    z-index: 10;
  }

  header h2 {
    font-weight: 600;
    font-size: 1.2rem;
  }

  .nav-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 1.25rem;
  }

  .nav-center a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    transition: all 0.25s ease;
  }

  .nav-center a:hover {
    background: var(--blue-light);
    transform: translateY(-1px);
  }

  .logout-btn, .btn-logout {
    background: var(--blue-light);
    color: white;
    border: none;
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: 0.25s ease;
  }

  .logout-btn:hover, .btn-logout:hover {
    background: white;
    color: var(--blue-dark);
    transform: translateY(-1px);
  }

  .header-left {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .header-left img {
    width: 40px;
    height: 40px;
    object-fit: contain;
  }

  .header-text h2 {
    margin: 0;
    font-size: 1.1rem;
  }

  .header-text p {
    font-size: 0.85rem;
    color: #f5f5f5;
    margin: 0;
  }

  .logo {
    font-weight: 600;
    font-size: 1.1rem;
  }

  nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    margin-right: 1rem;
    transition: color 0.25s ease;
  }

  nav a:hover {
    color: var(--blue-light);
  }

  @media (max-width: 820px) {
    header {
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      padding: 1rem;
    }

    .nav-center {
      position: static;
      transform: none;
      flex-wrap: wrap;
      justify-content: center;
      padding-top: 0.5rem;
    }
  }
</style>

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
    <div class="logo">Sistem Magang</div>
    <nav>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('absensi.index') }}">Absensi</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button class="btn-logout">Logout</button>
      </form>
    </nav>
  </header>

@else
  <!-- HEADER DEFAULT -->
  <header>
    <h2>Dashboard</h2>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </header>
@endif
