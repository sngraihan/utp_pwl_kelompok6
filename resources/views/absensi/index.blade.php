<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa</title>
    <style>
        /* Palet Warna */
        :root {
            --dark-blue: #334EAC;
            --light-blue: #7096D1;
            --cream: #FFF9F0;
            --text-dark: #333;
            --text-light: #FFF;
            --border-color: #ddd;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h3, h4 {
            color: var(--dark-blue);
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 5px;
        }

        /* Card untuk Form */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
        }

        /* Notifikasi */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        .alert-ok {
            background-color: #e0f8e0;
            color: #2a7f2a;
            border: 1px solid #b8e9b8;
        }
        .alert-warning {
            background-color: #fff3e0;
            color: #d97706;
            border: 1px solid #ffe0b2;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box; /* Penting untuk padding */
            font-size: 1rem;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--light-blue);
            box-shadow: 0 0 5px var(--light-blue);
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }

        /* Tombol */
        .btn {
            background-color: var(--dark-blue);
            color: var(--text-light);
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #273c8a;
        }

        /* Tabel Riwayat */
        .table-history {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .table-history th, .table-history td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        .table-history thead {
            background-color: var(--dark-blue);
            color: var(--text-light);
        }
        .table-history tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table-history tbody tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            padding: 5px 8px;
            border-radius: 4px;
            color: #fff;
            font-weight: 500;
            font-size: 0.85rem;
            text-transform: capitalize;
        }
        .status-hadir { background-color: #28a745; }
        .status-izin { background-color: #ffc107; color: #333; }
        .status-sakit { background-color: #dc3545; }

    </style>
</head>
<body>

    <div class="container">
        <h3>Absensi & Jurnal Harian</h3>

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
            <div class="alert alert-warning">
                Belum ada penempatan aktif. Hubungi admin.
            </div>
        @else
            <div class="card">
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
                                <option value="hadir" @if(old ('status') == 'hadir') selected @endif>Hadir</option>
                                <option value="izin" @if(old ('status') == 'izin') selected @endif>Izin</option>
                                <option value="sakit" @if(old ('status') == 'sakit') selected @endif>Sakit</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" id="jamKerja">
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') }}">
                        </div>
                        <div class="form-group">
                            <label for="jam_pulang">Jam Pulang</label>
                            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" value="{{ old('jam_pulang') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan / Jurnal Harian</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="4">{{ old('catatan') }}</textarea>
                    </div>

                    <button type="submit" class="btn">Simpan Absensi</button>
                </form>
            </div>


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
                            <td>
                                <span class="status status-{{$a->status}}">
                                    {{ $a->status }}
                                </span>
                            </td>
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

        @endif
    </div>

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

            // Panggil saat halaman dimuat
            toggleJamKerja();

            // Panggil saat status diubah
            statusSelect.addEventListener('change', toggleJamKerja);

            const absensiForm = document.getElementById('absensiForm');
            if (absensiForm) {
                absensiForm.addEventListener('submit', function(event) {
                    // Tampilkan dialog konfirmasi
                    const isConfirmed = confirm(
                        'Apakah Anda yakin ingin menyimpan data ini?\n\nPERHATIAN: Data yang sudah disimpan tidak dapat diubah kembali.'
                    );
                    
                    // Jika pengguna menekan "Cancel" (false)
                    if (!isConfirmed) {
                        event.preventDefault(); // Batalkan pengiriman form
                    }
                    // Jika "OK", biarkan form terkirim
                });
            }
        });
    </script>

</body>
</html>