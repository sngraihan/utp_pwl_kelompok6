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
    <button type="submit">Daftar</button>
  </form>

  <p>Sudah punya akun? <a href="/login">Login</a></p>
</body>
</html>
