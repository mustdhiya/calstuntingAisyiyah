<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk Admin — SiCegah Stunting</title>
  <meta name="description" content="Halaman masuk untuk panel admin SiCegah Stunting Aisyiyah Kalimantan Timur." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      -webkit-font-smoothing: antialiased;
      background: #f1f5f9;
    }
    .material-symbols-rounded {
      font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
      vertical-align: middle;
      line-height: 1;
    }

    /* Background pattern */
    .login-bg {
      min-height: 100vh;
      background:
        radial-gradient(ellipse at 20% 50%, rgba(16,185,129,0.08) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(5,150,105,0.06) 0%, transparent 50%),
        #f8fafc;
    }

    /* Card */
    .login-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 24px;
      box-shadow: 0 8px 40px rgba(0,0,0,0.07), 0 2px 12px rgba(0,0,0,0.04);
    }

    /* Input */
    .login-input {
      width: 100%;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px 14px 12px 42px;
      font-size: 14px;
      color: #1e293b;
      background: #f8fafc;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
      outline: none;
      font-family: 'Inter', sans-serif;
    }
    .login-input:focus {
      border-color: #059669;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(5,150,105,0.1);
    }
    .login-input.is-error {
      border-color: #ef4444;
      background: #fff;
    }

    /* Button */
    .login-btn {
      width: 100%;
      padding: 13px;
      border-radius: 12px;
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 14px rgba(5,150,105,0.25);
      font-family: 'Inter', sans-serif;
    }
    .login-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(5,150,105,0.35);
    }
    .login-btn:active {
      transform: translateY(0);
    }

    /* Input icon wrapper */
    .input-wrap { position: relative; }
    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 20px;
      pointer-events: none;
    }
    .input-icon-right {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 20px;
      cursor: pointer;
      transition: color 0.15s;
    }
    .input-icon-right:hover { color: #475569; }

    /* Error message */
    .field-error {
      font-size: 12px;
      color: #ef4444;
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* Success toast */
    .toast-success {
      background: #d1fae5;
      border: 1px solid #a7f3d0;
      color: #065f46;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="login-bg flex items-center justify-center p-4">

  <div class="w-full max-w-md">

    <!-- Logo & branding -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-600 text-white mb-4 shadow-lg">
        <span class="material-symbols-rounded text-3xl">health_and_safety</span>
      </div>
      <h1 class="text-[26px] font-extrabold text-slate-900 leading-tight">SiCegah Stunting</h1>
      <p class="text-slate-500 text-[13px] mt-1">Panel Admin — Aisyiyah Kalimantan Timur</p>
    </div>

    <!-- Card -->
    <div class="login-card p-8">

      <div class="mb-6">
        <h2 class="text-[18px] font-bold text-slate-800">Masuk ke Akun Anda</h2>
        <p class="text-slate-500 text-[13px] mt-1">Gunakan email dan kata sandi yang terdaftar.</p>
      </div>

      {{-- Flash success (setelah logout) --}}
      @if(session('success'))
        <div class="toast-success">
          <span class="material-symbols-rounded text-[18px]">check_circle</span>
          {{ session('success') }}
        </div>
      @endif

      {{-- Error dari validasi atau auth --}}
      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-[13px] flex items-start gap-2 mb-5">
          <span class="material-symbols-rounded text-[18px] mt-0.5 flex-shrink-0">error</span>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form action="{{ route('login.post') }}" method="POST" class="space-y-5" id="loginForm">
        @csrf

        {{-- Email --}}
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5" for="email">
            Email
          </label>
          <div class="input-wrap">
            <span class="input-icon material-symbols-rounded">mail</span>
            <input
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="admin@sicegah.id"
              autocomplete="email"
              class="login-input {{ $errors->has('email') ? 'is-error' : '' }}"
              required
            />
          </div>
        </div>

        {{-- Password --}}
        <div>
          <label class="block text-[13px] font-semibold text-slate-700 mb-1.5" for="password">
            Kata Sandi
          </label>
          <div class="input-wrap">
            <span class="input-icon material-symbols-rounded">lock</span>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="••••••••"
              autocomplete="current-password"
              class="login-input {{ $errors->has('password') ? 'is-error' : '' }}"
              required
            />
            <span class="input-icon-right material-symbols-rounded" id="togglePwd" onclick="togglePassword()">visibility_off</span>
          </div>
          @error('password')
            <p class="field-error">
              <span class="material-symbols-rounded text-[13px]">info</span>
              {{ $message }}
            </p>
          @enderror
        </div>

        {{-- Remember me --}}
        <div class="flex items-center gap-2">
          <input type="checkbox" id="remember" name="remember" class="checkbox checkbox-sm checkbox-success rounded" />
          <label for="remember" class="text-[13px] text-slate-600 cursor-pointer select-none">
            Ingat saya selama 30 hari
          </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="login-btn" id="loginBtn">
          <span class="material-symbols-rounded text-[20px]">login</span>
          Masuk ke Panel Admin
        </button>
      </form>

      <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <a href="{{ route('home') }}" class="text-[13px] text-slate-400 hover:text-emerald-600 transition-colors inline-flex items-center gap-1">
          <span class="material-symbols-rounded text-[16px]">arrow_back</span>
          Kembali ke website publik
        </a>
      </div>
    </div>

    <!-- Disclaimer -->
    <p class="text-center text-[11px] text-slate-400 mt-6 leading-relaxed">
      Halaman ini hanya untuk Admin Wilayah dan Koordinator Cabang Aisyiyah.<br>
      &copy; {{ date('Y') }} SiCegah Stunting — Aisyiyah Kalimantan Timur
    </p>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const icon  = document.getElementById('togglePwd');
      if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
      } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
      }
    }

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function () {
      const btn = document.getElementById('loginBtn');
      btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Memproses...';
      btn.disabled = true;
    });
  </script>

</body>
</html>
