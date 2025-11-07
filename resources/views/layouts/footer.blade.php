@php
  $role = Auth::user()->role ?? null;
@endphp

@if($role === 'admin')
  <!-- FOOTER ADMIN -->
  <footer style="
    background: linear-gradient(135deg, #334EAC, #7096D1);
    color: white;
    text-align: center;
    padding: 18px 0;
    font-size: 14px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
  ">
    &copy; {{ date('Y') }} Sistem Penempatan Mahasiswa - Dashboard Admin
  </footer>

@elseif($role === 'perusahaan')
  <!-- FOOTER PERUSAHAAN -->
  <footer style="
    background: linear-gradient(135deg, #334EAC, #7096D1);
    color: white;
    text-align: center;
    padding: 18px 0;
    font-size: 14px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
  ">
    © {{ date('Y') }} Sistem Magang | Desain oleh <span>Tim Views</span>
  </footer>

@elseif($role === 'mahasiswa')
  <!-- FOOTER MAHASISWA -->
  <footer style="
    background: linear-gradient(135deg, #334EAC, #7096D1);
    color: white;
    text-align: center;
    padding: 18px 0;
    font-size: 14px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
  ">
    &copy; {{ date('Y') }} <strong>Sistem Magang Mahasiswa</strong>
  </footer>

@else
  <!-- DEFAULT FOOTER (Jika role tidak diketahui) -->
  <footer>
    &copy; {{ date('Y') }} Sistem Magang Mahasiswa
  </footer>
@endif
