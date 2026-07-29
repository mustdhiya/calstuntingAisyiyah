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

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=2') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico?v=2') }}">
<link rel="apple-touch-icon" href="{{ asset('img/logo.png?v=2') }}">

  <!-- DaisyUI + Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Choices.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

  <!-- tailwind.config -->
  <script src="{{ asset('js/user/kalkulator-config.js') }}"></script>

  <!-- css -->
  <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user/kalkulator.css') }}" />
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
    <input type="hidden" name="measurement_id" value="{{ old('measurement_id', $editMeasurement->id ?? '') }}" />

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
                       value="{{ old('nama_anak', $editMeasurement->child_name ?? '') }}"
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
              @php
                $selectedGender = old('jenis_kelamin', $editMeasurement->gender ?? 'P');
              @endphp
              <div class="grid grid-cols-2 gap-3">
                <label class="radio-card">
                  <input type="radio" name="jenis_kelamin" value="L" {{ $selectedGender === 'L' ? 'checked' : '' }} />
                  <div class="rc-box">
                    <span class="rc-icon material-symbols-rounded">boy</span>
                    <span class="rc-label">Laki-laki</span>
                  </div>
                </label>
                <label class="radio-card">
                  <input type="radio" name="jenis_kelamin" value="P" {{ $selectedGender === 'P' ? 'checked' : '' }} />
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
                  <span class="label-text-alt text-slate-400 text-xs">Terisi otomatis dari tanggal lahir</span>
                </label>
                <div class="input-unit-wrap">
                  <input type="number" name="usia_bulan" id="usia_bulan" min="0" max="60"
                    placeholder="Otomatis dari tanggal lahir"
                    value="{{ old('usia_bulan', $editMeasurement->age_months ?? '') }}"
                    class="input input-bordered w-full focus:border-green-500 text-sm bg-slate-50"
                    readonly required />
                  <span class="unit-badge">bln</span>
                </div>
              </div>
              <div class="form-control">
                <label class="label pb-1.5">
                  <span class="label-text font-semibold text-slate-700 text-sm">Tanggal Lahir</span>
                  <span class="label-text-alt text-slate-400 text-xs">Otomatis hitung usia</span>
                </label>
                @php
                  $tglLahirFormatted = isset($editMeasurement->birth_date) ? \Carbon\Carbon::parse($editMeasurement->birth_date)->format('Y-m-d') : '';
                @endphp
                <input type="date" id="tgl_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tglLahirFormatted) }}"
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
                         placeholder="80.0" value="{{ old('tinggi_badan', $editMeasurement->height ?? '80') }}"
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
                         placeholder="9.2" value="{{ old('berat_badan', $editMeasurement->weight ?? '9.2') }}"
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

              @php
                $selectedCity = old('lokasi_kalimantan', isset($editMeasurement->city) ? strtolower(str_replace(' ', '_', $editMeasurement->city)) : '');
              @endphp
              <!-- Dropdown Choice.js -->
              <select id="lokasi_kalimantan" name="lokasi_kalimantan"
                      class="select select-bordered w-full text-sm"
                      required>
                <option value="">Pilih lokasi...</option>

                <!-- Kalimantan Timur -->
                <option value="samarinda" {{ $selectedCity === 'samarinda' ? 'selected' : '' }}>Kota Samarinda (Kalimantan Timur)</option>
                <option value="balikpapan" {{ $selectedCity === 'balikpapan' ? 'selected' : '' }}>Kota Balikpapan (Kalimantan Timur)</option>
                <option value="bontang" {{ $selectedCity === 'bontang' ? 'selected' : '' }}>Kota Bontang (Kalimantan Timur)</option>
                <option value="kutai_kartanegara" {{ $selectedCity === 'kutai_kartanegara' ? 'selected' : '' }}>Kab. Kutai Kartanegara (Kalimantan Timur)</option>
                <option value="kutai_timur" {{ $selectedCity === 'kutai_timur' ? 'selected' : '' }}>Kab. Kutai Timur (Kalimantan Timur)</option>
                <option value="berau" {{ $selectedCity === 'berau' ? 'selected' : '' }}>Kab. Berau (Kalimantan Timur)</option>

                <!-- contoh lain Kalimantan -->
                <option value="banjarmasin" {{ $selectedCity === 'banjarmasin' ? 'selected' : '' }}>Kota Banjarmasin (Kalimantan Selatan)</option>
                <option value="pontianak" {{ $selectedCity === 'pontianak' ? 'selected' : '' }}>Kota Pontianak (Kalimantan Barat)</option>
                <option value="tarakan" {{ $selectedCity === 'tarakan' ? 'selected' : '' }}>Kota Tarakan (Kalimantan Utara)</option>
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
          Platform edukasi dan skrining awal stunting untuk penelitian dan pengabdian masyarakat Universitas Muhammadiyah Kalimantan Timur.
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
      <span>© 2025 SiCegah Stunting — Universitas Muhammadiyah Kaltim</span>
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
  const navToggle = document.getElementById('nav-toggle');
  const navMobile = document.getElementById('nav-mobile');
  const navIcon = document.getElementById('nav-icon');

  if (navToggle) {
    navToggle.addEventListener('click', () => {
      navMobile.classList.toggle('hidden');
      navIcon.textContent = navMobile.classList.contains('hidden') ? 'menu' : 'close';
    });
  }

  const tglLahirEl = document.getElementById('tgl_lahir');
  const usiaEl = document.getElementById('usia_bulan');

  function hitungUsiaBulan(tanggalLahir) {
    const born = new Date(tanggalLahir);
    const today = new Date();

    if (Number.isNaN(born.getTime())) return '';

    let months =
      (today.getFullYear() - born.getFullYear()) * 12 +
      (today.getMonth() - born.getMonth());

    if (today.getDate() < born.getDate()) {
      months--;
    }

    if (months < 0) return '';
    return months;
  }

  function updateUsiaDariTanggalLahir() {
    if (!tglLahirEl || !usiaEl) return;

    if (!tglLahirEl.value) {
      usiaEl.value = '';
      return;
    }

    const months = hitungUsiaBulan(tglLahirEl.value);

    if (months === '') {
      usiaEl.value = '';
      return;
    }

    usiaEl.value = months;
    usiaEl.dispatchEvent(new Event('input', { bubbles: true }));
  }

  if (tglLahirEl) {
    tglLahirEl.addEventListener('change', updateUsiaDariTanggalLahir);
    tglLahirEl.addEventListener('input', updateUsiaDariTanggalLahir);
  }

  document.addEventListener('DOMContentLoaded', function () {
    updateUsiaDariTanggalLahir();

    const lokasiSelect = document.getElementById('lokasi_kalimantan');
    if (lokasiSelect) {
      new Choices(lokasiSelect, {
        searchEnabled: true,
        searchPlaceholderValue: 'Cari kota/kabupaten di Kalimantan...',
        shouldSort: false,
        itemSelectText: '',
        removeItemButton: false
      });
    }
  });

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
      if (!usia) errors.push('Pilih tanggal lahir anak agar usia terisi otomatis.');
      if (usia && (parseInt(usia, 10) < 0 || parseInt(usia, 10) > 60)) {
        errors.push('Usia anak harus berada pada rentang 0–60 bulan.');
      }
      if (!tb || tb < 40 || tb > 130) errors.push('Tinggi badan tidak valid (40–130 cm).');
      if (!bb || bb < 1 || bb > 50) errors.push('Berat badan tidak valid (1–50 kg).');
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
</script>
</body>
</html>
