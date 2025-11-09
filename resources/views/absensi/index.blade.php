<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Mahasiswa</title>
  <style>
    :root {
      --dark-blue: #334EAC;
      --mid-blue: #7096D1;
      --cream: #FFF9F0;
      --text-dark: #333;
      --text-light: #FFF;
    }

    body {
      font-family: "Poppins", Arial, sans-serif;
      background-color: var(--cream);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 25px;
    }

    h3, h4 {
      color: var(--dark-blue);
      border-left: 6px solid var(--mid-blue);
      padding-left: 12px;
      margin-bottom: 15px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 25px;
      margin-bottom: 30px;
    }

    .alert {
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      font-weight: 500;
    }
    .alert-ok {
      background-color: #e6f9e6;
      color: #2a7f2a;
      border-left: 5px solid #36b336;
    }
    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
      border-left: 5px solid #ffc107;
    }

    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
    .form-control {
      width: 100%; padding: 10px; border: 1px solid #ccc;
      border-radius: 6px; font-size: 1rem;
    }
    .form-control:focus {
      outline: none; border-color: var(--mid-blue);
      box-shadow: 0 0 5px var(--mid-blue);
    }

    .form-row { display: flex; gap: 15px; flex-wrap: wrap; }
    .form-row .form-group { flex: 1; }

    .btn {
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-primary {
      background-color: var(--dark-blue);
      color: var(--text-light);
    }

    .btn-primary:hover { background-color: #263c8c; }

    .btn-cancel {
      background-color: #ccc;
      color: #333;
    }

    .btn-cancel:hover { background-color: #b3b3b3; }

    .button-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 25px;
    }

    .table-history {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
      margin-top: 15px;
    }

    .table-history thead {
      background-color: var(--mid-blue);
      color: var(--text-light);
    }

    .table-history th, .table-history td {
      padding: 12px 14px;
      text-align: left;
      border-bottom: 1px solid #eee;
      font-size: 0.95rem;
    }

    .table-history tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .table-history tbody tr:hover {
      background-color: #eef3fb;
    }

    .status {
      padding: 5px 9px;
      border-radius: 5px;
      color: #fff;
      font-weight: 500;
      font-size: 0.85rem;
    }
    .status-hadir { background-color: #28a745; }
    .status-izin { background-color: #ffc107; color: #333; }
    .status-sakit { background-color: #dc3545; }

    #riwayatSection { display: none; }

    .back-btn {
      background-color: var(--mid-blue);
      color: var(--text-light);
      margin-top: 20px;
      font-weight: 600;
      border-radius: 8px;
      padding: 10px 18px;
      transition: 0.3s;
    }
    .back-btn:hover {
      background-color: #5079c3;
    }
  </style>
</head>
<body>

@include('layouts.header')

<div class="container">
  <h3>Absensi & Jurnal Harian</h3>
  <p><a href="{{ route('absensi.rekap') }}" class="btn back-btn" style="background-color:#7096D1;">Lihat Rekap Penempatan</a></p>

  @if (session('ok'))
    <div class="alert alert-ok">{{ session('ok') }}</div>
  @endif
  @if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-warning">
      <strong>Oops! Ada kesalahan:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (!$active)
    <div class="alert alert-warning">Belum ada penempatan aktif. Hubungi admin.</div>
  @else
    <!-- FORM -->
    <div id="formSection" class="card">
      <h4>Input Absensi</h4>
      <form method="POST" action="{{ route('absensi.store') }}" id="absensiForm">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
              <option value="hadir" @if(old('status')=='hadir') selected @endif>Hadir</option>
              <option value="izin" @if(old('status')=='izin') selected @endif>Izin</option>
              <option value="sakit" @if(old('status')=='sakit') selected @endif>Sakit</option>
            </select>
          </div>
        </div>

        <div class="form-row" id="jamKerja">
          <div class="form-group">
            <label for="jam_masuk">Jam Masuk</label>
            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk">
          </div>
          <div class="form-group">
            <label for="jam_pulang">Jam Pulang</label>
            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang">
          </div>
        </div>

        <div class="form-group">
          <label for="catatan">Catatan / Jurnal Harian</label>
          <textarea class="form-control" id="catatan" name="catatan" rows="4"></textarea>
        </div>

        <div class="button-group">
          <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('dashboard') }}'">Batal</button>
          <button type="submit" class="btn btn-primary" id="simpanBtn">Simpan Absensi</button>
        </div>
      </form>
    </div>

    <!-- RIWAYAT -->
    <div id="riwayatSection" class="card">
      <h4>Riwayat (30 hari terakhir)</h4>
      @if($absensi->count())
        <table class="table-history">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Masuk</th>
              <th>Pulang</th>
              <th>Catatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($absensi as $a)
            <tr>
              <td>{{ \Carbon\Carbon::parse($a->tanggal)->isoFormat('dddd, D MMM Y') }}</td>
              <td><span class="status status-{{$a->status}}">{{ $a->status }}</span></td>
              <td>{{ $a->jam_masuk ? \Carbon\Carbon::parse($a->jam_masuk)->format('H:i') : '-' }}</td>
              <td>{{ $a->jam_pulang ? \Carbon\Carbon::parse($a->jam_pulang)->format('H:i') : '-' }}</td>
              <td>{{ Str::limit($a->catatan, 50) ?? '-' }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p>Belum ada data absensi.</p>
      @endif

      <button class="btn back-btn" id="backDashboard">⬅ Kembali ke Dashboard</button>
    </div>
  @endif
</div>

@include('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
  const statusSelect = document.getElementById('status');
  const jamKerjaDiv = document.getElementById('jamKerja');
  const jamMasuk = document.getElementById('jam_masuk');
  const jamPulang = document.getElementById('jam_pulang');

  function toggleJamKerja() {
    if (statusSelect.value === 'hadir') {
      jamKerjaDiv.style.display = 'flex';
      jamMasuk.required = true;
      jamPulang.required = true;
    } else {
      jamKerjaDiv.style.display = 'none';
      jamMasuk.required = false;
      jamPulang.required = false;
    }
  }
  toggleJamKerja();
  statusSelect.addEventListener('change', toggleJamKerja);

  const absensiForm = document.getElementById('absensiForm');
  if (absensiForm) {
    absensiForm.addEventListener('submit', function(event) {
      const isConfirmed = confirm('Apakah Anda yakin ingin menyimpan data ini?\n\nPERHATIAN: Data yang sudah disimpan tidak dapat diubah kembali.');
      if (!isConfirmed) event.preventDefault();
    });
  }

  const backDashboard = document.getElementById('backDashboard');
  const riwayatSection = document.getElementById('riwayatSection');

  if (backDashboard) {
    backDashboard.addEventListener('click', () => {
      window.location.href = "{{ route('dashboard') }}";
    });
  }

  @if (session('ok'))
    document.getElementById('formSection').style.display = 'none';
    riwayatSection.style.display = 'block';
  @else
    document.getElementById('formSection').style.display = 'block';
    riwayatSection.style.display = 'none';
  @endif
});
</script>

</body>
</html>
