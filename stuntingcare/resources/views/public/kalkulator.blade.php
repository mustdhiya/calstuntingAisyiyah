<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kalkulator Risiko Stunting — SiCegah Stunting</title>
  <meta name="description" content="Kalkulator skrining awal risiko stunting berbasis standar WHO untuk kader dan masyarakat." />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

  <!-- DaisyUI + Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Choices.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: {
            brand: { 50:'#f0fdf4', 100:'#dcfce7', 200:'#bbf7d0', 500:'#22c55e', 600:'#16a34a', 700:'#15803d', 800:'#166534' }
          }
        }
      }
    }
  </script>

  <style>
    body { font-family: 'Inter', sans-serif; }

    .material-symbols-rounded {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      vertical-align: middle;
      line-height: 1;
    }

    /* Step indicator custom */
    .step-item { display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; position: relative; }
    .step-item:not(:last-child)::after {
      content: '';
      position: absolute;
      top: 18px;
      left: calc(50% + 18px);
      right: calc(-50% + 18px);
      height: 2px;
      background: #e2e8f0;
      z-index: 0;
    }
    .step-item.done::after { background: #16a34a; }
    .step-item.active::after { background: linear-gradient(90deg, #16a34a 50%, #e2e8f0 50%); }

    .step-circle {
      width: 36px; height: 36px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 700;
      position: relative; z-index: 1;
      border: 2px solid #e2e8f0;
      background: #fff;
      color: #94a3b8;
      transition: all 0.25s;
    }
    .step-item.done .step-circle { background: #16a34a; border-color: #16a34a; color: #fff; }
    .step-item.active .step-circle { background: #fff; border-color: #16a34a; color: #16a34a; box-shadow: 0 0 0 4px #dcfce7; }
    .step-label { font-size: 11px; font-weight: 500; color: #94a3b8; text-align: center; }
    .step-item.done .step-label { color: #16a34a; }
    .step-item.active .step-label { color: #15803d; font-weight: 600; }

    /* Input focus ring */
    .input:focus, .select:focus { outline: none; border-color: #16a34a; box-shadow: 0 0 0 3px #dcfce7; }

    /* Radio card */
    .radio-card input[type=radio] { display: none; }
    .radio-card input[type=radio]:checked + .rc-box { border-color: #16a34a; background: #f0fdf4; }
    .radio-card input[type=radio]:checked + .rc-box .rc-icon { color: #16a34a; }
    .radio-card input[type=radio]:checked + .rc-box .rc-label { color: #15803d; font-weight: 600; }
    .rc-box {
      border: 2px solid #e2e8f0; border-radius: 14px;
      padding: 14px 10px; cursor: pointer;
      display: flex; flex-direction: column; align-items: center; gap: 6px;
      transition: all 0.2s; background: #fff;
    }
    .rc-box:hover { border-color: #bbf7d0; background: #f0fdf4; }
    .rc-icon { font-size: 28px; color: #94a3b8; transition: color 0.2s; }
    .rc-label { font-size: 13px; font-weight: 500; color: #64748b; transition: color 0.2s; }

    /* Floating unit badge inside input */
    .input-unit-wrap { position: relative; }
    .input-unit-wrap .unit-badge {
      position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
      font-size: 12px; font-weight: 600; color: #94a3b8;
      background: #f1f5f9; border-radius: 6px; padding: 2px 7px;
      pointer-events: none;
    }
    .input-unit-wrap input { padding-right: 52px; }

    /* Section card: HATI-HATI di sini supaya dropdown tidak ke-scroll di dalam card */
    .form-section {
      background: #fff;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      /* jangan pakai overflow: hidden; supaya dropdown boleh keluar */
      overflow: visible;
      position: relative; /* agar dropdown absolute bisa refer ke card */
    }
    .form-section-header { padding: 22px 28px 0; }
    .form-section-body { padding: 20px 28px 28px; }

    /* Sidebar card */
    .info-card { border-radius: 18px; padding: 20px; }

    /* Submit button pulse */
    @keyframes subtlePulse { 0%,100%{box-shadow:0 0 0 0 #16a34a33} 50%{box-shadow:0 0 0 8px #16a34a00} }
    .btn-submit-pulse { animation: subtlePulse 2.5s infinite; }

    /* Smooth scroll */
    html { scroll-behavior: smooth; }

    /* === Choices.js + dropdown mengambang di luar card === */

    /* wrapper supaya z-index cukup tinggi */
    .choices {
      width: 100%;
      z-index: 10;   /* di atas isi card */
      position: relative;
    }

    .choices__inner {
      border-radius: 0.75rem;
      border-color: #e2e8f0;
      min-height: 2.75rem;
      font-size: 0.875rem;
    }
    .choices__inner.is-focused,
    .is-open .choices__inner {
      border-color: #16a34a;
      box-shadow: 0 0 0 3px #dcfce7;
    }

    .choices__list--dropdown {
      position: absolute;       /* mengambang di bawah input */
      top: 100%;
      left: 0;
      right: 0;
      margin-top: 4px;
      z-index: 50;              /* di atas card dan disclaimer */
      max-height: 240px;
      overflow-y: auto;
      border-radius: 0.75rem;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.25);
    }

    .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background-color: #f0fdf4;
      color: #15803d;
    }
  </style>
</head>

<body class="bg-slate-50 min-h-screen text-slate-800">

<!-- ═════════════════ NAVBAR ═════════════════ -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-100">
  <nav class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center gap-2.5 select-none">
      <div class="w-9 h-9 rounded-xl bg-green-600 flex items-center justify-center shadow-sm">
        <span class="material-symbols-rounded text-white text-xl">health_and_safety</span>
      </div>
      <div class="leading-tight">
        <div class="font-extrabold text-green-700 text-sm">SiCegah Stunting</div>
        <div class="text-xs text-slate-400 font-normal">Edukasi &amp; Skrining Awal</div>
      </div>
    </a>

    <!-- Desktop nav -->
    <div class="hidden lg:flex items-center gap-1">
      <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 hover:text-green-700 transition-colors">Beranda</a>
      <a href="{{ route('kalkulator') }}" class="px-3 py-2 rounded-lg text-sm text-green-700 font-semibold bg-green-50">Kalkulator</a>
      <a href="{{ route('edukasi') }}" class="px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 hover:text-green-700 transition-colors">Edukasi</a>
      <a href="{{ url('/tentang') }}" class="px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 hover:text-green-700 transition-colors">Tentang</a>
      <a href="{{ url('/faq') }}" class="px-3 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-50 hover:text-green-700 transition-colors">FAQ</a>
    </div>

    <div class="hidden lg:flex items-center gap-2">
      <a href="{{ route('hasil') }}" class="flex items-center gap-1.5 px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-full hover:bg-green-700 transition-colors shadow-sm">
        <span class="material-symbols-rounded text-base">bar_chart</span>
        Contoh Hasil
      </a>
    </div>

    <!-- Mobile toggle -->
    <button id="nav-toggle" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
      <span class="material-symbols-rounded text-slate-600" id="nav-icon">menu</span>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div id="nav-mobile" class="hidden lg:hidden border-t border-slate-100 bg-white px-4 pb-4">
    <div class="flex flex-col gap-1 pt-2">
      <a href="{{ url('/') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-slate-700 hover:bg-slate-50"><span class="material-symbols-rounded text-base text-slate-400">home</span>Beranda</a>
      <a href="{{ route('kalkulator') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-green-700 font-semibold bg-green-50"><span class="material-symbols-rounded text-base">calculate</span>Kalkulator</a>
      <a href="{{ route('edukasi') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-slate-700 hover:bg-slate-50"><span class="material-symbols-rounded text-base text-slate-400">menu_book</span>Edukasi</a>
      <a href="{{ url('/tentang') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-slate-700 hover:bg-slate-50"><span class="material-symbols-rounded text-base text-slate-400">info</span>Tentang</a>
      <a href="{{ url('/faq') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-slate-700 hover:bg-slate-50"><span class="material-symbols-rounded text-base text-slate-400">help</span>FAQ</a>
    </div>
  </div>
</header>


<!-- ═════════════════ MAIN ═════════════════ -->
<main class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

  <!-- Page header -->
  <div class="mb-8">
    <div class="flex items-center gap-2 mb-3">
      <a href="{{ url('/') }}" class="text-slate-400 hover:text-green-600 transition-colors">
        <span class="material-symbols-rounded text-xl">arrow_back</span>
      </a>
      <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-700 bg-green-50 border border-green-100 px-3 py-1.5 rounded-full">
        <span class="material-symbols-rounded text-sm">calculate</span>
        Kalkulator Risiko Stunting
      </span>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2">Skrining Awal Risiko Stunting</h1>
    <p class="text-slate-500 text-sm sm:text-base max-w-2xl leading-relaxed">
      Isi data anak dan lokasi di Kalimantan di bawah ini untuk mendapatkan gambaran awal risiko stunting berdasarkan standar pertumbuhan WHO.
    </p>
  </div>

  <!-- STEP indicator -->
  <div class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 mb-6 shadow-sm">
    <div class="flex items-start" id="step-tracker">
      <div class="step-item done" id="si-1">
        <div class="step-circle"><span class="material-symbols-rounded text-sm">check</span></div>
        <span class="step-label">Data Anak</span>
      </div>
      <div class="step-item active" id="si-2">
        <div class="step-circle">2</div>
        <span class="step-label">Lokasi di Kalimantan</span>
      </div>
      <div class="step-item" id="si-3">
        <div class="step-circle">3</div>
        <span class="step-label">Analisis</span>
      </div>
      <div class="step-item" id="si-4">
        <div class="step-circle">4</div>
        <span class="step-label">Rekomendasi</span>
      </div>
    </div>
  </div>

  <!-- GRID layout -->
  <form id="kalkulator-form" action="{{ route('kalkulator.hitung') }}" method="POST" novalidate>
    @csrf
    <div class="grid lg:grid-cols-3 gap-6 items-start">

      <!-- LEFT: form -->
      <div class="lg:col-span-2 space-y-5">

        <!-- SECTION 1: Data Anak -->
        <div class="form-section shadow-sm">
          <div class="form-section-header flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-green-600">child_care</span>
              </div>
              <div>
                <h2 class="font-bold text-slate-800 text-base">Data Anak</h2>
                <p class="text-xs text-slate-400 mt-0.5">Berdasarkan pengukuran terbaru</p>
              </div>
            </div>
            <span class="text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full border border-green-100">Wajib</span>
          </div>

          <div class="form-section-body space-y-5">

            <!-- Nama Anak -->
            <div class="form-control">
              <label class="label pb-1.5">
                <span class="label-text font-semibold text-slate-700 text-sm">Nama Anak</span>
                <span class="label-text-alt text-slate-400 text-xs">Opsional</span>
              </label>
              <div class="relative">
                <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xl pointer-events-none">person</span>
                <input type="text" name="nama_anak" placeholder="Contoh: Aulia Rahma"
                       value="{{ old('nama_anak', 'Aulia Rahma') }}"
                       class="input input-bordered w-full pl-10 focus:border-green-500 text-sm" />
              </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-control">
              <label class="label pb-1.5">
                <span class="label-text font-semibold text-slate-700 text-sm flex items-center gap-1">
                  Jenis Kelamin <span class="text-red-400">*</span>
                </span>
              </label>
              <div class="grid grid-cols-2 gap-3">
                <label class="radio-card">
                  <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') === 'L' ? 'checked' : '' }} />
                  <div class="rc-box">
                    <span class="rc-icon material-symbols-rounded">boy</span>
                    <span class="rc-label">Laki-laki</span>
                  </div>
                </label>
                <label class="radio-card">
                  <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', 'P') === 'P' ? 'checked' : '' }} />
                  <div class="rc-box">
                    <span class="rc-icon material-symbols-rounded">girl</span>
                    <span class="rc-label">Perempuan</span>
                  </div>
                </label>
              </div>
            </div>

            <!-- Usia + Tanggal lahir -->
            <div class="grid sm:grid-cols-2 gap-4">
              <div class="form-control">
                <label class="label pb-1.5">
                  <span class="label-text font-semibold text-slate-700 text-sm flex items-center gap-1">
                    Usia <span class="text-red-400">*</span>
                  </span>
                  <span class="label-text-alt text-slate-400 text-xs">0–60 bulan</span>
                </label>
                <div class="input-unit-wrap">
                  <input type="number" name="usia_bulan" id="usia_bulan" min="0" max="60"
                         placeholder="24" value="{{ old('usia_bulan') }}"
                         class="input input-bordered w-full focus:border-green-500 text-sm" required />
                  <span class="unit-badge">bln</span>
                </div>
              </div>
              <div class="form-control">
                <label class="label pb-1.5">
                  <span class="label-text font-semibold text-slate-700 text-sm">Tanggal Lahir</span>
                  <span class="label-text-alt text-slate-400 text-xs">Otomatis hitung usia</span>
                </label>
                <input type="date" id="tgl_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                       class="input input-bordered w-full focus:border-green-500 text-sm" />
              </div>
            </div>

            <!-- TB + BB -->
            <div class="grid sm:grid-cols-2 gap-4">
              <div class="form-control">
                <label class="label pb-1.5">
                  <span class="label-text font-semibold text-slate-700 text-sm flex items-center gap-1">
                    Tinggi / Panjang Badan <span class="text-red-400">*</span>
                  </span>
                </label>
                <div class="input-unit-wrap">
                  <input type="number" name="tinggi_badan" min="40" max="130" step="0.1"
                         placeholder="80.0" value="{{ old('tinggi_badan', '80') }}"
                         class="input input-bordered w-full focus:border-green-500 text-sm" required />
                  <span class="unit-badge">cm</span>
                </div>
                <label class="label pt-1">
                  <span class="label-text-alt text-slate-400 text-xs flex items-center gap-1">
                    <span class="material-symbols-rounded text-xs">info</span>
                    Berbaring jika usia &lt; 24 bln
                  </span>
                </label>
              </div>
              <div class="form-control">
                <label class="label pb-1.5">
                  <span class="label-text font-semibold text-slate-700 text-sm flex items-center gap-1">
                    Berat Badan <span class="text-red-400">*</span>
                  </span>
                </label>
                <div class="input-unit-wrap">
                  <input type="number" name="berat_badan" min="1" max="50" step="0.1"
                         placeholder="9.2" value="{{ old('berat_badan', '9.2') }}"
                         class="input input-bordered w-full focus:border-green-500 text-sm" required />
                  <span class="unit-badge">kg</span>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- SECTION 2: Lokasi Kalimantan (wajib, dropdown keluar card) -->
        <div class="form-section shadow-sm">
          <div class="form-section-header flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-blue-500">location_on</span>
              </div>
              <div>
                <h2 class="font-bold text-slate-800 text-base">Tempat Tinggal di Kalimantan</h2>
                <p class="text-xs text-slate-400 mt-0.5">Gunakan pencarian untuk memilih lokasi</p>
              </div>
            </div>
            <span class="text-xs font-semibold text-red-500 bg-red-50 px-2.5 py-1 rounded-full border border-red-200">
              Wajib
            </span>
          </div>

          <div class="form-section-body space-y-5">
            <div class="form-control">
              <label class="label pb-1.5">
                <span class="label-text font-semibold text-slate-700 text-sm flex items-center gap-1">
                  Lokasi di Kalimantan <span class="text-red-400">*</span>
                </span>
                <span class="label-text-alt text-slate-400 text-xs">Misal: Kota Samarinda</span>
              </label>

              <!-- Dropdown Choice.js -->
              <select id="lokasi_kalimantan" name="lokasi_kalimantan"
                      class="select select-bordered w-full text-sm"
                      required>
                <option value="">Pilih lokasi...</option>

                <!-- Kalimantan Timur -->
                <option value="samarinda" {{ old('lokasi_kalimantan') === 'samarinda' ? 'selected' : '' }}>Kota Samarinda (Kalimantan Timur)</option>
                <option value="balikpapan" {{ old('lokasi_kalimantan') === 'balikpapan' ? 'selected' : '' }}>Kota Balikpapan (Kalimantan Timur)</option>
                <option value="bontang" {{ old('lokasi_kalimantan') === 'bontang' ? 'selected' : '' }}>Kota Bontang (Kalimantan Timur)</option>
                <option value="kutai_kartanegara" {{ old('lokasi_kalimantan') === 'kutai_kartanegara' ? 'selected' : '' }}>Kab. Kutai Kartanegara (Kalimantan Timur)</option>
                <option value="kutai_timur" {{ old('lokasi_kalimantan') === 'kutai_timur' ? 'selected' : '' }}>Kab. Kutai Timur (Kalimantan Timur)</option>
                <option value="berau" {{ old('lokasi_kalimantan') === 'berau' ? 'selected' : '' }}>Kab. Berau (Kalimantan Timur)</option>

                <!-- contoh lain Kalimantan -->
                <option value="banjarmasin" {{ old('lokasi_kalimantan') === 'banjarmasin' ? 'selected' : '' }}>Kota Banjarmasin (Kalimantan Selatan)</option>
                <option value="pontianak" {{ old('lokasi_kalimantan') === 'pontianak' ? 'selected' : '' }}>Kota Pontianak (Kalimantan Barat)</option>
                <option value="tarakan" {{ old('lokasi_kalimantan') === 'tarakan' ? 'selected' : '' }}>Kota Tarakan (Kalimantan Utara)</option>
              </select>

              <span id="lokasi-error" class="mt-1 text-xs text-red-500 hidden">
                Silakan pilih salah satu lokasi di Kalimantan.
              </span>
            </div>
          </div>
        </div>

        <!-- Disclaimer -->
        <div class="flex gap-3 bg-amber-50 border border-amber-200 rounded-2xl p-4 text-sm text-amber-800">
          <span class="material-symbols-rounded text-amber-500 shrink-0 mt-0.5">shield</span>
          <span>
            <strong>Catatan:</strong> Hasil skrining ini bersifat indikatif dan <strong>bukan diagnosis medis</strong>.
            Gunakan data pengukuran terbaru agar hasil lebih relevan. Selalu konsultasikan ke tenaga kesehatan.
          </span>
        </div>

        <!-- ACTION buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-1">
          <a href="{{ url('/') }}"
             class="flex items-center gap-2 px-5 py-3 rounded-full border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition-colors w-full sm:w-auto justify-center">
            <span class="material-symbols-rounded text-base">arrow_back</span>
            Kembali
          </a>
          <button type="submit"
                  class="btn-submit-pulse flex items-center gap-2 px-8 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-full transition-all shadow-md w-full sm:w-auto justify-center">
            <span class="material-symbols-rounded text-base">analytics</span>
            Analisis Risiko Sekarang
          </button>
        </div>

      </div>

      <!-- ════ RIGHT: SIDEBAR ════ -->
      <aside class="space-y-4 lg:sticky lg:top-24">

        <!-- Panduan singkat -->
        <div class="info-card bg-green-50 border border-green-100">
          <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-rounded text-green-600">help_center</span>
            <h3 class="font-bold text-green-800 text-sm">Panduan Pengisian</h3>
          </div>
          <ul class="space-y-3 text-xs text-green-900">
            <li class="flex gap-2.5">
              <span class="material-symbols-rounded text-green-500 text-base shrink-0">looks_one</span>
              <span>Isi <strong>usia</strong> dalam bulan, atau gunakan tanggal lahir untuk penghitungan otomatis.</span>
            </li>
            <li class="flex gap-2.5">
              <span class="material-symbols-rounded text-green-500 text-base shrink-0">looks_two</span>
              <span>Masukkan <strong>tinggi dan berat badan</strong> hasil pengukuran terbaru.</span>
            </li>
            <li class="flex gap-2.5">
              <span class="material-symbols-rounded text-green-500 text-base shrink-0">looks_3</span>
              <span>Lokasi Kalimantan <strong>opsional</strong> namun membantu konteks analisis.</span>
            </li>
            <li class="flex gap-2.5">
              <span class="material-symbols-rounded text-green-500 text-base shrink-0">looks_4</span>
              <span>Klik <strong>"Analisis Risiko"</strong> untuk melihat hasil dan rekomendasi.</span>
            </li>
          </ul>
        </div>

        <!-- Indikator WHO -->
        <div class="info-card bg-blue-50 border border-blue-100">
          <div class="flex items-center gap-2 mb-3">
            <span class="material-symbols-rounded text-blue-500">monitoring</span>
            <h3 class="font-bold text-blue-800 text-sm">Indikator WHO</h3>
          </div>
          <div class="space-y-2.5 text-xs text-blue-900">
            <div class="flex items-start gap-2">
              <span class="font-bold text-blue-600 shrink-0 mt-0.5 w-12">TB/U</span>
              <span>Tinggi Badan per Usia — indikator utama stunting</span>
            </div>
            <div class="flex items-start gap-2">
              <span class="font-bold text-blue-600 shrink-0 mt-0.5 w-12">BB/U</span>
              <span>Berat Badan per Usia — indikator berat badan</span>
            </div>
            <div class="flex items-start gap-2">
              <span class="font-bold text-blue-600 shrink-0 mt-0.5 w-12">BB/TB</span>
              <span>Berat per Tinggi — indikator wasting</span>
            </div>
          </div>
        </div>

        <!-- Status legend -->
        <div class="info-card bg-white border border-slate-100 shadow-sm">
          <div class="flex items-center gap-2 mb-3">
            <span class="material-symbols-rounded text-slate-500">legend_toggle</span>
            <h3 class="font-bold text-slate-700 text-sm">Kategori Hasil</h3>
          </div>
          <div class="space-y-2 text-xs">
            <div class="flex items-center gap-2.5">
              <span class="w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
              <span class="font-semibold text-green-700">Normal</span>
              <span class="text-slate-500">TB/U &ge; -2 SD</span>
            </div>
            <div class="flex items-center gap-2.5">
              <span class="w-2.5 h-2.5 rounded-full bg-yellow-400 shrink-0"></span>
              <span class="font-semibold text-yellow-700">Risiko</span>
              <span class="text-slate-500">-3 SD s/d -2 SD</span>
            </div>
            <div class="flex items-center gap-2.5">
              <span class="w-2.5 h-2.5 rounded-full bg-orange-500 shrink-0"></span>
              <span class="font-semibold text-orange-700">Stunting</span>
              <span class="text-slate-500">&lt; -2 SD</span>
            </div>
            <div class="flex items-center gap-2.5">
              <span class="w-2.5 h-2.5 rounded-full bg-red-600 shrink-0"></span>
              <span class="font-semibold text-red-700">Stunting Berat</span>
              <span class="text-slate-500">&lt; -3 SD</span>
            </div>
          </div>
        </div>

      </aside><!-- /sidebar -->

    </div>
  </form>
</main>


<!-- ═════════════════ FOOTER ═════════════════ -->
<footer class="bg-slate-900 text-slate-400 mt-14">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <div class="grid sm:grid-cols-3 gap-8 mb-8">
      <div>
        <div class="flex items-center gap-2.5 mb-4">
          <div class="w-8 h-8 rounded-xl bg-green-600 flex items-center justify-center">
            <span class="material-symbols-rounded text-white text-base">health_and_safety</span>
          </div>
          <span class="font-extrabold text-white text-sm">SiCegah Stunting</span>
        </div>
        <p class="text-xs leading-relaxed text-slate-500">
          Platform edukasi dan skrining awal stunting untuk penelitian dan pengabdian masyarakat Aisyiyah Kalimantan Timur.
        </p>
      </div>
      <div>
        <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wider mb-3">Navigasi</h4>
        <div class="flex flex-col gap-1.5 text-sm">
          <a href="{{ url('/') }}" class="hover:text-green-400 transition-colors">Beranda</a>
          <a href="{{ route('kalkulator') }}" class="hover:text-green-400 transition-colors">Kalkulator</a>
        </div>
      </div>
      <div>
        <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wider mb-3">Edukasi</h4>
        <div class="flex flex-col gap-1.5 text-sm">
          <a href="{{ route('edukasi') }}" class="hover:text-green-400 transition-colors">Artikel</a>
          <a href="{{ url('/faq') }}" class="hover:text-green-400 transition-colors">FAQ</a>
        </div>
      </div>
    </div>
    <div class="border-t border-slate-800 pt-5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-600">
      <span>© 2025 SiCegah Stunting — Aisyiyah Kaltim</span>
      <span class="flex items-center gap-1">
        <span class="material-symbols-rounded text-xs">verified</span>
        Menggunakan standar WHO &amp; Kemenkes RI
      </span>
    </div>
  </div>
</footer>


<!-- ═════════════════ SCRIPTS ═════════════════ -->

<!-- Choices.js JS -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
  // Mobile nav toggle
  const navToggle = document.getElementById('nav-toggle');
  const navMobile = document.getElementById('nav-mobile');
  const navIcon = document.getElementById('nav-icon');
  if (navToggle) {
    navToggle.addEventListener('click', () => {
      navMobile.classList.toggle('hidden');
      navIcon.textContent = navMobile.classList.contains('hidden') ? 'menu' : 'close';
    });
  }

  // Auto-hitung usia dari tanggal lahir
  const tglLahirEl = document.getElementById('tgl_lahir');
  if (tglLahirEl) {
    tglLahirEl.addEventListener('change', function() {
      if (!this.value) return;
      const born = new Date(this.value);
      const now = new Date();
      const months = Math.floor((now - born) / (1000 * 60 * 60 * 24 * 30.44));
      const usiaEl = document.getElementById('usia_bulan');
      if (months >= 0 && months <= 60) {
        usiaEl.value = months;
        usiaEl.dispatchEvent(new Event('input'));
      }
    });
  }

  // Form validation (termasuk lokasi wajib)
  const form = document.getElementById('kalkulator-form');
  if (form) {
    form.addEventListener('submit', function(e) {
      const gender = document.querySelector('input[name="jenis_kelamin"]:checked');
      const usia = document.getElementById('usia_bulan').value;
      const tb = document.querySelector('input[name="tinggi_badan"]').value;
      const bb = document.querySelector('input[name="berat_badan"]').value;
      const lokasi = document.getElementById('lokasi_kalimantan').value;

      let errors = [];
      if (!gender) errors.push('Pilih jenis kelamin anak.');
      if (!usia) errors.push('Isi usia anak.');
      if (!tb || tb<40||tb>130) errors.push('Tinggi badan tidak valid (40–130 cm).');
      if (!bb || bb<1 || bb>50) errors.push('Berat badan tidak valid (1–50 kg).');
      if (!lokasi) errors.push('Pilih lokasi tempat tinggal di Kalimantan.');

      const lokasiErrorEl = document.getElementById('lokasi-error');
      if (lokasiErrorEl) {
        if (!lokasi) lokasiErrorEl.classList.remove('hidden');
        else lokasiErrorEl.classList.add('hidden');
      }

      if (errors.length) {
        e.preventDefault();
        showToast(errors[0]);
      }
    });
  }

  function showToast(msg) {
    const old = document.getElementById('sc-toast');
    if (old) old.remove();
    const t = document.createElement('div');
    t.id = 'sc-toast';
    t.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 z-[999] bg-slate-800 text-white text-sm px-5 py-3 rounded-full shadow-xl flex items-center gap-2';
    t.innerHTML = `<span class="material-symbols-rounded text-yellow-400 text-base">warning</span>${msg}`;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 3500);
  }

  // Inisialisasi Choices.js
  document.addEventListener('DOMContentLoaded', function () {
    const lokasiSelect = document.getElementById('lokasi_kalimantan');
    if (lokasiSelect) {
      const lokasiChoices = new Choices(lokasiSelect, {
        searchEnabled: true,
        searchPlaceholderValue: 'Cari kota/kabupaten di Kalimantan...',
        shouldSort: false,
        itemSelectText: '',
        removeItemButton: false
      });
    }
  });
</script>
</body>
</html>
