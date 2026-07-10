<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Skrining: {{ $result["nama_anak"] }} — SiCegah Stunting</title>
  <meta name="description" content="Hasil analisis risiko stunting berdasarkan standar pertumbuhan WHO untuk {{ $result['nama_anak'] }}." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user/hasil-kalkulator.css') }}" />
</head>
<body>

<!-- Navbar -->
<header class="navbar-custom sticky top-0 z-50">
  <div class="max-w-6xl mx-auto px-4 lg:px-8 h-full flex items-center justify-between gap-4">
    <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
      <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
        <span class="material-symbols-rounded text-xl">health_and_safety</span>
      </div>
      <div class="leading-tight">
        <div class="font-bold text-[15px] text-emerald-700 leading-none">SiCegah Stunting</div>
        <div class="text-[11px] text-slate-400 mt-0.5">Edukasi &amp; Skrining Awal</div>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-1">
      <a href="{{ route('home') }}" class="nav-link">Beranda</a>
      <a href="{{ route('kalkulator') }}" class="nav-link">Kalkulator</a>
      <a href="{{ route('edukasi') }}" class="nav-link">Edukasi</a>
      <a href="{{ route('tentang') }}" class="nav-link">Tentang</a>
      <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
      <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
    </nav>
    <div class="flex items-center gap-2">
      @guest
        <a href="{{ route('login') }}" class="btn-hero-primary bg-white text-emerald-700 border border-emerald-600 hover:bg-emerald-50 text-sm !py-2 !px-4 hidden sm:inline-flex" style="background:#fff; color:#047857; border: 1.5px solid #059669; box-shadow:none;">
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
          <a href="{{ route('admin.dashboard') }}" class="btn-hero-primary text-sm !py-2 !px-4 hidden sm:inline-flex bg-slate-800 hover:bg-slate-900 border-none !text-white">
            <span class="material-symbols-rounded text-[18px]">dashboard</span>
            Dashboard
          </a>
        @endif
        <form action="{{ route('logout') }}" method="POST" class="hidden sm:inline">
          @csrf
          <button type="submit" class="btn-hero-primary bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 text-sm !py-2 !px-4 inline-flex items-center gap-1.5" style="background:#fef2f2; color:#dc2626; border:1px solid #fee2e2; box-shadow:none;">
            Keluar
          </button>
        </form>
      @endauth

      <!-- <a href="{{ route('kalkulator') }}" class="btn-primary-full text-sm !py-2.5 !px-5">
        <span class="material-symbols-rounded text-[18px]">refresh</span>
        Hitung Ulang
      </a> -->
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto px-4 lg:px-8 py-10">

  <!-- Breadcrumb + Title -->
  <div class="mb-8">
    <div class="flex items-center gap-2 mb-4">
      @php
        $riskCode = $result["risk_level"]["code"];
        $breadcrumbClass = match($riskCode) {
          "rendah"       => "pill-green",
          "sedang"       => "pill-amber",
          "tinggi"       => "pill-orange",
          "sangat_tinggi"=> "pill-red",
          default        => "pill-green",
        };
      @endphp
      <span class="pill {{ $breadcrumbClass }}">
        <span class="material-symbols-rounded text-[13px]">analytics</span>
        Hasil Analisis
      </span>
      <span class="material-symbols-rounded text-slate-400 text-[16px]">chevron_right</span>
    </div>
    <h1 class="text-[30px] sm:text-[36px] font-extrabold text-slate-900 mb-2">Ringkasan hasil skrining awal</h1>
    <p class="text-slate-500 text-[15px] leading-relaxed max-w-2xl">
      Hasil skrining untuk <strong class="text-slate-700">{{ $result["nama_anak"] }}</strong> berdasarkan standar pertumbuhan WHO 2006.
      Ini merupakan skrining awal dan bukan pengganti diagnosis medis profesional.
    </p>
  </div>

  <!-- 2-column grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ═══════ LEFT COLUMN (2/3) ═══════ -->
    <div class="lg:col-span-2 space-y-5">

      {{-- ── Card 1: Status Analisis ── --}}
      <div class="card bg-white shadow-lg border border-slate-200">
        <div class="card-body">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
              <h2 class="card-title text-2xl">Status Analisis</h2>
              <p class="text-slate-500">
                Nama anak: <strong>{{ $result["nama_anak"] }}</strong>, usia {{ $result["usia"] }} bulan
              </p>
            </div>
            @php
              $rlCode = $result["risk_level"]["code"];
              $badgeClass = match($rlCode) {
                "rendah"        => "badge-success text-white",
                "sedang"        => "badge-warning text-slate-800",
                "tinggi", "sangat_tinggi" => "badge-error text-white",
                default         => "badge-ghost",
              };
            @endphp
            <div class="badge {{ $badgeClass }} badge-lg py-4 px-4">
              {{ $result["risk_level"]["label"] }}
            </div>
          </div>
          <p class="text-slate-600">
            @if(in_array($result["status_tbu"]["code"], ["stunting", "stunting_berat"]))
              Data menunjukkan bahwa tinggi badan anak berada di bawah harapan untuk usianya.
              Penilaian tinggi badan menurut usia merupakan indikator utama untuk identifikasi stunting pada balita.
            @else
              Data menunjukkan bahwa tinggi badan anak berada dalam rentang normal sesuai usianya berdasarkan standar WHO 2006.
              Pertahankan pola makan bergizi dan pantau pertumbuhan secara rutin.
            @endif
          </p>

          @php
            $score = (int) $result['risk_score'];
            $progressClass = match($rlCode) {
              "rendah"        => "progress-success",
              "sedang"        => "progress-warning",
              "tinggi", "sangat_tinggi" => "progress-error",
              default         => "progress-ghost",
            };
          @endphp
          <progress class="progress {{ $progressClass }} w-full" value="{{ $score }}" max="100"></progress>
          <div class="flex justify-between text-sm text-slate-500">
            <span>Risiko rendah</span>
            <span>Posisi hasil: {{ $score }}/100</span>
            <span>Risiko tinggi</span>
          </div>
        </div>
      </div>

      {{-- ── Card 2: Faktor yang Memengaruhi ── --}}
      <div class="card bg-white shadow-md border border-slate-200">
        <div class="card-body">
          <h2 class="card-title text-slate-800">Faktor yang memengaruhi</h2>
          <ul class="timeline timeline-vertical text-sm mt-3">
            @if(empty($result['factors']))
              <li>
                <div class="timeline-start timeline-box text-xs">
                  Tidak ada faktor risiko tambahan yang diidentifikasi oleh admin untuk status ini.
                </div>
                <div class="timeline-middle text-slate-500">
                  <span class="material-symbols-rounded">info</span>
                </div>
              </li>
            @else
              @foreach($result['factors'] as $idx => $factor)
                @php
                  $isLast = $idx === count($result['factors']) - 1;
                  $lineClass = $factor['lineClass'] ?? 'bg-emerald-500';
                @endphp
                <li>
                  @if($idx > 0)
                    <hr class="{{ $lineClass }}" />
                  @endif
                  <div class="timeline-start timeline-box bg-slate-50 text-slate-700 border-slate-200 text-[13px] leading-relaxed max-w-[280px] sm:max-w-md">
                    {{ $factor['text'] }}
                  </div>
                  <div class="timeline-middle {{ $factor['color'] }}">
                    <span class="material-symbols-rounded text-lg">{{ $factor['icon'] }}</span>
                  </div>
                  @if(!$isLast)
                    <hr class="{{ $lineClass }}" />
                  @endif
                </li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>

      {{-- ── Card 3: Rekomendasi ── --}}
      <div class="card bg-white shadow-md border border-slate-200">
        <div class="card-body">
          <h2 class="card-title text-slate-800">Rekomendasi awal</h2>
          <div class="space-y-4">
            @foreach($result["recommendations"] as $rec)
              @php
                $alertBg = $rec['bg'] ?? 'bg-emerald-50';
                $alertBorder = str_replace('bg-', 'border-', $alertBg);
                $alertBorder = str_replace('-50', '-100', $alertBorder);
              @endphp
              <div class="alert {{ $alertBg }} border {{ $alertBorder }}">
                <span class="material-symbols-rounded {{ $rec['color'] }}">check_circle</span>
                <span><strong>{{ $rec['title'] }}:</strong> {{ $rec['desc'] }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- ── Disclaimer ── --}}
      <div class="bg-amber-50 border border-amber-200 rounded-16px rounded-xl p-4 flex gap-3 items-start">
        <span class="material-symbols-rounded text-amber-500 text-[22px] flex-shrink-0 mt-0.5">info</span>
        <p class="text-[13px] text-amber-800 leading-relaxed">
          <strong>Disclaimer:</strong> Hasil ini hanya merupakan skrining awal untuk edukasi dan <strong>tidak menggantikan</strong>
          diagnosis atau konsultasi medis profesional. Segera kunjungi tenaga kesehatan jika ada kekhawatiran terkait tumbuh kembang anak.
        </p>
      </div>

      {{-- ── Action buttons ── --}}
      <div class="flex flex-wrap gap-3">
        <a href="{{ route("edukasi") }}" class="btn-primary-full">
          <span class="material-symbols-rounded text-[20px]">menu_book</span>
          Lanjut ke Edukasi
        </a>
        <a href="{{ route("kalkulator") }}" class="btn-outline-green">
          <span class="material-symbols-rounded text-[20px]">refresh</span>
          Hitung Ulang
        </a>
      </div>

    </div><!-- /left column -->

    <!-- ═══════ RIGHT COLUMN (1/3) ═══════ -->
    <div class="space-y-6">

      {{-- ── Sidebar: Ringkasan Data ── --}}
      <div class="card bg-emerald-50 border border-emerald-100 shadow-sm">
        <div class="card-body">
          <h3 class="card-title text-emerald-800">Ringkasan data</h3>
          <div class="overflow-x-auto">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td>Usia</td>
                  <td>{{ $result["usia"] }} bulan</td>
                </tr>
                <tr>
                  <td>Jenis kelamin</td>
                  <td >{{ $result["gender"] === "L" ? "Laki-laki" : "Perempuan" }}</td>
                </tr>
                <tr>
                  <td>Tinggi badan</td>
                  <td >{{ $result["tb"] }} cm</td>
                </tr>
                <tr>
                  <td>Berat badan</td>
                  <td >{{ $result["bb"] }} kg</td>
                </tr>
                <tr>
                  <td>Lokasi</td>
                  <td>{{ $result["city"] ?? '—' }} (Kaltim)</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- ── Sidebar: Catatan Edukasi ── --}}
        <div class="card bg-cyan-50 border border-cyan-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-cyan-800">Catatan edukasi</h3>
            <p class="text-sm text-cyan-900">
              WHO menyediakan alat dan standar pertumbuhan untuk mendukung implementasi pemantauan fisik anak, termasuk indikator tinggi badan menurut usia.
            </p>
          </div>
        </div>

    </div><!-- /right column -->
  </div><!-- /grid -->
</main>

<!-- Footer -->
<footer class="footer-main mt-14 pt-12 pb-8">
  <div class="max-w-6xl mx-auto px-4 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8 border-b border-white/10">
      <div>
        <div class="flex items-center gap-3 mb-3">
          <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
            <span class="material-symbols-rounded">health_and_safety</span>
          </div>
          <div>
            <div class="font-bold text-white text-[15px]">SiCegah Stunting</div>
            <div class="text-[11px] text-slate-400">Edukasi dan Skrining Awal</div>
          </div>
        </div>
        <p class="text-slate-400 text-[13px] leading-relaxed">
          Platform edukasi dan analisis risiko stunting untuk kader dan masyarakat Aisyiyah Kalimantan Timur.
        </p>
      </div>
      <div>
        <h4 class="font-semibold text-white text-[13px] uppercase tracking-wider mb-3">NAVIGASI</h4>
        <ul class="space-y-2">
          <li><a href="{{ route("home") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Beranda</a></li>
          <li><a href="{{ route("kalkulator") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Kalkulator</a></li>
          <li><a href="{{ route("edukasi") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Edukasi</a></li>
          <li><a href="{{ route("faq") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">FAQ</a></li>
          <li><a href="{{ route("kontak") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Kontak</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold text-white text-[13px] uppercase tracking-wider mb-3">INFORMASI</h4>
        <ul class="space-y-2">
          <li><a href="{{ route("edukasi") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Edukasi</a></li>
          <li><a href="{{ route("faq") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">FAQ</a></li>
          <li><a href="{{ route("kontak") }}" class="text-slate-400 text-[13px] hover:text-white transition-colors">Kontak</a></li>
        </ul>
        <p class="text-slate-400 text-[13px] mt-4">Pengurus Wilayah Aisyiyah Kalimantan Timur</p>
      </div>
    </div>
    <p class="text-slate-500 text-[12px] text-center mt-6">
      &copy; {{ date("Y") }} SiCegah Stunting - Aisyiyah Kalimantan Timur. Dikembangkan untuk penelitian dan pengabdian masyarakat.
    </p>
  </div>
</footer>

</body>
</html>
