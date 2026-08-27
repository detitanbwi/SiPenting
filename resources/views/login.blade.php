<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('src/img/logo.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="logo-container">
                <img src="{{ asset('src/img/logo.png') }}" alt="Logo Sipenting" class="logo">
            </div>
            
            <h1 class="app-title">Sipenting</h1>
            <p class="subtitle">Sistem Informasi Pencegahan Stunting</p>

            <!-- Tombol Role -->
            <div class="role-selector">
                <button type="button" class="role-btn active" id="btn-bapeda" data-role="bapeda">
                    <i class="fas fa-building"></i>
                    <span>Bapeda</span>
                </button>
                <button type="button" class="role-btn" id="btn-puskesmas" data-role="puskesmas">
                    <i class="fas fa-hospital"></i>
                    <span>Puskesmas</span>
                </button>
            </div>

            <!-- Form Login -->
            <form id="form-login" method="POST" action="{{ route('login-web-bapeda') }}">
                @csrf
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const btnBapeda = document.getElementById('btn-bapeda');
  const btnPuskesmas = document.getElementById('btn-puskesmas');
  const form = document.getElementById('form-login');
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  btnBapeda.addEventListener('click', () => {
    form.action = "{{ route('login-web-bapeda') }}";
    btnBapeda.classList.add('active');
    btnPuskesmas.classList.remove('active');
  });

  btnPuskesmas.addEventListener('click', () => {
    form.action = "{{ route('login-web-puskesmas') }}";
    btnPuskesmas.classList.add('active');
    btnBapeda.classList.remove('active');
  });

  // Toggle password visibility
  togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Toggle eye icon
    if (type === 'text') {
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    } else {
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    }
  });
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }

  body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f5f5;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
  }

  .container {
      width: 100%;
      max-width: 420px;
      padding: 20px;
  }

  .login-wrapper {
      background: white;
      border-radius: 8px;
      padding: 40px 32px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  .logo-container {
      text-align: center;
      margin-bottom: 24px;
  }

  .logo {
      width: 64px;
      height: 64px;
      object-fit: contain;
  }

  .app-title {
      font-size: 24px;
      font-weight: 700;
      color: #1a1a1a;
      text-align: center;
      margin-bottom: 4px;
  }

  .subtitle {
      font-size: 14px;
      color: #666;
      text-align: center;
      margin-bottom: 32px;
  }

  /* Role Selector */
  .role-selector {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
      padding: 4px;
      background: #f8f9fa;
      border-radius: 8px;
  }

  .role-btn {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 16px;
      border: none;
      background: transparent;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      color: #666;
      cursor: pointer;
      transition: all 0.2s ease;
  }

  .role-btn i {
      font-size: 16px;
  }

  .role-btn.active {
      background: #03A9F4;
      color: white;
      box-shadow: 0 2px 4px rgba(3, 169, 244, 0.2);
  }

  .role-btn:not(.active):hover {
      background: #e9ecef;
      color: #333;
  }

  /* Form Styles */
  .form-group {
      margin-bottom: 20px;
  }

  .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #333;
      margin-bottom: 8px;
  }

  .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
  }

  .input-wrapper i {
      position: absolute;
      left: 14px;
      color: #999;
      font-size: 14px;
  }

  .input-wrapper input {
      width: 100%;
      padding: 12px 14px 12px 42px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      color: #333;
      transition: all 0.2s ease;
      font-family: 'Inter', sans-serif;
  }

  .input-wrapper input:focus {
      outline: none;
      border-color: #03A9F4;
      box-shadow: 0 0 0 3px rgba(3, 169, 244, 0.1);
  }

  .input-wrapper input::placeholder {
      color: #aaa;
  }

  /* Toggle Password Button */
  .toggle-password {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: #999;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 20px;
      transition: color 0.2s ease;
  }

  .toggle-password:hover {
      color: #666;
  }

  .toggle-password i {
      font-size: 14px;
  }

  /* Button */
  .btn-login {
      width: 100%;
      padding: 12px;
      background: #03A9F4;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-top: 8px;
  }

  .btn-login:hover {
      background: #0288D1;
  }

  .btn-login:active {
      transform: translateY(1px);
  }

  /* Responsive */
  @media (max-width: 480px) {
      .login-wrapper {
          padding: 32px 24px;
      }

      .app-title {
          font-size: 22px;
      }

      .subtitle {
          font-size: 13px;
      }

      .role-btn {
          font-size: 13px;
          padding: 10px 12px;
      }

      .role-btn span {
          display: none;
      }

      .role-btn i {
          font-size: 18px;
      }
  }
</style>

@if(session('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: `{{ session('error') }}`,
        });
    </script>
@endif
