<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
  <h2>Dashboard</h2>
  <p>Halo, {{ auth()->user()->name }} (role: {{ auth()->user()->role }})</p>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
  </form>
</body>
</html>
