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
  <!-- Custom Login CSS (External) -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
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
              placeholder="admin@contoh.id"
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
        <button type="submit" class="login-btn w-full" id="loginBtn">
          <span class="material-symbols-rounded text-[20px]">login</span>
          Masuk
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
    <p class="text-center text-[11px] text-slate-400 mt-4 leading-relaxed">
      Akses sistem hanya untuk pengguna yang telah terdaftar.<br>
      Penambahan akun dilakukan oleh administrator.<br>
      &copy; {{ date('Y') }} SiCegah Stunting — Aisyiyah Kalimantan Timur
    </p>
  </div>

  <!-- Custom Login JS (External) -->
  <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
