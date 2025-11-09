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
      margin: 40px auto 80px;
      padding: 0 25px;
    }

    .header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 25px;
    }

    .header-row h3 {
      color: var(--dark-blue);
      border-left: 6px solid var(--mid-blue);
      padding-left: 12px;
      margin: 0;
    }

    .rekap-btn {
      background-color: #376ed4ff;
      color: var(--text-light);
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .rekap-btn:hover {
      background-color: #4c638eff;
    }

    .card {
      background-color: #fff;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 35px;
    }

    h4 {
      color: var(--dark-blue);
      border-bottom: 2px solid var(--mid-blue);
      padding-bottom: 6px;
      margin-top: 0;
      margin-bottom: 20px;
    }

    /* ALERTS */
    .alert {
      padding: 12px 16px;
      margin-bottom: 25px;
      border-radius: 8px;
      font-weight: 500;
      line-height: 1.5;
    }

    .alert-ok {
      background-color: #e7f7e7;
      color: #276c27;
      border-left: 6px solid #36b336;
    }

    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
      border-left: 6px solid #ffc107;
    }

    /* FORM */
    .form-row {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .form-group {
      flex: 1;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      transition: 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--mid-blue);
      box-shadow: 0 0 4px rgba(112,150,209,0.4);
    }

    textarea.form-control {
      resize: vertical;
    }

    /* BUTTONS */
    .button-group {
      display: flex;
      justify-content: space-between; /* tombol kiri dan kanan */
      margin-top: 15px;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
      background-color: var(--dark-blue);
      color: var(--text-light);
    }

    .btn:hover {
      background-color: #263c8c;
    }

    /* TABLE */
    .table-history {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-history thead {
      background-color: var(--mid-blue);
      color: var(--text-light);
    }

    .table-history th, .table-history td {
      padding: 12px 14px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    .table-history tbody tr:nth-child(even) {
      background-color: #f8f9ff;
    }

    .table-history tbody tr:hover {
      background-color: #eef3fb;
    }

    .status {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: 600;
      color: #fff;
      text-transform: capitalize;
    }

    .status-hadir { background-color: #28a745; }
    .status-izin { background-color: #ffc107; color: #333; }
    .status-sakit { background-color: #dc3545; }

    .back-btn {
      display: inline-block;
      background-color: var(--mid-blue);
      color: var(--text-light);
      padding: 10px 20px;
      font-weight: 600;
      border-radius: 8px;
      text-decoration: none;
      margin-top: 25px;
      transition: background-color 0.3s ease;
    }

    .back-btn:hover {
      background-color: #5079c3;
    }

    #riwayatSection {
      display: none;
    }
  </style>
</head>
<body>

@include('layouts.header')

<div class="container">
  <div class="header-row">
    <h3>Absensi & Jurnal Harian</h3>
    <a href="{{ route('absensi.rekap') }}" class="rekap-btn">Lihat Rekap Penempatan</a>
  </div>

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
            <input type="date" class="form-control" id="tanggal" name="tanggal"
              value="{{ old('tanggal', now()->toDateString()) }}" required>
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
          <button type="button" class="btn" onclick="window.location.href='{{ route('dashboard') }}'">Batal</button>
          <button type="submit" class="btn">Simpan Absensi</button>
        </div>
      </form>
    </div>

    <!-- RIWAYAT -->
    <div id="riwayatSection" class="card">
      <h4>Riwayat (30 Hari Terakhir)</h4>
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

      <a href="{{ route('dashboard') }}" class="back-btn">Kembali ke Dashboard</a>
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

  const formSection = document.getElementById('formSection');
  const riwayatSection = document.getElementById('riwayatSection');

  @if (session('ok'))
    formSection.style.display = 'none';
    riwayatSection.style.display = 'block';
  @else
    formSection.style.display = 'block';
    riwayatSection.style.display = 'none';
  @endif
});
</script>

</body>
</html>
