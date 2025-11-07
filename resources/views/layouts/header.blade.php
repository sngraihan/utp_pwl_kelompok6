@php
  $role = Auth::user()->role ?? null;
@endphp

<style>
  :root {
    --blue-dark: #334EAC;
    --blue-light: #7096D1;
    --background: #FFF9F0;
  }

  * {
    box-sizing: border-box;
  }

  header {
    background: var(--blue-dark);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: clamp(0.6rem, 1vw, 0.9rem) clamp(1rem, 2vw, 2rem);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    position: relative;
    z-index: 10;
    flex-wrap: nowrap;
    min-height: 60px;
  }

  header h2, .logo {
    font-weight: 600;
    font-size: clamp(1rem, 1.8vw, 1.25rem);
    white-space: nowrap;
  }

  /* Tengah untuk navigasi */
  .nav-center {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(0.6rem, 2vw, 1.25rem);
    flex-shrink: 1;
    overflow-x: auto; /* biar di hp tidak kepotong */
    scrollbar-width: none;
  }

  .nav-center::-webkit-scrollbar {
    display: none;
  }

  .nav-center a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    transition: all 0.25s ease;
    font-size: clamp(0.8rem, 1.6vw, 0.95rem);
    white-space: nowrap;
    flex-shrink: 0;
  }

  .nav-center a:hover {
    background: var(--blue-light);
    transform: translateY(-1px);
  }

  /* Tombol Logout */
  .logout-btn, .btn-logout {
    background: var(--blue-light);
    color: white;
    border: none;
    padding: 0.45rem 0.9rem;
    border-radius: 8px;
    font-size: clamp(0.8rem, 1.5vw, 0.9rem);
    font-weight: 500;
    cursor: pointer;
    transition: 0.25s ease;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .logout-btn:hover, .btn-logout:hover {
    background: white;
    color: var(--blue-dark);
    transform: translateY(-1px);
  }

  /* Header kiri khusus perusahaan */
  .header-left {
    display: flex;
    align-items: center;
    gap: clamp(8px, 1vw, 12px);
    flex-shrink: 0;
  }

  .header-left img {
    width: clamp(35px, 4vw, 42px);
    height: clamp(35px, 4vw, 42px);
    object-fit: contain;
  }

  .header-text h2 {
    margin: 0;
    font-size: clamp(0.95rem, 1.6vw, 1.1rem);
  }

  .header-text p {
    font-size: clamp(0.7rem, 1.3vw, 0.85rem);
    color: #f5f5f5;
    margin: 0;
  }

  /* Responsive tweak */
  @media (max-width: 768px) {
    header {
      gap: 0.4rem;
    }

    .nav-center {
      justify-content: flex-start;
      overflow-x: auto;
      padding: 0 0.3rem;
    }

    .logout-btn {
      padding: 0.4rem 0.7rem;
    }
  }

  @media (max-width: 480px) {
    header {
      padding: 0.6rem 1rem;
    }

    .nav-center a {
      font-size: 0.8rem;
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
      @php($comp = \App\Models\User::with('perusahaan')->find(Auth::id())?->perusahaan)
      <img src="{{ $comp && $comp->logo ? asset('storage/'.$comp->logo) : '/images/logo-perusahaan.png' }}" alt="Logo">
      <div class="header-text">
        <h2>Dashboard Perusahaan</h2>
        <p>{{ $comp->nama ?? 'Perusahaan' }}</p>
      </div>
    </div>

    <div style="display:flex; gap:10px; align-items:center;">
      <a href="{{ route('perusahaan.profil') }}" class="logout-btn" style="text-decoration:none;">Profil Perusahaan</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>
  </header>

@elseif($role === 'mahasiswa')
  <!-- HEADER MAHASISWA -->
  <header>
    <div class="logo">Sistem Magang</div>
    <nav class="nav-center">
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
