<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
      :root {
        --primary-green: #6BB99F;
        --dark-green: #0F5A4A;
        --light-gray-border: #d4d4d4;
        --dark-text: #1e1e1e;
      }

      body {
        background-color: #e8f5f1; /* Hijau muda lembut sebagai latar */
        color: var(--dark-text);
      }

      .card {
        border: 1px solid var(--light-gray-border);
        border-radius: 1rem;
        background: #ffffffcc;
      }

      .form-title .colors-ijo {
        color: var(--primary-green);
        font-weight: 600;
      }

      .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.2rem rgba(107, 185, 159, 0.25);
      }

      .btn-primary {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
      }

      .btn-primary:hover {
        background-color: var(--dark-green);
        border-color: var(--dark-green);
      }

      .alert-danger {
        font-size: 0.9rem;
      }
    </style>
  </head>

  <body class="d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4 form-title">
        <span class="colors-ijo">Login</span>
      </h3>

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
