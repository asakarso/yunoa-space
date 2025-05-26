<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Login</h3>

      @if ($errors->any())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
          </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email_user" required autofocus>
          </div>

          <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="pass_user" required>
          </div>

          <div class="d-grid">
              <button type="submit" class="btn btn-primary">Login</button>
          </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
