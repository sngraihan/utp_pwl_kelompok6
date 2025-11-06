<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Register</h2>

  @if ($errors->any())
    <div style="color:red;">
      @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
    </div>
  @endif

  <form method="POST" action="/register">
    @csrf
    <div>
      <label>Daftar Sebagai</label><br>
      <select name="role" id="role" required onchange="toggleSections()">
        <option value="mahasiswa" {{ old('role')==='mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="perusahaan" {{ old('role')==='perusahaan' ? 'selected' : '' }}>Perusahaan</option>
      </select>
    </div>
    <div>
      <label>Nama</label><br>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
      <label>Email</label><br>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
      <label>Password</label><br>
      <input type="password" name="password" required>
    </div>
    <div>
      <label>Konfirmasi Password</label><br>
      <input type="password" name="password_confirmation" required>
    </div>
    <hr>
    <div id="student-fields">
      <div>
        <label>NPM</label><br>
        <input type="text" name="npm" value="{{ old('npm') }}">
      </div>
      <div>
        <label>Jurusan (opsional)</label><br>
        <input type="text" name="jurusan" value="{{ old('jurusan') }}">
      </div>
      <div>
        <label>Angkatan (opsional)</label><br>
        <input type="number" name="angkatan" value="{{ old('angkatan') }}" min="2000" max="2100">
      </div>
      <div>
        <label>Kontak Pribadi (opsional)</label><br>
        <input type="text" name="kontak_pribadi" value="{{ old('kontak_pribadi') }}">
      </div>
    </div>
    <div id="company-fields" style="display:none">
      <div>
        <label>Nama Perusahaan</label><br>
        <input type="text" name="company_name" value="{{ old('company_name') }}">
      </div>
      <div>
        <label>Alamat (opsional)</label><br>
        <textarea name="alamat">{{ old('alamat') }}</textarea>
      </div>
      <div>
        <label>PIC (opsional)</label><br>
        <input type="text" name="pic" value="{{ old('pic') }}">
      </div>
      <div>
        <label>Kontak (opsional)</label><br>
        <input type="text" name="kontak" value="{{ old('kontak') }}">
      </div>
    </div>
    <button type="submit">Daftar</button>
  </form>

  <p>Sudah punya akun? <a href="/login">Login</a></p>
</body>
<script>
function toggleSections() {
  var role = document.getElementById('role').value;
  document.getElementById('student-fields').style.display = (role === 'mahasiswa') ? 'block' : 'none';
  document.getElementById('company-fields').style.display = (role === 'perusahaan') ? 'block' : 'none';
}
toggleSections();
</script>
</html>
