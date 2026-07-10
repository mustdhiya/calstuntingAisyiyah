<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Program — SiCegah Stunting</title>
  <meta name="description" content="Tentang program SiCegah Stunting: latar belakang, tujuan, sasaran, peran Aisyiyah Kalimantan Timur, dan tim pengembang." />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- tailwind.config -->
  <script src="{{ asset('js/user/tentang-config.js') }}"></script>

  <!-- css -->
  <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user/tentang.css') }}" />
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

  <!-- ═══════════════════════════════════════ NAVBAR ═══════════════════════════════ -->
  <header id="navbar" class="bg-white/95 backdrop-blur-sm sticky top-0 z-50 border-b border-slate-100 nav-shadow">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">

      <!-- Logo -->
      <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
        <div class="w-9 h-9 rounded-xl bg-brand-600 flex items-center justify-center shadow-sm">
          <span class="material-symbols-rounded text-white text-xl">health_and_safety</span>
        </div>
        <div class="leading-tight">
          <div class="font-bold text-brand-700 text-sm sm:text-base">SiCegah Stunting</div>
          <div class="text-[10px] text-slate-400 hidden sm:block">Aisyiyah Kalimantan Timur</div>
        </div>
      </a>

      <!-- Desktop nav -->
      <nav class="hidden lg:flex items-center gap-0.5">
        <a href="{{ route('home') }}"       class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition-all">Beranda</a>
        <a href="{{ route('kalkulator') }}"  class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition-all">Kalkulator</a>
        <a href="{{ route('edukasi') }}"     class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition-all">Edukasi</a>
        <a href="{{ route('tentang') }}"     class="px-3 py-2 text-sm font-medium nav-active transition-all">Tentang</a>
        <a href="{{ route('faq') }}"         class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition-all">FAQ</a>
        <a href="{{ route('kontak') }}"      class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition-all">Kontak</a>
      </nav>

      <!-- Desktop CTA -->
      <div class="hidden lg:flex items-center gap-2">
        @guest
          <a href="{{ route('login') }}" class="px-4 py-2 border border-brand-600 text-brand-700 text-sm font-semibold rounded-full hover:bg-brand-50 transition-all">
            <span class="material-symbols-rounded text-base">login</span>
            Masuk
          </a>
        @endguest

        @auth
          <div class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 rounded-full text-xs text-slate-600 font-medium">
            <span class="material-symbols-rounded text-sm text-brand-600 font-normal">account_circle</span>
            <span class="max-w-[80px] truncate">{{ Auth::user()->name }}</span>
          </div>
          @if(Auth::user()->isAdminWilayah())
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-800 text-white text-sm font-semibold rounded-full hover:bg-slate-900 transition-all">
              Dashboard
            </a>
          @endif
          @if(!Auth::user()->isAdminWilayah())
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 text-sm font-semibold rounded-full hover:bg-red-100 transition-all">
              Keluar
            </button>
          </form>
          @endif
        @endauth

        <a href="{{ route('kalkulator') }}"
           class="inline-flex items-center gap-1.5 px-4 py-2 bg-brand-600 text-white text-sm font-semibold rounded-full hover:bg-brand-700 transition-all shadow-sm">
          <span class="material-symbols-rounded text-base">calculate</span>
          Cek Sekarang
        </a>
      </div>

      <!-- Mobile hamburger -->
      <button id="hamburger" aria-label="Buka menu" aria-expanded="false"
              class="lg:hidden p-2 rounded-xl hover:bg-slate-100 transition-colors text-slate-600">
        <span class="material-symbols-rounded" id="hamburger-icon">menu</span>
      </button>
    </div>

    <!-- Mobile nav -->
    <div id="mobile-nav">
      <div class="max-w-6xl mx-auto px-4 pb-4 flex flex-col gap-1">
        @auth
          <div class="px-3 py-2 mb-1 bg-slate-50 rounded-xl flex items-center gap-2 text-xs text-slate-600 font-medium">
            <span class="material-symbols-rounded text-brand-600">account_circle</span>
            <span class="truncate">{{ Auth::user()->name }}</span>
          </div>
        @endauth

        <a href="{{ route('home') }}"      class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-slate-400 text-base">home</span>Beranda</a>
        <a href="{{ route('kalkulator') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-slate-400 text-base">calculate</span>Kalkulator</a>
        <a href="{{ route('edukasi') }}"    class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-slate-400 text-base">menu_book</span>Edukasi</a>
        <a href="{{ route('tentang') }}"    class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium text-brand-700 bg-brand-50 transition-colors"><span class="material-symbols-rounded text-brand-600 text-base">info</span>Tentang</a>
        <a href="{{ route('faq') }}"        class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-slate-400 text-base">help</span>FAQ</a>
        <a href="{{ route('kontak') }}"     class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-slate-400 text-base">mail</span>Kontak</a>

        @guest
          <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-brand-700 font-semibold hover:bg-brand-50 transition-colors"><span class="material-symbols-rounded text-base">login</span>Masuk Akun</a>
        @endguest

        @auth
          @if(Auth::user()->isAdminWilayah())
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-slate-700 hover:bg-slate-50 transition-colors"><span class="material-symbols-rounded text-base">dashboard</span>Dashboard Admin</a>
          @endif
          @if(!Auth::user()->isAdminWilayah())
          <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="flex w-full items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-red-600 font-semibold hover:bg-red-50 transition-colors"><span class="material-symbols-rounded text-base">logout</span>Keluar</button>
          </form>
          @endif
        @endauth

        <a href="{{ route('kalkulator') }}"
           class="mt-1 flex items-center justify-center gap-2 px-4 py-3 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 transition-all">
          <span class="material-symbols-rounded text-base">calculate</span>
          Cek Risiko Stunting
        </a>
      </div>
    </div>
  </header>


  <main class="flex-1">

    <!-- ═══════════════════════════════════════ HERO ══════════════════════════════ -->
    <section class="hero-blob bg-white border-b border-slate-100">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-14 pb-16">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-xs text-slate-400 mb-8 fade-up">
          <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Beranda</a>
          <span class="material-symbols-rounded text-xs">chevron_right</span>
          <span class="text-slate-600">Tentang Program</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Copy -->
          <div class="fade-up delay-1">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-700 bg-brand-50 border border-brand-200 px-3 py-1.5 rounded-full mb-5">
              <span class="material-symbols-rounded text-xs">info</span>
              Tentang Program
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
              Edukasi &amp; Skrining Awal<br class="hidden sm:block"/>
              <span class="text-brand-600">Stunting</span> untuk Semua
            </h1>
            <p class="text-slate-500 text-base leading-relaxed max-w-lg">
              SiCegah Stunting adalah platform edukasi dan skrining awal yang dirancang khusus untuk ibu, kader kesehatan, dan masyarakat umum di Kalimantan Timur — sederhana, cepat, dan mudah dipakai di mana saja.
            </p>

            <!-- Quick action -->
            <div class="flex flex-wrap gap-3 mt-8">
              <a href="{{ route('kalkulator') }}"
                 class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-full hover:bg-brand-700 transition-all shadow-sm">
                <span class="material-symbols-rounded text-base">calculate</span>
                Coba Kalkulator
              </a>
              <a href="{{ route('edukasi') }}"
                 class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-700 text-sm font-semibold rounded-full border border-slate-200 hover:border-brand-400 hover:text-brand-700 transition-all">
                <span class="material-symbols-rounded text-base">menu_book</span>
                Baca Edukasi
              </a>
            </div>
          </div>

          <!-- Stats visual -->
          <div class="grid grid-cols-2 gap-4 fade-up delay-2">
            <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm col-span-2 flex items-center gap-4">
              <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-brand-600 text-2xl">groups</span>
              </div>
              <div>
                <p class="text-2xl font-bold text-brand-700">3 Kelompok</p>
                <p class="text-sm text-slate-500">Orang tua · Kader kesehatan · Masyarakat umum</p>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-cyan-600 text-xl">devices</span>
              </div>
              <div>
                <p class="text-lg font-bold text-cyan-700">Mobile First</p>
                <p class="text-xs text-slate-500">Responsif di semua perangkat</p>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-amber-600 text-xl">verified</span>
              </div>
              <div>
                <p class="text-lg font-bold text-amber-700">Standar WHO</p>
                <p class="text-xs text-slate-500">Kalkulasi berbasis data resmi</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════ LATAR BELAKANG + TUJUAN ══════════ -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
      <div class="text-center mb-12 fade-up">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3">Mengapa Program Ini?</h2>
        <p class="text-slate-500 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Stunting bukan hanya masalah tinggi badan — ini adalah isu kualitas sumber daya manusia jangka panjang yang membutuhkan perhatian dan tindakan bersama.
        </p>
      </div>

      <div class="grid sm:grid-cols-2 gap-5">

        <!-- Latar Belakang -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 card-lift fade-up delay-1">
          <div class="w-11 h-11 rounded-2xl bg-red-50 flex items-center justify-center mb-5">
            <span class="material-symbols-rounded text-red-500 text-2xl">report_problem</span>
          </div>
          <h3 class="font-bold text-slate-900 text-lg mb-3">Latar Belakang</h3>
          <p class="text-slate-500 text-sm leading-relaxed">
            Prevalensi stunting di Indonesia masih berada di angka <strong class="text-slate-700">21,5%</strong> secara nasional, dengan Kalimantan Timur mencatat angka sekitar <strong class="text-slate-700">27%</strong>. WHO menyediakan standar pertumbuhan anak yang menjadi acuan global, sementara Kemenkes RI menekankan pentingnya intervensi gizi, ASI eksklusif, sanitasi, dan pemantauan rutin sejak 1000 Hari Pertama Kehidupan.
          </p>
        </div>

        <!-- Tujuan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 card-lift fade-up delay-2">
          <div class="w-11 h-11 rounded-2xl bg-brand-50 flex items-center justify-center mb-5">
            <span class="material-symbols-rounded text-brand-600 text-2xl">flag</span>
          </div>
          <h3 class="font-bold text-slate-900 text-lg mb-3">Tujuan Program</h3>
          <ul class="space-y-2.5">
            <li class="flex items-start gap-2.5 text-sm text-slate-500">
              <span class="material-symbols-rounded text-brand-500 text-base shrink-0 mt-0.5">check_circle</span>
              Menyediakan media edukasi digital stunting yang mudah diakses
            </li>
            <li class="flex items-start gap-2.5 text-sm text-slate-500">
              <span class="material-symbols-rounded text-brand-500 text-base shrink-0 mt-0.5">check_circle</span>
              Alat skrining awal berbasis standar WHO yang gratis dan cepat
            </li>
            <li class="flex items-start gap-2.5 text-sm text-slate-500">
              <span class="material-symbols-rounded text-brand-500 text-base shrink-0 mt-0.5">check_circle</span>
              Sarana literasi kesehatan untuk penelitian dan pengabdian masyarakat
            </li>
            <li class="flex items-start gap-2.5 text-sm text-slate-500">
              <span class="material-symbols-rounded text-brand-500 text-base shrink-0 mt-0.5">check_circle</span>
              Mendukung program kerja Aisyiyah Kalimantan Timur di bidang kesehatan
            </li>
          </ul>
        </div>

        <!-- Sasaran Pengguna -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 card-lift fade-up delay-3">
          <div class="w-11 h-11 rounded-2xl bg-cyan-50 flex items-center justify-center mb-5">
            <span class="material-symbols-rounded text-cyan-600 text-2xl">group</span>
          </div>
          <h3 class="font-bold text-slate-900 text-lg mb-4">Sasaran Pengguna</h3>
          <div class="space-y-3">
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-xl bg-pink-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-pink-500 text-base">family_restroom</span>
              </div>
              <div>
                <p class="font-medium text-slate-700">Ibu &amp; Calon Ibu</p>
                <p class="text-xs text-slate-400">Pemantauan tumbuh kembang anak</p>
              </div>
            </div>
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-xl bg-brand-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-brand-600 text-base">medical_services</span>
              </div>
              <div>
                <p class="font-medium text-slate-700">Kader Kesehatan</p>
                <p class="text-xs text-slate-400">Alat bantu posyandu &amp; pendampingan</p>
              </div>
            </div>
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-amber-500 text-base">public</span>
              </div>
              <div>
                <p class="font-medium text-slate-700">Masyarakat Umum</p>
                <p class="text-xs text-slate-400">Literasi kesehatan berbasis digital</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Peran Aisyiyah -->
        <div class="bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-6 sm:p-8 card-lift fade-up delay-4 text-white">
          <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center mb-5">
            <span class="material-symbols-rounded text-white text-2xl">volunteer_activism</span>
          </div>
          <h3 class="font-bold text-lg mb-3">Peran Aisyiyah Kaltim</h3>
          <p class="text-brand-100 text-sm leading-relaxed mb-4">
            Aisyiyah Kalimantan Timur berperan sebagai penggerak utama kampanye edukasi kesehatan berbasis komunitas, pendampingan kader posyandu, dan komunikasi publik literasi gizi melalui platform digital ini.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-white/15 text-white text-xs font-medium px-3 py-1 rounded-full">Kampanye Edukasi</span>
            <span class="bg-white/15 text-white text-xs font-medium px-3 py-1 rounded-full">Pendampingan Kader</span>
            <span class="bg-white/15 text-white text-xs font-medium px-3 py-1 rounded-full">Literasi Digital</span>
          </div>
        </div>

      </div>
    </section>


    <!-- ═══════════════════════════════════════ ALUR PENGEMBANGAN ════════════════ -->
    <section class="bg-white border-y border-slate-100">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
        <div class="text-center mb-12">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3">Alur Pengembangan</h2>
          <p class="text-slate-500 text-sm sm:text-base max-w-lg mx-auto">Dari identifikasi kebutuhan hingga deployment production-ready</p>
        </div>

        <!-- Timeline — vertical on mobile, horizontal on desktop -->
        <div class="relative">

          <!-- Vertical connector line (mobile) -->
          <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-brand-500 via-cyan-400 to-brand-300 lg:hidden"></div>

          <div class="space-y-6 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-6 relative">

            <!-- Horizontal connector (desktop) -->
            <div class="hidden lg:block absolute top-11 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-brand-500 via-cyan-400 to-amber-400 z-0"></div>

            <!-- Step 1 -->
            <div class="relative flex items-start gap-5 lg:flex-col lg:items-center lg:text-center lg:gap-0 fade-up delay-1">
              <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center shrink-0 z-10 shadow-md shadow-brand-200 lg:mb-5">
                <span class="material-symbols-rounded text-xl">search</span>
              </div>
              <div class="pb-2 lg:pb-0">
                <span class="inline-block text-xs font-bold text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full mb-2">Tahap 1</span>
                <h4 class="font-semibold text-slate-800 text-sm mb-1">Identifikasi Kebutuhan</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Analisis kebutuhan edukasi stunting di masyarakat Kalimantan Timur</p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="relative flex items-start gap-5 lg:flex-col lg:items-center lg:text-center lg:gap-0 fade-up delay-2">
              <div class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shrink-0 z-10 shadow-md shadow-cyan-200 lg:mb-5">
                <span class="material-symbols-rounded text-xl">design_services</span>
              </div>
              <div class="pb-2 lg:pb-0">
                <span class="inline-block text-xs font-bold text-cyan-600 bg-cyan-50 px-2.5 py-1 rounded-full mb-2">Tahap 2</span>
                <h4 class="font-semibold text-slate-800 text-sm mb-1">Perancangan UI/UX</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Desain antarmuka mobile-first yang bersih, ramah, dan aksesibel</p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="relative flex items-start gap-5 lg:flex-col lg:items-center lg:text-center lg:gap-0 fade-up delay-3">
              <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 z-10 shadow-md shadow-amber-200 lg:mb-5">
                <span class="material-symbols-rounded text-xl">calculate</span>
              </div>
              <div class="pb-2 lg:pb-0">
                <span class="inline-block text-xs font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full mb-2">Tahap 3</span>
                <h4 class="font-semibold text-slate-800 text-sm mb-1">Kalkulator &amp; Konten</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Penyusunan kalkulasi z-score WHO dan konten edukasi tervalidasi</p>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="relative flex items-start gap-5 lg:flex-col lg:items-center lg:text-center lg:gap-0 fade-up delay-4">
              <div class="w-12 h-12 rounded-2xl bg-brand-700 text-white flex items-center justify-center shrink-0 z-10 shadow-md shadow-brand-200 lg:mb-5">
                <span class="material-symbols-rounded text-xl">rocket_launch</span>
              </div>
              <div class="pb-2 lg:pb-0">
                <span class="inline-block text-xs font-bold text-brand-700 bg-brand-50 px-2.5 py-1 rounded-full mb-2">Tahap 4</span>
                <h4 class="font-semibold text-slate-800 text-sm mb-1">Integrasi &amp; Deployment</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Integrasi backend Django dan deployment ke VPS production</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════ STACK TEKNOLOGI ══════════════════ -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
      <div class="text-center mb-10">
        <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Stack Teknologi</h2>
        <p class="text-slate-500 text-sm">Dibangun dengan teknologi modern yang ringan dan production-ready</p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-100 p-5 text-center shadow-sm card-lift">
          <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center mx-auto mb-3">
            <span class="material-symbols-rounded text-orange-500 text-xl">code</span>
          </div>
          <p class="font-bold text-slate-800 text-sm">Django</p>
          <p class="text-xs text-slate-400 mt-1">Backend Framework</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 text-center shadow-sm card-lift">
          <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center mx-auto mb-3">
            <span class="material-symbols-rounded text-cyan-500 text-xl">style</span>
          </div>
          <p class="font-bold text-slate-800 text-sm">Tailwind + DaisyUI</p>
          <p class="text-xs text-slate-400 mt-1">UI Framework</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 text-center shadow-sm card-lift">
          <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center mx-auto mb-3">
            <span class="material-symbols-rounded text-blue-500 text-xl">storage</span>
          </div>
          <p class="font-bold text-slate-800 text-sm">MySQL</p>
          <p class="text-xs text-slate-400 mt-1">Database</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 text-center shadow-sm card-lift">
          <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
            <span class="material-symbols-rounded text-slate-600 text-xl">dns</span>
          </div>
          <p class="font-bold text-slate-800 text-sm">Gunicorn + Nginx</p>
          <p class="text-xs text-slate-400 mt-1">Deployment</p>
        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════ TIM PENGEMBANG ═══════════════════ -->
    <section class="bg-white border-t border-slate-100">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
        <div class="text-center mb-12">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3">Tim Pengembang</h2>
          <p class="text-slate-500 text-sm sm:text-base max-w-md mx-auto leading-relaxed">
            Dibuat dengan semangat pengabdian untuk kesehatan masyarakat Kalimantan Timur
          </p>
        </div>

        <div class="grid sm:grid-cols-3 gap-5">

          <!-- Card: UI/UX -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center card-lift fade-up delay-1 group">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-brand-100 to-brand-200 flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
              <span class="material-symbols-rounded text-brand-600 text-4xl">design_services</span>
            </div>
            <span class="inline-block text-xs font-bold text-brand-600 bg-brand-50 px-3 py-1 rounded-full mb-3">UI/UX</span>
            <h3 class="font-bold text-slate-800 text-base mb-1.5">UI/UX Designer</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
              Merancang pengalaman pengguna yang intuitif, sistem desain yang konsisten, dan antarmuka mobile-first.
            </p>
          </div>

          <!-- Card: Frontend -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center card-lift fade-up delay-2 group">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-100 to-cyan-200 flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
              <span class="material-symbols-rounded text-cyan-600 text-4xl">web</span>
            </div>
            <span class="inline-block text-xs font-bold text-cyan-600 bg-cyan-50 px-3 py-1 rounded-full mb-3">Frontend</span>
            <h3 class="font-bold text-slate-800 text-base mb-1.5">Frontend Developer</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
              Membangun komponen HTML yang clean, responsif, dan siap diintegrasikan ke backend Django.
            </p>
          </div>

          <!-- Card: Research -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center card-lift fade-up delay-3 group">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
              <span class="material-symbols-rounded text-amber-600 text-4xl">biotech</span>
            </div>
            <span class="inline-block text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full mb-3">Penelitian</span>
            <h3 class="font-bold text-slate-800 text-base mb-1.5">Research Support</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
              Menyiapkan konten edukasi berbasis evidens, data stunting, dan kebutuhan presentasi akademik.
            </p>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════ CTA BOTTOM ════════════════════════ -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
      <div class="bg-gradient-to-br from-brand-600 to-brand-800 rounded-3xl p-8 sm:p-12 text-center text-white">
        <span class="material-symbols-rounded text-5xl mb-5 block opacity-90">child_friendly</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-4">Mulai Cek Risiko Anak Anda</h2>
        <p class="text-brand-100 text-sm sm:text-base max-w-md mx-auto leading-relaxed mb-8">
          Gratis, cepat, dan tanpa perlu daftar. Masukkan data anak dan dapatkan analisis risiko stunting berdasarkan standar WHO dalam hitungan detik.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
          <a href="{{ route('kalkulator') }}"
             class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-brand-700 font-bold rounded-full hover:bg-brand-50 transition-all shadow-lg text-sm sm:text-base">
            <span class="material-symbols-rounded text-xl">calculate</span>
            Buka Kalkulator
          </a>
          <a href="{{ route('edukasi') }}"
             class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/15 text-white font-semibold rounded-full hover:bg-white/25 transition-all text-sm sm:text-base border border-white/30">
            <span class="material-symbols-rounded text-xl">menu_book</span>
            Baca Edukasi
          </a>
        </div>
        <p class="text-xs text-brand-200 mt-5">Tanpa daftar · Gratis selamanya · Berbasis standar WHO &amp; Kemenkes RI</p>
      </div>
    </section>

  </main>


  <!-- ═══════════════════════════════════════ FOOTER ═══════════════════════════════ -->
  <footer class="bg-slate-900 text-slate-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-10">

        <!-- Brand -->
        <div class="sm:col-span-1">
          <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-xl bg-brand-600 flex items-center justify-center">
              <span class="material-symbols-rounded text-white text-base">health_and_safety</span>
            </div>
            <div>
              <p class="font-bold text-white text-sm">SiCegah Stunting</p>
              <p class="text-xs text-slate-500">Aisyiyah Kalimantan Timur</p>
            </div>
          </div>
          <p class="text-sm text-slate-400 leading-relaxed">
            Platform edukasi dan skrining awal stunting untuk kader dan masyarakat Kalimantan Timur.
          </p>
        </div>

        <!-- Navigasi -->
        <div>
          <h6 class="font-semibold text-white text-sm mb-4">Navigasi</h6>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ route('home') }}"      class="text-slate-400 hover:text-brand-400 transition-colors">Beranda</a></li>
            <li><a href="{{ route('kalkulator') }}" class="text-slate-400 hover:text-brand-400 transition-colors">Kalkulator</a></li>
            <li><a href="{{ route('edukasi') }}"    class="text-slate-400 hover:text-brand-400 transition-colors">Edukasi</a></li>
            <li><a href="{{ route('faq') }}"        class="text-slate-400 hover:text-brand-400 transition-colors">FAQ</a></li>
            <li><a href="{{ route('kontak') }}"     class="text-slate-400 hover:text-brand-400 transition-colors">Kontak</a></li>
          </ul>
        </div>

        <!-- Disclaimer -->
        <div>
          <h6 class="font-semibold text-white text-sm mb-4">Disclaimer</h6>
          <p class="text-xs text-slate-400 leading-relaxed">
            Hasil skrining bersifat indikatif dan tidak menggantikan pemeriksaan medis oleh tenaga kesehatan. Selalu konsultasikan ke dokter atau puskesmas terdekat.
          </p>
          <div class="flex items-center gap-1.5 mt-3">
            <span class="material-symbols-rounded text-brand-500 text-sm">verified</span>
            <span class="text-xs text-slate-400">Berbasis standar WHO &amp; Kemenkes RI</span>
          </div>
        </div>

      </div>

      <!-- Bottom bar -->
      <div class="border-t border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-slate-500">© 2025 SiCegah Stunting — Pengurus Wilayah Aisyiyah Kalimantan Timur</p>
        <p class="text-xs text-slate-500 flex items-center gap-1">
          <span class="material-symbols-rounded text-xs">favorite</span>
          Untuk kesehatan anak Indonesia
        </p>
      </div>
    </div>
  </footer>


  <!-- ═══════════════════════════════════════ JS ═══════════════════════════════════ -->
  <script>
    // Mobile nav toggle
    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobile-nav');
    const hamburgerIcon = document.getElementById('hamburger-icon');

    hamburger.addEventListener('click', () => {
      const isOpen = mobileNav.classList.contains('open');
      mobileNav.classList.toggle('open', !isOpen);
      hamburgerIcon.textContent = isOpen ? 'menu' : 'close';
      hamburger.setAttribute('aria-expanded', String(!isOpen));
    });

    // Close mobile nav on outside click
    document.addEventListener('click', (e) => {
      if (!hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
        mobileNav.classList.remove('open');
        hamburgerIcon.textContent = 'menu';
        hamburger.setAttribute('aria-expanded', 'false');
      }
    });
  </script>

</body>
</html>
