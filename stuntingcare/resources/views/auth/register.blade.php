<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Akun — SiCegah Stunting</title>
  <meta name="description" content="Buat akun SiCegah Stunting untuk memantau tumbuh kembang anak secara personal." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Custom Login CSS (External) -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body class="login-bg flex items-center justify-center p-4 py-10">

  <div class="w-full max-w-lg">

    <!-- Logo & branding -->
    <div class="text-center mb-8">
      <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-3">
        <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shadow-lg">
          <span class="material-symbols-rounded text-3xl">health_and_safety</span>
        </div>
        <div>
          <div class="font-extrabold text-emerald-700 text-xl">SiCegah Stunting</div>
          <div class="text-xs text-slate-500">Edukasi dan Skrining Awal Stunting</div>
        </div>
      </a>
    </div>

    <!-- Register card -->
    <div class="login-card p-8">

      <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Buat akun baru</h1>
        <p class="text-sm text-slate-500 mt-1">Daftar sebagai <span class="font-semibold text-emerald-600">Pengguna Umum</span> untuk memantau tumbuh kembang anak Anda.</p>
      </div>

      @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5 text-sm text-red-700 flex items-start gap-2">
          <span class="material-symbols-rounded text-base mt-0.5 flex-shrink-0">error</span>
          <ul class="space-y-0.5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="registerForm" method="POST" action="{{ route('register.post') }}" novalidate>
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <!-- Nama Lengkap -->
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
              Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">person</span>
              <input type="text" name="name" id="name"
                class="login-input {{ $errors->has('name') ? 'is-error' : '' }}"
                placeholder="Nama lengkap Anda"
                value="{{ old('name') }}" required autofocus />
            </div>
            @error('name')
              <p class="field-error"><span class="material-symbols-rounded text-sm">info</span>{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
              Alamat Email <span class="text-red-500">*</span>
            </label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">mail</span>
              <input type="email" name="email" id="email"
                class="login-input {{ $errors->has('email') ? 'is-error' : '' }}"
                placeholder="email@contoh.com"
                value="{{ old('email') }}" required />
            </div>
            @error('email')
              <p class="field-error"><span class="material-symbols-rounded text-sm">info</span>{{ $message }}</p>
            @enderror
          </div>

          <!-- Nomor HP -->
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nomor HP</label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">phone</span>
              <input type="tel" name="phone_number" id="phone_number"
                class="login-input {{ $errors->has('phone_number') ? 'is-error' : '' }}"
                placeholder="08xx-xxxx-xxxx"
                value="{{ old('phone_number') }}" />
            </div>
            @error('phone_number')
              <p class="field-error"><span class="material-symbols-rounded text-sm">info</span>{{ $message }}</p>
            @enderror
          </div>

          <!-- Kota -->
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kota / Kabupaten</label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">location_city</span>
              <input type="text" name="city" id="city"
                class="login-input {{ $errors->has('city') ? 'is-error' : '' }}"
                placeholder="Contoh: Samarinda"
                value="{{ old('city') }}" />
            </div>
            @error('city')
              <p class="field-error"><span class="material-symbols-rounded text-sm">info</span>{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
              Kata Sandi <span class="text-red-500">*</span>
            </label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">lock</span>
              <input type="password" name="password" id="password"
                class="login-input {{ $errors->has('password') ? 'is-error' : '' }}"
                placeholder="Minimal 8 karakter" required />
              <span class="input-icon-right material-symbols-rounded" onclick="togglePassword('password', 'togglePwd1')">visibility_off</span>
            </div>
            @error('password')
              <p class="field-error"><span class="material-symbols-rounded text-sm">info</span>{{ $message }}</p>
            @enderror
          </div>

          <!-- Konfirmasi Password -->
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
              Konfirmasi Kata Sandi <span class="text-red-500">*</span>
            </label>
            <div class="input-wrap">
              <span class="input-icon material-symbols-rounded">lock_reset</span>
              <input type="password" name="password_confirmation" id="password_confirmation"
                class="login-input {{ $errors->has('password_confirmation') ? 'is-error' : '' }}"
                placeholder="Ulangi kata sandi" required />
              <span class="input-icon-right material-symbols-rounded" onclick="togglePassword('password_confirmation', 'togglePwd2')">visibility_off</span>
            </div>
          </div>

        </div>

        <!-- Info role -->
        <div class="mt-4 bg-emerald-50 border border-emerald-100 rounded-xl p-3 flex items-start gap-2 text-xs text-emerald-700">
          <span class="material-symbols-rounded text-base flex-shrink-0 mt-0.5">info</span>
          <span>Akun yang didaftarkan secara mandiri akan memiliki peran <strong>Pengguna Umum</strong>. Untuk peran Kader atau Koordinator, hubungi Admin Wilayah Aisyiyah Kalimantan Timur.</span>
        </div>

        <!-- Submit -->
        <button type="submit" id="registerBtn" class="login-btn mt-5">
          <span class="material-symbols-rounded text-xl">person_add</span>
          Buat Akun
        </button>

      </form>
    </div>

    <!-- Link kembali ke login -->
    <p class="text-center text-sm text-slate-500 mt-5">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:underline">Masuk di sini</a>
    </p>

    <p class="text-center text-[11px] text-slate-400 mt-4 leading-relaxed">
      &copy; {{ date('Y') }} SiCegah Stunting — Aisyiyah Kalimantan Timur
    </p>
  </div>

  <!-- Custom Register JS (External) -->
  <script src="{{ asset('js/register.js') }}"></script>

</body>
</html>
