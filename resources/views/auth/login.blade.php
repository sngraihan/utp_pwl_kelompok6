<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>

  @if ($errors->any())
    <div style="color:red;">
      @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
    </div>
  @endif

  <form method="POST" action="/login">
    @csrf
    <div>
      <label>Email</label><br>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
      <label>Password</label><br>
      <input type="password" name="password" required>
    </div>
    <div>
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit">Login</button>
  </form>

  <p>Belum punya akun? <a href="/register">Register</a></p>
</body>
</html>
