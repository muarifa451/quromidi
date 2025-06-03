<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Sweetara</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f8bbd0, #f48fb1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: radial-gradient(circle, rgba(255, 255, 255, 0.6) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: sparkle 5s linear infinite;
      pointer-events: none;
      z-index: 0;
    }

    @keyframes sparkle {
      from {
        background-position: 0 0;
      }
      to {
        background-position: 100px 100px;
      }
    }

    .login-card {
      position: relative;
      z-index: 1;
      background: #fff;
      padding: 2rem;
      border-radius: 1.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-title {
      color: #e83e8c;
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }

    .btn-pink {
      background-color: #e83e8c;
      border: none;
    }

    .btn-pink:hover {
      background-color: #d63384;
    }

    .input-group .form-control {
      border-right: 0;
    }

    .input-group .btn-eye {
      background: transparent;
      border-left: 0;
      border: 1px solid #ced4da;
      border-radius: 0 0.375rem 0.375rem 0;
    }

    a.register-link {
      color: #e83e8c;
      text-decoration: none;
    }

    a.register-link:hover {
      text-decoration: underline;
    }

    /* Responsiveness */
    @media (max-width: 600px) {
      .login-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2 class="text-center login-title">Login</h2>
    <p class="text-center text-muted mb-4">Silakan masuk dengan username dan password</p>
    <form method="POST" action="{{ url('login') }}">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" name="password" id="password" required />
          <button type="button" class="btn btn-eye" onclick="togglePassword()">
            <i class="bi bi-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn btn-pink w-100">Login Sekarang</button>
    </form>

    @if (Session::has('pesan'))
    <div class="alert mt-3 {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
      {{ Session::get('pesan') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <p class="text-center mt-3" style="font-size: 0.9rem;">Terima kasih sudah mampir di halaman Sweetara kami</p>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
      } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
      }
    }
  </script>
</body>
</html>
