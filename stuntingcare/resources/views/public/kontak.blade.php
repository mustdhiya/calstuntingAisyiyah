<!DOCTYPE html>
<html lang="id"data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak - SiCegah Stunting</title>
  <meta name="description" content="Hubungi tim SiCegah Stunting untuk informasi program, kolaborasi, edukasi, dan layanan kontak institusi." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=2') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico?v=2') }}">
<link rel="apple-touch-icon" href="{{ asset('img/logo.png?v=2') }}">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body{font-family:Inter,sans-serif}
    .material-symbols-rounded{font-variation-settings:'FILL' 1,'wght' 500,'GRAD' 0,'opsz' 24}
    .soft-card{box-shadow:0 10px 30px rgba(15,23,42,.06)}
  </style>
</head>
<body class="bg-slate-50 text-slate-800">

  <!-- Header -->
  <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="navbar max-w-7xl mx-auto px-4 lg:px-8 min-h-18">
      <div class="navbar-start">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-white shadow-sm border border-slate-200 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('img/logo.png') }}" alt="Logo SiCegah Stunting" class="w-9 h-9 object-contain">
            </div>
            <div>
                <div class="font-extrabold text-emerald-700">SiCegah Stunting</div>
                <div class="text-xs text-slate-500">Edukasi dan Skrining Awal</div>
            </div>
        </a>
    </div>

      <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1 px-1">
          <li><a href="{{ route('home') }}">Beranda</a></li>
          <li><a href="{{ route('kalkulator') }}">Kalkulator</a></li>
          <li><a href="{{ route('edukasi') }}">Edukasi</a></li>
          <li><a href="{{ route('tentang') }}">Tentang</a></li>
          <li><a href="{{ route('faq') }}">FAQ</a></li>
          <li><a class="text-emerald-700 font-semibold bg-emerald-50" href="{{ route('kontak') }}">Kontak</a></li>
        </ul>
      </div>

      <div class="navbar-end gap-2">
        @guest
          <a href="{{ route('login') }}" class="btn btn-outline border-emerald-600 text-emerald-700 hover:bg-emerald-50 rounded-full px-4 btn-sm font-semibold">
            <span class="material-symbols-rounded text-sm">login</span>
            Masuk
          </a>
        @endguest

        @auth
          <div class="hidden md:flex items-center gap-1 bg-slate-100 rounded-full px-2.5 py-1 text-xs font-semibold text-slate-600">
            <span class="material-symbols-rounded text-base text-emerald-600">account_circle</span>
            <span class="max-w-[70px] truncate">{{ Auth::user()->name }}</span>
          </div>
          @if(Auth::user()->isAdminWilayah())
            <a href="{{ route('admin.dashboard') }}" class="btn bg-slate-800 hover:bg-slate-900 text-white rounded-full px-4 btn-sm font-semibold border-0">
              Dashboard
            </a>
          @endif
          @if(!Auth::user()->isAdminWilayah())
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn bg-red-50 hover:bg-red-100 text-red-600 rounded-full px-4 btn-sm font-semibold border-0">
              Keluar
            </button>
          </form>
          @endif
        @endauth

        <a href="{{ route('kalkulator') }}" class="hidden sm:inline-flex btn btn-primary rounded-full btn-sm">Buka Kalkulator</a>
        
        <div class="dropdown dropdown-end lg:hidden">
          <div tabindex="0" role="button" class="btn btn-ghost btn-circle" aria-label="Buka menu">
            <span class="material-symbols-rounded">menu</span>
          </div>
          <ul tabindex="0" class="menu dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-56 border border-slate-200">
            @auth
              <li class="menu-title px-4 py-1 text-[11px] text-slate-400">Akun: {{ Auth::user()->name }}</li>
            @endauth
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('kalkulator') }}">Kalkulator</a></li>
            <li><a href="{{ route('edukasi') }}">Edukasi</a></li>
            <li><a href="{{ route('tentang') }}">Tentang</a></li>
            <li><a href="{{ route('faq') }}">FAQ</a></li>
            <li><a class="font-semibold text-emerald-700" href="{{ route('kontak') }}">Kontak</a></li>
            
            @guest
              <li class="border-t border-slate-100 mt-1 pt-1"><a href="{{ route('login') }}" class="font-semibold text-emerald-700"><span class="material-symbols-rounded text-sm">login</span>Masuk</a></li>
            @endguest

            @auth
              <li class="border-t border-slate-100 mt-1 pt-1">
                @if(Auth::user()->isAdminWilayah())
                  <a href="{{ route('admin.dashboard') }}"><span class="material-symbols-rounded text-sm">dashboard</span>Dashboard</a>
                @endif
                @if(!Auth::user()->isAdminWilayah())
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                  @csrf
                  <button type="submit" class="w-full text-left text-red-600 font-semibold flex items-center gap-1"><span class="material-symbols-rounded text-sm">logout</span>Keluar</button>
                </form>
                @endif
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 lg:px-8 py-8 md:py-12">

    <!-- Intro -->
    <section class="mb-8 md:mb-10">
      <div class="badge badge-success badge-outline mb-4 px-3 py-3">Kontak Program</div>
      <div class="grid lg:grid-cols-[1.2fr_.8fr] gap-6 items-start">
        <div>
          <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
            Hubungi tim pengelola
            <span class="text-emerald-700">SiCegah Stunting</span>
          </h1>
          <p class="text-slate-600 mt-4 max-w-3xl text-base md:text-lg leading-relaxed">
            Gunakan halaman ini untuk menghubungi tim terkait informasi program, kolaborasi penelitian, pengabdian masyarakat, atau pertanyaan umum seputar edukasi stunting.
          </p>
        </div>
        <div class="card bg-white border border-emerald-100 soft-card rounded-3xl">
          <div class="card-body p-5">
            <div class="flex items-start gap-3">
              <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <span class="material-symbols-rounded">schedule</span>
              </div>
              <div>
                <h2 class="font-bold text-slate-800">Respons lebih jelas</h2>
                <p class="text-sm text-slate-600 mt-1">Pesan akan ditinjau pada hari kerja. Cantumkan subjek yang singkat agar tim lebih cepat membantu.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Main Content -->
    <section class="grid xl:grid-cols-[.95fr_1.05fr] gap-6 items-start">
      <div class="space-y-6">

        <div class="card bg-white border border-slate-200 rounded-3xl soft-card">
          <div class="card-body p-6 md:p-7">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <span class="material-symbols-rounded">apartment</span>
              </div>
              <div>
                <h2 class="card-title text-xl">Informasi institusi</h2>
                <p class="text-sm text-slate-500">Kontak resmi pengelola program</p>
              </div>
            </div>

            <div class="space-y-4 text-sm md:text-base">
              <div class="flex items-start gap-3">
                <span class="material-symbols-rounded text-emerald-700 mt-0.5">apartment</span>
                <div>
                  <div class="font-semibold text-slate-800">Institusi</div>
                  <div class="text-slate-600"> Universitas Muhammadiyah Kalimantan Timur</div>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <span class="material-symbols-rounded text-cyan-700 mt-0.5">mail</span>
                <div>
                  <div class="font-semibold text-slate-800">Email</div>
                  <a href="mailto:baua@umkt.ac.id" class="text-slate-600 hover:text-emerald-700 transition">baua@umkt.ac.id</a>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <span class="material-symbols-rounded text-amber-700 mt-0.5">call</span>
                <div>
                  <div class="font-semibold text-slate-800">Telepon</div>
                  <a href="tel:+6281254888102" class="text-slate-600 hover:text-emerald-700 transition">(628) 1254888102</a>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <span class="material-symbols-rounded text-emerald-700 mt-0.5">location_on</span>
                <div>
                  <div class="font-semibold text-slate-800">Lokasi</div>
                  <div class="text-slate-600">Samarinda, Kalimantan Timur</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="alert border border-sky-200 bg-sky-50 text-sky-900 rounded-2xl">
          <span class="material-symbols-rounded">info</span>
          <span>Pertanyaan umum dapat dikirim melalui formulir. Untuk informasi yang sering ditanyakan, silakan cek halaman FAQ.</span>
        </div>

        <div class="card bg-white border border-slate-200 rounded-3xl soft-card">
          <div class="card-body p-6 md:p-7">
            <div class="flex items-center justify-between gap-4 mb-4">
              <div>
                <h2 class="card-title text-xl">Lokasi institusi</h2>
                <p class="text-sm text-slate-500">Universitas Muhammadiyah Kalimantan Timur Samarinda</p>
              </div>
              <a href="https://www.google.com/maps/place/Universitas+Muhammadiyah+Kalimantan+Timur+Samarinda/@-0.4763155,117.1382401,15z/data=!4m6!3m5!1s0x2df67f21b115fd67:0x108077d433712165!8m2!3d-0.4749719!4d117.1388952!16s%2Fg%2F11g9q5lqg_" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline rounded-full">
                Buka Peta
              </a>
            </div>

            <div class="rounded-[2rem] h-72 overflow-hidden border border-slate-200">
              <iframe
                src="https://maps.google.com/maps?q=-0.4749719,117.1388952&z=16&output=embed"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                aria-label="Peta lokasi Universitas Muhammadiyah Kalimantan Timur Samarinda">
              </iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="card bg-white border border-slate-200 rounded-3xl shadow-lg">
        <div class="card-body p-6 md:p-8 gap-5">
          <div class="flex items-start gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
              <span class="material-symbols-rounded">edit_square</span>
            </div>
            <div>
              <h2 class="card-title text-2xl">Kirim pesan</h2>
              <p class="text-sm text-slate-500 mt-1">Isi formulir berikut. Tim akan meninjau pesan Anda secepatnya.</p>
            </div>
          </div>

          <form class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
              <label class="form-control w-full">
                <div class="label">
                  <span class="label-text font-semibold">Nama Lengkap <span class="text-rose-500">*</span></span>
                </div>
                <input type="text" class="input input-bordered w-full rounded-2xl" placeholder="Masukkan nama lengkap" required />
              </label>

              <label class="form-control w-full">
                <div class="label">
                  <span class="label-text font-semibold">Email <span class="text-rose-500">*</span></span>
                </div>
                <input type="email" class="input input-bordered w-full rounded-2xl" placeholder="nama@email.com" required />
              </label>
            </div>

            <label class="form-control w-full">
              <div class="label">
                <span class="label-text font-semibold">Subjek <span class="text-rose-500">*</span></span>
              </div>
              <input type="text" class="input input-bordered w-full rounded-2xl" placeholder="Contoh: Permohonan informasi program" required />
            </label>

            <label class="form-control w-full">
              <div class="label">
                <span class="label-text font-semibold">Pesan <span class="text-rose-500">*</span></span>
              </div>
              <textarea class="textarea textarea-bordered h-36 rounded-2xl" placeholder="Tuliskan pertanyaan atau pesan Anda secara singkat dan jelas" required></textarea>
              <div class="label">
                <span class="label-text-alt text-slate-500">Jangan cantumkan data medis sensitif jika belum diperlukan.</span>
              </div>
            </label>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
              <p class="text-xs text-slate-500 leading-relaxed">
                Dengan mengirim formulir ini, Anda setuju pesan diproses untuk keperluan tindak lanjut komunikasi program.
              </p>
              <button type="submit" class="btn btn-primary rounded-full px-6">
                <span class="material-symbols-rounded text-[18px]">send</span>
                Kirim Pesan
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Secondary CTA -->
    <section class="mt-10">
      <div class="card bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-[2rem] shadow-lg">
        <div class="card-body p-6 md:p-8 md:flex-row md:items-center md:justify-between gap-5">
          <div>
            <h2 class="text-2xl font-bold">Butuh informasi cepat?</h2>
            <p class="text-emerald-50 mt-2 text-sm md:text-base">
              Anda juga dapat membaca FAQ atau menggunakan kalkulator stunting untuk skrining awal.
            </p>
          </div>
          <div class="flex flex-wrap gap-3">
            <a href="{{ route('faq') }}" class="btn bg-white text-emerald-700 border-white hover:bg-emerald-50 rounded-full">Lihat FAQ</a>
            <a href="{{ route('kalkulator') }}" class="btn btn-outline text-white border-white hover:bg-white hover:text-emerald-700 rounded-full">Buka Kalkulator</a>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer class="footer footer-horizontal p-10 bg-slate-900 text-slate-200 mt-12">
    <nav>
      <h6 class="footer-title">Navigasi</h6>
      <a class="link link-hover" href="{{ route('home') }}">Beranda</a>
      <a class="link link-hover" href="{{ route('tentang') }}">Tentang</a>
      <a class="link link-hover" href="{{ route('faq') }}">FAQ</a>
      <a class="link link-hover" href="{{ route('kontak') }}">Kontak</a>
    </nav>
    <aside>
      <p class="font-semibold">SiCegah Stunting</p>
      <p class="text-sm text-slate-400">Edukasi dan skrining awal untuk mendukung pencegahan stunting.</p>
    </aside>
  </footer>

</body>
</html>