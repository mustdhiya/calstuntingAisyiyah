<!DOCTYPE html>
<html lang="id" data-theme="light">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      SiCegah Stunting — Deteksi Dini, Edukasi Gizi, dan Pencegahan Stunting
    </title>
    <meta
      name="description"
      content="SiCegah Stunting adalah platform edukasi dan kalkulator risiko stunting untuk masyarakat, ibu, dan kader kesehatan Aisyiyah Kalimantan Timur."
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- tailwind.config -->
    <script src="{{ asset('js/user/home-config.js') }}"></script>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user/home.css') }}" />
  </head>
  <body>
    <!-- Skip nav -->
    <a
      href="#konten"
      class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] bg-white text-emerald-700 font-semibold px-4 py-2 rounded-lg shadow-lg text-sm"
    >
      Lewati ke konten utama
    </a>

    <!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
    <header class="navbar-custom sticky top-0 z-50">
      <div class="container h-full flex items-center justify-between gap-4">
        <!-- Logo -->
        <a
          href="{{ route('home') }}"
          class="flex items-center gap-3 flex-shrink-0"
          aria-label="SiCegah Stunting Beranda"
        >
          <div
            class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-sm flex-shrink-0"
          >
            <span class="material-symbols-rounded text-xl"
              >health_and_safety</span
            >
          </div>
          <div class="leading-tight">
            <div class="font-bold text-[15px] text-emerald-700 leading-none">
              SiCegah Stunting
            </div>
            <div class="text-[11px] text-slate-400 mt-0.5">
              Edukasi &amp; Skrining Awal
            </div>
          </div>
        </a>

        <!-- Desktop nav -->
        <nav
          class="hidden lg:flex items-center gap-1"
          aria-label="Navigasi utama"
        >
          <a href="{{ route('home') }}" class="nav-link active">Beranda</a>
          <a href="{{ route('kalkulator') }}" class="nav-link">Kalkulator</a>
          <a href="{{ route('edukasi') }}" class="nav-link">Edukasi</a>
          <a href="{{ url('/tentang') }}" class="nav-link">Tentang</a>
          <a href="{{ url('/faq') }}" class="nav-link">FAQ</a>
          <a href="{{ url('/kontak') }}" class="nav-link">Kontak</a>
        </nav>

        <!-- CTA + Mobile button -->
        <div class="flex items-center gap-2">
          @guest
            <a href="{{ route('login') }}" class="btn-hero-primary bg-white text-emerald-700 border border-emerald-600 hover:bg-emerald-50 text-sm !py-2.5 !px-5 hidden sm:inline-flex" style="background:#fff; color:#047857; border: 1.5px solid #059669; box-shadow:none;">
              <span class="material-symbols-rounded text-[18px]">login</span>
              Masuk
            </a>
          @endguest

          @auth
            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-600 bg-slate-100 px-3 py-2 rounded-full font-medium">
              <span class="material-symbols-rounded text-sm text-emerald-600">account_circle</span>
              <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
            </div>
            @if(Auth::user()->isAdminWilayah())
              <a href="{{ route('admin.dashboard') }}" class="btn-hero-primary text-sm !py-2.5 !px-5 hidden sm:inline-flex bg-slate-800 hover:bg-slate-900 border-none">
                <span class="material-symbols-rounded text-[18px]">dashboard</span>
                Dashboard
              </a>
            @endif
            @if(!Auth::user()->isAdminWilayah())
              <form action="{{ route('logout') }}" method="POST" class="hidden sm:inline">
                @csrf
                <button type="submit" class="btn-hero-primary bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 text-sm !py-2.5 !px-4 inline-flex items-center gap-1.5" style="background:#fef2f2; color:#dc2626; border:1px solid #fee2e2; box-shadow:none;">
                  <span class="material-symbols-rounded text-[18px]">logout</span>
                  Keluar
                </button>
              </form>
            @endif
          @endauth

          <a
            href="{{ route('kalkulator') }}"
            class="btn-hero-primary text-sm !py-2.5 !px-5 hidden sm:inline-flex"
          >
            <span class="material-symbols-rounded text-[18px]">calculate</span>
            Mulai Analisis
          </a>
          <!-- Mobile hamburger -->
          <button
            id="hamburger-btn"
            class="lg:hidden p-2 rounded-xl hover:bg-gray-100 transition-colors"
            aria-label="Buka menu"
            aria-expanded="false"
            aria-controls="mobile-menu"
          >
            <span
              class="material-symbols-rounded text-slate-600"
              id="hamburger-icon"
              >menu</span
            >
          </button>
        </div>
      </div>

      <!-- Mobile drawer -->
      <div
        id="mobile-menu"
        class="absolute top-full left-0 right-0 bg-white border-t border-slate-100 shadow-lg"
      >
        <nav
          class="container py-3 flex flex-col gap-0.5"
          aria-label="Navigasi mobile"
        >
          @auth
            <div class="px-4 py-2 mb-1 bg-slate-50 rounded-xl flex items-center gap-2">
              <span class="material-symbols-rounded text-emerald-600">account_circle</span>
              <div>
                <div class="text-xs text-slate-400">Masuk sebagai:</div>
                <div class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</div>
              </div>
            </div>
          @endauth

          <a
            href="{{ route('home') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >home</span
            >Beranda
          </a>
          <a
            href="{{ route('kalkulator') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >calculate</span
            >Kalkulator
          </a>
          <a
            href="{{ route('edukasi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >library_books</span
            >Edukasi
          </a>
          <a
            href="{{ url('/tentang') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >info</span
            >Tentang
          </a>
          <a
            href="{{ url('/faq') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >help</span
            >FAQ
          </a>
          <a
            href="{{ url('/kontak') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors"
          >
            <span class="material-symbols-rounded text-base text-slate-400"
              >mail</span
            >Kontak
          </a>

          @guest
            <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-700 hover:bg-emerald-50 transition-colors">
              <span class="material-symbols-rounded text-base">login</span>Masuk Akun
            </a>
          @endguest

          @auth
            @if(Auth::user()->isAdminWilayah())
              <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                <span class="material-symbols-rounded text-base text-slate-500">dashboard</span>Dashboard Admin
              </a>
            @endif
            @if(!Auth::user()->isAdminWilayah())
              <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
                  <span class="material-symbols-rounded text-base text-red-400">logout</span>Keluar Sistem
                </button>
              </form>
            @endif
          @endauth

          <div class="px-4 pt-2 pb-3">
            <a
              href="{{ route('kalkulator') }}"
              class="btn-hero-primary w-full justify-center text-sm !py-3"
            >
              <span class="material-symbols-rounded text-[18px]"
                >calculate</span
              >
              Mulai Analisis Sekarang
            </a>
          </div>
        </nav>
      </div>
    </header>

    <!-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ -->
    <main id="konten">
      <section class="hero-section">
        <div class="container">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Copy -->
            <div class="animate-fadeup">
              <span class="pill pill-green mb-5">
                <span class="material-symbols-rounded text-[14px]"
                  >campaign</span
                >
                Aisyiyah Kalimantan Timur
              </span>
              <h1
                class="text-[36px] sm:text-[44px] font-extrabold leading-[1.15] text-slate-900 mb-5"
              >
                Deteksi Dini,<br />
                <span class="text-emerald-600">Edukasi Gizi</span>,<br />
                dan Pencegahan Stunting
              </h1>
              <p
                class="text-[16px] text-slate-500 leading-relaxed mb-8 max-w-lg"
              >
                SiCegah Stunting membantu orang tua dan kader memahami risiko
                stunting, mengenali faktor pemicu, dan mendapatkan rekomendasi
                awal berbasis standar WHO dan Kemenkes RI.
              </p>

              <!-- CTA Buttons -->
              <div class="flex flex-col sm:flex-row gap-3 mb-8">
                <a href="{{ route('kalkulator') }}" class="btn-hero-primary">
                  <span class="material-symbols-rounded text-[20px]"
                    >calculate</span
                  >
                  Cek Risiko Stunting
                </a>
                <a href="{{ route('edukasi') }}" class="btn-hero-secondary">
                  <span class="material-symbols-rounded text-[20px]"
                    >menu_book</span
                  >
                  Baca Edukasi
                </a>
              </div>

              <!-- Trust badges -->
              <div class="flex flex-wrap gap-2">
                <span class="pill pill-green"
                  ><span class="material-symbols-rounded text-[13px]"
                    >verified</span
                  >Standar WHO</span
                >
                <span class="pill pill-blue"
                  ><span class="material-symbols-rounded text-[13px]"
                    >responsive_layout</span
                  >Mobile first</span
                >
                <span class="pill pill-amber"
                  ><span class="material-symbols-rounded text-[13px]">lock</span
                  >Gratis & aman</span
                >
              </div>
            </div>

            <!-- Visual card -->
            <div class="animate-fadeup delay-200">
              <div class="hero-card">
                <!-- Card header -->
                <div
                  class="bg-gradient-to-r from-emerald-600 to-teal-500 p-6 text-white"
                >
                  <div class="flex items-center gap-3 mb-4">
                    <div
                      class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center"
                    >
                      <span class="material-symbols-rounded text-xl"
                        >child_care</span
                      >
                    </div>
                    <div>
                      <p class="font-bold text-[15px]">
                        Skrining Awal Stunting
                      </p>
                      <p class="text-emerald-100 text-[12px]">
                        Berbasis standar WHO 0–59 bulan
                      </p>
                    </div>
                  </div>
                  <!-- Mini progress visual -->
                  <!-- <div class="flex items-center gap-2">
                    <div class="flex-1 h-2 bg-white/20 rounded-full overflow-hidden">
                      <div class="h-full bg-white rounded-full" style="width:72%"></div>
                    </div>
                    <span class="text-sm font-semibold">72% normal</span>
                  </div> -->
                </div>
                <!-- Card body -->
                <div class="p-6">
                  <p
                    class="text-[12px] font-semibold text-slate-400 uppercase tracking-wider mb-4"
                  >
                    Indikator utama
                  </p>
                  <div class="space-y-3 mb-5">
                    <div
                      class="flex items-center justify-between py-2 border-b border-slate-50"
                    >
                      <div
                        class="flex items-center gap-2 text-sm text-slate-600"
                      >
                        <span
                          class="material-symbols-rounded text-[16px] text-emerald-500"
                          >height</span
                        >
                        TB/U (Tinggi/Usia)
                      </div>
                      <span class="pill pill-green text-[11px] !py-1 !px-3"
                        >Normal</span
                      >
                    </div>
                    <div
                      class="flex items-center justify-between py-2 border-b border-slate-50"
                    >
                      <div
                        class="flex items-center gap-2 text-sm text-slate-600"
                      >
                        <span
                          class="material-symbols-rounded text-[16px] text-blue-500"
                          >monitor_weight</span
                        >
                        BB/U (Berat/Usia)
                      </div>
                      <span class="pill pill-blue text-[11px] !py-1 !px-3"
                        >Normal</span
                      >
                    </div>
                    <div class="flex items-center justify-between py-2">
                      <div
                        class="flex items-center gap-2 text-sm text-slate-600"
                      >
                        <span
                          class="material-symbols-rounded text-[16px] text-amber-500"
                          >straighten</span
                        >
                        BB/TB (Berat/Tinggi)
                      </div>
                      <span class="pill pill-amber text-[11px] !py-1 !px-3"
                        >Perhatian</span
                      >
                    </div>
                  </div>
                  <!-- Quick stats -->
                  <div class="grid grid-cols-2 gap-3">
                    <div class="hero-card-stat">
                      <p class="text-[11px] text-slate-400 font-medium mb-1">
                        Durasi skrining
                      </p>
                      <p class="text-xl font-extrabold text-emerald-600">
                        3 Menit
                      </p>
                    </div>
                    <div class="hero-card-stat">
                      <p class="text-[11px] text-slate-400 font-medium mb-1">
                        Bahasa
                      </p>
                      <p class="text-xl font-extrabold text-sky-600">Mudah</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     STATS STRIP
══════════════════════════════════════ -->
      <!-- <div class="stats-strip">
        <div class="container">
          <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-white/20">
            <div class="stat-item">
              <p class="text-2xl sm:text-3xl font-extrabold text-white">21,5%</p>
              <p class="text-[12px] text-emerald-100 mt-1 leading-snug">Prevalensi nasional<br/>2023</p>
            </div>
            <div class="stat-item">
              <p class="text-2xl sm:text-3xl font-extrabold text-white">27%</p>
              <p class="text-[12px] text-emerald-100 mt-1 leading-snug">Prevalensi Kaltim</p>
            </div>
            <div class="stat-item">
              <p class="text-2xl sm:text-3xl font-extrabold text-white">1000</p>
              <p class="text-[12px] text-emerald-100 mt-1 leading-snug">Hari pertama<br/>kehidupan kritis</p>
            </div>
            <div class="stat-item">
              <p class="text-2xl sm:text-3xl font-extrabold text-white">&lt;-2 SD</p>
              <p class="text-[12px] text-emerald-100 mt-1 leading-snug">Batas stunting<br/>standar WHO</p>
            </div>
          </div>
        </div>
      </div> -->

      <!-- ══════════════════════════════════════
     APA ITU STUNTING
══════════════════════════════════════ -->
      <section class="section bg-white">
        <div class="container">
          <div class="max-w-2xl mx-auto text-center mb-12">
            <p class="section-label">
              <span class="material-symbols-rounded text-[16px]">info</span>
              Dasar Pemahaman
            </p>
            <h2
              class="text-[28px] sm:text-[34px] font-bold text-slate-900 mb-4"
            >
              Apa itu Stunting?
            </h2>
            <p class="text-slate-500 text-[15px] leading-relaxed">
              Stunting adalah gangguan pertumbuhan anak akibat kekurangan gizi
              kronis dan infeksi berulang, ditandai dengan tinggi badan di bawah
              <strong>−2 SD</strong> berdasarkan standar WHO. Kondisi ini paling
              kritis terjadi pada 1000 Hari Pertama Kehidupan.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="card-clean">
              <div class="icon-box icon-box-red mb-5">
                <span class="material-symbols-rounded text-[22px]">height</span>
              </div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Gangguan tumbuh kembang
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Tinggi badan anak tidak sesuai usia. Diukur dengan z-score TB/U
                yang berada di bawah −2 standar deviasi menurut referensi WHO.
              </p>
            </div>
            <div class="card-clean">
              <div class="icon-box icon-box-blue mb-5">
                <span class="material-symbols-rounded text-[22px]"
                  >neurology</span
                >
              </div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Dampak jangka panjang
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Berpengaruh pada kecerdasan, daya tahan tubuh, dan produktivitas
                anak hingga dewasa bila tidak ditangani sejak dini.
              </p>
            </div>
            <div class="card-clean">
              <div class="icon-box icon-box-green mb-5">
                <span class="material-symbols-rounded text-[22px]"
                  >shield_person</span
                >
              </div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Dapat dicegah
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Pencegahan dilakukan melalui pemenuhan gizi, ASI eksklusif,
                pemantauan rutin Posyandu, sanitasi baik, dan akses layanan
                kesehatan.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     DAMPAK (4 KOLOM)
══════════════════════════════════════ -->
      <section class="section-sm" style="background: #f8fafc">
        <div class="container">
          <div class="max-w-2xl mx-auto text-center mb-10">
            <p class="section-label">
              <span class="material-symbols-rounded text-[16px]">warning</span>
              Kenapa Penting?
            </p>
            <h2
              class="text-[28px] sm:text-[32px] font-bold text-slate-900 mb-3"
            >
              Dampak Stunting yang Perlu Dipahami
            </h2>
            <p class="text-slate-500 text-[14px] leading-relaxed">
              Bukan sekadar soal tinggi badan — stunting mempengaruhi otak,
              imun, dan masa depan anak.
            </p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-purple flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >psychology</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Kognitif
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Risiko hambatan belajar dan konsentrasi meningkat secara
                  signifikan.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-red flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >coronavirus</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Daya tahan tubuh
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Anak lebih rentan terhadap infeksi berulang dan penyakit.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-amber flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >trending_up</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Produktivitas
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Dampak jangka panjang menurunkan kualitas hidup saat dewasa.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-blue flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >favorite</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Kesehatan berkelanjutan
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Risiko masalah gizi dapat berlanjut bila tidak ditangani sejak
                  dini.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     CARA KERJA KALKULATOR
══════════════════════════════════════ -->
      <section class="section bg-white">
        <div class="container">
          <div class="max-w-2xl mx-auto text-center mb-12">
            <p class="section-label">
              <span class="material-symbols-rounded text-[16px]"
                >play_circle</span
              >
              Mudah digunakan
            </p>
            <h2
              class="text-[28px] sm:text-[34px] font-bold text-slate-900 mb-3"
            >
              Cara Kerja Kalkulator
            </h2>
            <p class="text-slate-500 text-[14px] leading-relaxed">
              Alur penggunaan dibuat sesederhana mungkin agar dapat dipakai oleh
              orang tua maupun kader kesehatan tanpa pelatihan khusus.
            </p>
          </div>

          <!-- Steps -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="card-clean text-center">
              <div class="step-num mx-auto mb-4">1</div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Isi Data Anak
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Masukkan nama, usia (bulan), jenis kelamin, tinggi badan, dan
                berat badan anak.
              </p>
              <div class="mt-4 flex flex-wrap gap-2 justify-center">
                <span class="pill pill-green text-[11px]"
                  ><span class="material-symbols-rounded text-[12px]">cake</span>Usia</span>
                <span class="pill pill-blue text-[11px]"
                  ><span class="material-symbols-rounded text-[12px]"
                    >height</span
                  >TB &amp; BB</span>
              </div>
            </div>
            <div class="card-clean text-center">
              <div class="step-num mx-auto mb-4">2</div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Pilih Tempat Tinggal
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Lengkapi wilayah tempat tinggal anak di Kalimantan Timur untuk membantu pemetaan kasus stunting.
              </p>
              <div class="mt-4 flex flex-wrap gap-2 justify-center">
                <span class="pill pill-amber text-[11px]"
                  ><span class="material-symbols-rounded text-[12px]"
                    >location_on</span
                  >Lokasi</span>
              </div>
            </div>
            <div class="card-clean text-center">
              <div class="step-num mx-auto mb-4">3</div>
              <h3 class="font-bold text-[15px] text-slate-800 mb-2">
                Terima Rekomendasi
              </h3>
              <p class="text-slate-500 text-[14px] leading-relaxed">
                Sistem menampilkan tingkat risiko, z-score indikator, dan saran
                tindakan awal yang mudah dipahami.
              </p>
              <div class="mt-4 flex flex-wrap gap-2 justify-center">
                <span class="pill pill-green text-[11px]"
                  ><span class="material-symbols-rounded text-[12px]"
                    >recommend</span
                  >Saran</span>
              </div>
            </div>
          </div>

          <div class="text-center mt-10">
            <a href="{{ route('kalkulator') }}" class="btn-hero-primary inline-flex">
              <span class="material-symbols-rounded text-[20px]"
                >play_arrow</span
              >
              Mulai Sekarang — Gratis
            </a>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     FITUR UTAMA
══════════════════════════════════════ -->
      <section class="section-sm" style="background: #f8fafc">
        <div class="container">
          <div class="max-w-2xl mx-auto text-center mb-10">
            <p class="section-label">
              <span class="material-symbols-rounded text-[16px]">star</span>
              Yang tersedia
            </p>
            <h2
              class="text-[28px] sm:text-[32px] font-bold text-slate-900 mb-3"
            >
              Fitur Utama Website
            </h2>
            <p class="text-slate-500 text-[14px]">
              Dirancang untuk kebutuhan penelitian, pengabdian masyarakat, dan
              presentasi akademik.
            </p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-green flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >calculate</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Kalkulator Risiko
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Skrining awal berbasis z-score WHO dengan antarmuka responsif.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-blue flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >library_books</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Edukasi Digital
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Artikel gizi, ASI eksklusif, MPASI, dan tips pencegahan
                  stunting.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-amber flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >support_agent</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Ramah Kader
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  Bahasa formal namun mudah dipahami masyarakat dan kader.
                </p>
              </div>
            </div>
            <div class="card-flat flex gap-4 items-start">
              <div class="icon-box icon-box-purple flex-shrink-0">
                <span class="material-symbols-rounded text-[20px]"
                  >devices</span
                >
              </div>
              <div>
                <h3 class="font-semibold text-[14px] text-slate-800 mb-1">
                  Siap Integrasi
                </h3>
                <p class="text-slate-500 text-[13px] leading-relaxed">
                  HTML semantik, mudah diadaptasi ke Django Templates + MySQL.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     CTA BANNER
══════════════════════════════════════ -->
      <section class="section-sm">
        <div class="container">
          <div
            class="cta-banner px-6 sm:px-12 py-14 text-center text-white relative"
          >
            <div class="relative z-10">
              <span
                class="material-symbols-rounded text-[48px] mb-4 block opacity-90"
                >child_friendly</span
              >
              <h2 class="text-[28px] sm:text-[36px] font-extrabold mb-4">
                Mulai Skrining Awal Sekarang
              </h2>
              <p
                class="text-emerald-100 text-[15px] leading-relaxed max-w-xl mx-auto mb-8"
              >
                Gunakan kalkulator kami untuk melihat hasil analisis risiko
                stunting secara gratis. Hanya 3 menit, tanpa perlu mendaftar.
              </p>
              <div
                class="flex flex-col sm:flex-row gap-3 justify-center items-center"
              >
                <a href="{{ route('kalkulator') }}" class="btn-white">
                  <span class="material-symbols-rounded text-[20px]"
                    >calculate</span
                  >
                  Buka Kalkulator
                </a>
                <a
                  href="{{ route('edukasi') }}"
                  style="color: #d1fae5; border-color: rgba(255, 255, 255, 0.4)"
                  class="btn-hero-secondary !bg-transparent hover:!bg-white/10"
                >
                  <span class="material-symbols-rounded text-[18px]"
                    >menu_book</span
                  >
                  Baca Edukasi
                </a>
              </div>
              <p
                class="text-emerald-200 text-[12px] mt-5 flex items-center justify-center gap-1.5"
              >
                <span class="material-symbols-rounded text-[14px]">lock</span>
                Gratis · Tanpa daftar · Data tidak disimpan
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     ARTIKEL TERBARU
══════════════════════════════════════ -->
      <section class="section bg-white">
        <div class="container">
          <div class="flex items-end justify-between gap-4 mb-10 flex-wrap">
            <div>
              <p class="section-label">
                <span class="material-symbols-rounded text-[16px]"
                  >article</span
                >
                Literasi digital
              </p>
              <h2 class="text-[28px] sm:text-[34px] font-bold text-slate-900">
                Artikel Terbaru
              </h2>
              <p class="text-slate-500 text-[14px] mt-2">
                Konten edukasi untuk masyarakat, orang tua, dan kader kesehatan.
              </p>
            </div>
            <a href="{{ route('edukasi') }}" class="btn-outline-primary">
              Lihat Semua
              <span class="material-symbols-rounded text-[18px]"
                >arrow_forward</span
              >
            </a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @forelse($latestArticles as $article)
              @php
                $categoryThemes = [
                    'Gizi Anak'           => ['icon' => 'restaurant',     'bg' => 'bg-emerald-50',  'iconColor' => 'text-emerald-400',  'badge' => 'pill-green'],
                    'ASI Eksklusif'       => ['icon' => 'child_care',     'bg' => 'bg-sky-50',      'iconColor' => 'text-sky-400',      'badge' => 'pill-blue'],
                    'MPASI'               => ['icon' => 'lunch_dining',    'bg' => 'bg-amber-50',    'iconColor' => 'text-amber-400',    'badge' => 'pill-amber'],
                    'Pencegahan Stunting' => ['icon' => 'shield_with_heart','bg' => 'bg-indigo-50',   'iconColor' => 'text-indigo-400',   'badge' => 'pill-indigo'],
                    'Kesehatan Ibu'       => ['icon' => 'pregnant_woman',  'bg' => 'bg-pink-50',     'iconColor' => 'text-pink-400',     'badge' => 'pill-pink'],
                    'FAQ'                 => ['icon' => 'help',           'bg' => 'bg-purple-50',   'iconColor' => 'text-purple-400',   'badge' => 'pill-purple'],
                ];
                $theme = $categoryThemes[$article->category] ?? ['icon' => 'article', 'bg' => 'bg-slate-50', 'iconColor' => 'text-slate-400', 'badge' => 'pill-gray'];
              @endphp
              <article class="article-card flex flex-col justify-between h-full bg-white border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="article-thumb h-48 overflow-hidden relative">
                  @if($article->image)
                    <img src="{{ Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="object-cover w-full h-full transition-transform duration-300 hover:scale-105" />
                  @else
                    <div class="w-full h-full {{ $theme['bg'] }} flex items-center justify-center">
                      <span class="material-symbols-rounded text-[56px] {{ $theme['iconColor'] }}">{{ $theme['icon'] }}</span>
                    </div>
                  @endif
                </div>
                <div class="article-body p-6 flex flex-col justify-between flex-grow">
                  <div>
                    <span class="pill {{ $theme['badge'] }} text-[11px] mb-3 inline-block">{{ $article->category }}</span>
                    <h3 class="font-bold text-[15px] text-slate-800 leading-snug mb-2 hover:text-emerald-700">
                      <a href="{{ route('artikel.detail', $article->slug) }}">
                        {{ $article->title }}
                      </a>
                    </h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed flex-1 mb-4 line-clamp-2">
                      {{ $article->summary ?? Str::limit(strip_tags($article->content), 100) }}
                    </p>
                  </div>
                  <div class="flex items-center justify-between pt-3 border-t border-slate-50 mt-auto">
                    <span class="text-[12px] text-slate-400 flex items-center gap-1">
                      <span class="material-symbols-rounded text-[13px]">calendar_today</span>
                      {{ $article->published_date ? $article->published_date->format('d M Y') : $article->created_at->format('d M Y') }}
                    </span>
                    <a href="{{ route('artikel.detail', $article->slug) }}" class="text-[13px] font-semibold text-emerald-600 hover:underline flex items-center gap-0.5">
                      Baca <span class="material-symbols-rounded text-[16px]">arrow_forward</span>
                    </a>
                  </div>
                </div>
              </article>
            @empty
              <div class="col-span-full text-center py-10 text-slate-400 text-sm">
                Belum ada artikel edukasi yang dipublikasikan.
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- ══════════════════════════════════════
     FAQ
══════════════════════════════════════ -->
      <section class="section-sm" style="background: #f8fafc">
        <div class="container">
          <div class="max-w-2xl mx-auto text-center mb-10">
            <p class="section-label">
              <span class="material-symbols-rounded text-[16px]">help</span>
              Pertanyaan umum
            </p>
            <h2
              class="text-[28px] sm:text-[32px] font-bold text-slate-900 mb-3"
            >
              Pertanyaan yang Sering Diajukan
            </h2>
            <p class="text-slate-500 text-[14px]">
              Ringkasan FAQ untuk membantu memahami fungsi dan batas website
              ini.
            </p>
          </div>

          <div class="max-w-3xl mx-auto space-y-3">
            <div class="faq-item">
              <button
                class="faq-btn"
                onclick="toggleFaq(this)"
                aria-expanded="true"
              >
                <span class="font-semibold text-[15px] text-slate-800"
                  >Apakah hasil kalkulator merupakan diagnosis medis?</span
                >
                <span
                  class="material-symbols-rounded faq-icon rotate text-[22px]"
                  >add</span
                >
              </button>
              <div class="faq-content open">
                <p class="text-slate-500 text-[14px] leading-relaxed">
                  Tidak. Hasil pada website ini hanya untuk
                  <strong>skrining awal dan edukasi</strong>. Pemeriksaan medis
                  dan diagnosis resmi tetap harus dilakukan oleh tenaga
                  kesehatan di fasilitas kesehatan terdekat.
                </p>
              </div>
            </div>
            <div class="faq-item">
              <button
                class="faq-btn"
                onclick="toggleFaq(this)"
                aria-expanded="false"
              >
                <span class="font-semibold text-[15px] text-slate-800"
                  >Kapan orang tua perlu membawa anak ke Puskesmas?</span
                >
                <span class="material-symbols-rounded faq-icon text-[22px]"
                  >add</span
                >
              </button>
              <div class="faq-content">
                <p class="text-slate-500 text-[14px] leading-relaxed">
                  Jika hasil skrining menunjukkan risiko sedang atau tinggi,
                  atau anak tampak mengalami masalah makan, berat badan sulit
                  naik, atau pertumbuhan tidak sesuai usia — segera periksakan
                  ke fasilitas kesehatan.
                </p>
              </div>
            </div>
            <div class="faq-item">
              <button
                class="faq-btn"
                onclick="toggleFaq(this)"
                aria-expanded="false"
              >
                <span class="font-semibold text-[15px] text-slate-800"
                  >Apa penyebab utama stunting?</span
                >
                <span class="material-symbols-rounded faq-icon text-[22px]"
                  >add</span
                >
              </button>
              <div class="faq-content">
                <p class="text-slate-500 text-[14px] leading-relaxed">
                  Penyebab utama meliputi kekurangan gizi kronis, infeksi
                  berulang, pola asuh yang kurang optimal, sanitasi lingkungan
                  buruk, dan keterbatasan akses layanan kesehatan.
                </p>
              </div>
            </div>
            <div class="faq-item">
              <button
                class="faq-btn"
                onclick="toggleFaq(this)"
                aria-expanded="false"
              >
                <span class="font-semibold text-[15px] text-slate-800"
                  >Apakah data anak saya disimpan?</span
                >
                <span class="material-symbols-rounded faq-icon text-[22px]"
                  >add</span
                >
              </button>
              <div class="faq-content">
                <p class="text-slate-500 text-[14px] leading-relaxed">
                  Data skrining awal disimpan secara lokal pada database sistem untuk keperluan pemetaan analisis stunting wilayah Kalimantan Timur oleh admin.
                </p>
              </div>
            </div>
          </div>

          <div class="text-center mt-8">
            <a href="{{ route('faq') }}" class="btn-outline-secondary">
              Baca FAQ Lengkap
              <span class="material-symbols-rounded text-[18px]"
                >arrow_forward</span
              >
            </a>
          </div>
        </div>
      </section>
    </main>

    <!-- ══════════════════════════════════════
     FOOTER
══════════════════════════════════════ -->
    <footer class="footer-main pt-14 pb-10">
      <div class="container">
        <div
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-10 border-b border-white/10"
        >
          <!-- Brand -->
          <div class="lg:col-span-2">
            <div class="flex items-center gap-3 mb-4">
              <div
                class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0"
              >
                <span class="material-symbols-rounded">health_and_safety</span>
              </div>
              <div>
                <div class="font-bold text-[16px] text-white">
                  SiCegah Stunting
                </div>
                <div class="text-[12px] text-slate-400">
                  Edukasi dan Skrining Awal
                </div>
              </div>
            </div>
            <p class="text-slate-400 text-[14px] leading-relaxed max-w-sm mb-5">
              Platform edukasi dan analisis risiko stunting untuk kader dan
              masyarakat. Dikembangkan untuk mendukung program penelitian dan
              pengabdian masyarakat Aisyiyah Kaltim.
            </p>
            <div class="flex gap-2">
              <span class="pill pill-green text-[11px]">
                <span class="material-symbols-rounded text-[12px]"
                  >verified</span
                >Standar WHO
              </span>
              <span
                class="pill text-[11px]"
                style="
                  background: rgba(255, 255, 255, 0.08);
                  color: #94a3b8;
                  border: 1px solid rgba(255, 255, 255, 0.1);
                "
              >
                <span class="material-symbols-rounded text-[12px]">science</span>Riset & Pengabmas
              </span>
            </div>
          </div>

          <!-- Nav -->
          <div>
            <h4
              class="font-semibold text-white text-[13px] uppercase tracking-wider mb-4"
            >
              Navigasi
            </h4>
            <ul class="space-y-2.5">
              <li>
                <a
                  href="{{ route('home') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >Beranda</a
                >
              </li>
              <li>
                <a
                  href="{{ route('kalkulator') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >Kalkulator</a
                >
              </li>
              <li>
                <a
                  href="{{ route('edukasi') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >Edukasi</a
                >
              </li>
              <li>
                <a
                  href="{{ url('/tentang') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >Tentang</a
                >
              </li>
              <li>
                <a
                  href="{{ url('/faq') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >FAQ</a
                >
              </li>
              <li>
                <a
                  href="{{ url('/kontak') }}"
                  class="text-slate-400 text-[14px] hover:text-white transition-colors flex items-center gap-2"
                  ><span class="material-symbols-rounded text-[14px]"
                    >chevron_right</span
                  >Kontak</a
                >
              </li>
            </ul>
          </div>

          <!-- Institusi -->
          <div>
            <h4
              class="font-semibold text-white text-[13px] uppercase tracking-wider mb-4"
            >
              Institusi
            </h4>
            <ul class="space-y-3">
              <li class="flex items-start gap-2 text-[14px] text-slate-400">
                <span
                  class="material-symbols-rounded text-[16px] text-slate-500 mt-0.5 flex-shrink-0"
                  >business</span
                >
                Pengurus Wilayah Aisyiyah<br />Kalimantan Timur
              </li>
              <li class="flex items-center gap-2 text-[14px] text-slate-400">
                <span
                  class="material-symbols-rounded text-[16px] text-slate-500 flex-shrink-0"
                  >mail</span
                >
                info@sicegahstunting.id
              </li>
              <li class="flex items-center gap-2 text-[14px] text-slate-400">
                <span
                  class="material-symbols-rounded text-[16px] text-slate-500 flex-shrink-0"
                  >phone</span
                >
                (0541) 555 123
              </li>
            </ul>
            <!-- Disclaimer -->
            <div
              class="mt-5 p-3 rounded-xl"
              style="
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.08);
              "
            >
              <p class="text-[11px] text-slate-500 leading-relaxed">
                <span
                  class="material-symbols-rounded text-[12px] align-middle text-amber-500"
                  >warning</span
                >
                Hasil bersifat indikatif. Selalu konsultasi ke tenaga kesehatan.
              </p>
            </div>
          </div>
        </div>

        <!-- Bottom bar -->
        <div
          class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3"
        >
          <p class="text-slate-500 text-[13px]">
            © {{ date('Y') }} SiCegah Stunting — Aisyiyah Kaltim. Seluruh hak cipta
            dilindungi.
          </p>
          <p class="text-slate-600 text-[12px] flex items-center gap-1.5">
            <span class="material-symbols-rounded text-[14px] text-emerald-700"
              >favorite</span
            >
            Dibuat untuk kesehatan anak Indonesia
          </p>
        </div>
      </div>
    </footer>

    <!-- ══════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════ -->
    <script src="{{ asset('js/user/home.js') }}"></script>
  </body>
</html>
