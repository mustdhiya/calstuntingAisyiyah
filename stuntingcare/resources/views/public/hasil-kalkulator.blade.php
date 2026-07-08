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
  <!-- Custom Public CSS (External) -->
  <link rel="stylesheet" href="{{ asset('css/public.css') }}" />
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
    <a href="{{ route('kalkulator') }}" class="btn-primary-full text-sm !py-2.5 !px-5">
      <span class="material-symbols-rounded text-[18px]">refresh</span>
      Hitung Ulang
    </a>
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
      <div class="result-card">
        <div class="flex items-start justify-between gap-4 mb-3">
          <div>
            <h2 class="text-[18px] font-bold text-slate-800">Status Analisis</h2>
            <p class="text-sm text-slate-500 mt-0.5">
              Nama anak: <strong>{{ $result["nama_anak"] }}</strong>, usia {{ $result["usia"] }} bulan
            </p>
          </div>
          @php
            $rlCode = $result["risk_level"]["code"];
            $badgeClass = match($rlCode) {
              "rendah"        => "bg-emerald-100 text-emerald-700 border border-emerald-200",
              "sedang"        => "bg-amber-100 text-amber-700 border border-amber-200",
              "tinggi"        => "bg-orange-100 text-orange-700 border border-orange-200",
              "sangat_tinggi" => "bg-red-100 text-red-700 border border-red-200",
              default         => "bg-slate-100 text-slate-700",
            };
          @endphp
          <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[13px] font-bold {{ $badgeClass }} flex-shrink-0">
            <span class="material-symbols-rounded text-[15px]">
              {{ $rlCode === "rendah" ? "check_circle" : ($rlCode === "sedang" ? "warning" : "error") }}
            </span>
            {{ $result["risk_level"]["label"] }}
          </span>
        </div>

        {{-- Status TB/U, BB/U, BB/TB summary --}}
        <p class="text-[14px] text-slate-600 leading-relaxed mb-5">
          @if(in_array($result["status_tbu"]["code"], ["stunting", "stunting_berat"]))
            Data menunjukkan bahwa tinggi badan anak berada di bawah harapan untuk usianya.
            Penilaian tinggi badan menurut usia merupakan indikator utama untuk identifikasi stunting pada balita.
          @else
            Data menunjukkan bahwa tinggi badan anak berada dalam rentang normal sesuai usianya berdasarkan standar WHO 2006.
            Pertahankan pola makan bergizi dan pantau pertumbuhan secara rutin.
          @endif
        </p>

        {{-- Indikator status (TB/U, BB/U, BB/TB) --}}
        <div class="grid grid-cols-3 gap-3 mb-6">
          @foreach([
            ["label" => "TB/U", "sub" => "Tinggi/Usia", "status" => $result["status_tbu"], "icon" => "height"],
            ["label" => "BB/U", "sub" => "Berat/Usia", "status" => $result["status_bbu"], "icon" => "monitor_weight"],
            ["label" => "BB/TB", "sub" => "Berat/Tinggi", "status" => $result["status_bbtb"], "icon" => "straighten"],
          ] as $ind)
          @php
            $indCode = $ind["status"]["code"];
            $indColor = match($indCode) {
              "normal"         => ["bg" => "bg-emerald-50", "text" => "text-emerald-700", "icon" => "text-emerald-500", "pill" => "pill-green"],
              "pendek","stunting"=> ["bg" => "bg-amber-50", "text" => "text-amber-700", "icon" => "text-amber-500", "pill" => "pill-amber"],
              "stunting_berat" => ["bg" => "bg-red-50", "text" => "text-red-700", "icon" => "text-red-500", "pill" => "pill-red"],
              "kurang","wasting"=> ["bg" => "bg-orange-50", "text" => "text-orange-700", "icon" => "text-orange-500", "pill" => "pill-orange"],
              default          => ["bg" => "bg-blue-50", "text" => "text-blue-700", "icon" => "text-blue-500", "pill" => "pill-blue"],
            };
          @endphp
          <div class="rounded-16px {{ $indColor['bg'] }} p-3 rounded-xl text-center">
            <span class="material-symbols-rounded text-[22px] {{ $indColor['icon'] }}">{{ $ind["icon"] }}</span>
            <p class="text-[11px] font-semibold text-slate-500 mt-1">{{ $ind["label"] }}</p>
            <p class="text-[10px] text-slate-400">{{ $ind["sub"] }}</p>
            <p class="text-[13px] font-bold {{ $indColor['text'] }} mt-1 leading-tight">{{ $ind["status"]["label"] }}</p>
          </div>
          @endforeach
        </div>

        {{-- Risk progress bar --}}
        @php
          $score   = (int) $result['risk_score'];
          $clamp   = min(97, max(3, $score));
          $maskPct = 100 - $clamp;   // grey mask from right
          $rlCode  = $result['risk_level']['code'];
          $markerColor = match($rlCode) {
            'rendah'        => '#22c55e',
            'sedang'        => '#f59e0b',
            'tinggi'        => '#f97316',
            'sangat_tinggi' => '#ef4444',
            default         => '#64748b',
          };
        @endphp
        <div class="mt-2 mb-6">
          {{-- Track --}}
          <div class="risk-track" style="margin-bottom: 28px;">
            {{-- Grey mask covers the right portion --}}
            <div class="risk-track-mask" style="width: {{ $maskPct }}%;"></div>
            {{-- Marker below the current position --}}
            <div class="risk-marker" style="left: {{ $clamp }}%;">
              <div class="risk-marker-arrow" style="border-bottom-color: {{ $markerColor }};"></div>
              <div class="risk-marker-badge" style="background: {{ $markerColor }};">{{ $score }}/100</div>
            </div>
          </div>
          {{-- Labels --}}
          <div class="flex justify-between text-[12px] text-slate-500 mt-1">
            <span class="flex items-center gap-1">
              <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
              Risiko rendah
            </span>
            <span class="font-semibold text-slate-700">{{ $result['risk_level']['label'] }}</span>
            <span class="flex items-center gap-1">
              Risiko tinggi
              <span class="inline-block w-2.5 h-2.5 rounded-full bg-red-400"></span>
            </span>
          </div>
        </div>
      </div>

      {{-- ── Card 2: Faktor yang Memengaruhi ── --}}
      <div class="result-card">
        <h2 class="text-[16px] font-bold text-slate-800 mb-4">Faktor yang memengaruhi</h2>
        <ul class="timeline timeline-vertical">
          @php
            $zTbu  = $result['zscore_tbu'];
            $zBbu  = $result['zscore_bbu'];
            $zBbtb = $result['zscore_bbtb'];

            $descTbu  = $zTbu  >= -1 ? "Tinggi badan anak sesuai usia, pertahankan pola gizi saat ini."
                      : ($zTbu  >= -2 ? "Tinggi badan anak sedikit di bawah rata-rata, perlu pemantauan."
                      : "Tinggi badan anak berisiko stunting, segera konsultasikan ke tenaga kesehatan.");
            $descBbu  = $zBbu  >= -1 ? "Berat badan anak sesuai usia, pertahankan asupan nutrisi."
                      : ($zBbu  >= -2 ? "Berat badan perlu dipantau agar sesuai dengan pertumbuhan usia."
                      : "Berat badan anak rendah untuk usianya, waspadai risiko gizi kurang.");
            $descBbtb = $zBbtb >= -1 ? "Proporsi berat terhadap tinggi badan anak baik."
                      : ($zBbtb >= -2 ? "Berat badan anak sedikit rendah terhadap tinggi, pantau perkembangannya."
                      : "Proporsi berat terhadap tinggi berisiko, konsultasikan ke dokter atau ahli gizi.");

            $colorTbu  = $zTbu  >= -1 ? 'text-emerald-600' : ($zTbu  >= -2 ? 'text-amber-500' : 'text-red-500');
            $colorBbu  = $zBbu  >= -1 ? 'text-emerald-600' : ($zBbu  >= -2 ? 'text-cyan-600'  : 'text-red-500');
            $colorBbtb = $zBbtb >= -1 ? 'text-emerald-600' : ($zBbtb >= -2 ? 'text-amber-500' : 'text-red-500');
            $hrTbu     = $zTbu  >= -2 ? 'bg-emerald-500' : 'bg-amber-400';
            $hrBbu     = $zBbu  >= -2 ? 'bg-cyan-500'    : 'bg-amber-400';
          @endphp
          <li>
            <div class="timeline-start timeline-box text-[13px]">
              <span class="font-semibold">TB/U (Z: {{ $zTbu }})</span><br>{{ $descTbu }}
            </div>
            <div class="timeline-middle {{ $colorTbu }}">
              <span class="material-symbols-rounded">straighten</span>
            </div>
            <hr class="{{ $hrTbu }}" />
          </li>
          <li>
            <hr class="{{ $hrTbu }}" />
            <div class="timeline-start timeline-box text-[13px]">
              <span class="font-semibold">BB/U (Z: {{ $zBbu }})</span><br>{{ $descBbu }}
            </div>
            <div class="timeline-middle {{ $colorBbu }}">
              <span class="material-symbols-rounded">monitor_weight</span>
            </div>
            <hr class="{{ $hrBbu }}" />
          </li>
          <li>
            <hr class="{{ $hrBbu }}" />
            <div class="timeline-start timeline-box text-[13px]">
              <span class="font-semibold">BB/TB (Z: {{ $zBbtb }})</span><br>{{ $descBbtb }}
            </div>
            <div class="timeline-middle {{ $colorBbtb }}">
              <span class="material-symbols-rounded">family_home</span>
            </div>
          </li>
        </ul>
      </div>

      {{-- ── Card 3: Rekomendasi ── --}}
      <div class="result-card">
        <h2 class="text-[16px] font-bold text-slate-800 mb-4">Rekomendasi awal</h2>
        <div class="space-y-3">
          @foreach($result["recommendations"] as $rec)
          <div class="rec-item">
            <div class="rec-icon-wrap {{ $rec["bg"] }}">
              <span class="material-symbols-rounded text-[18px] {{ $rec["color"] }}">{{ $rec["icon"] }}</span>
            </div>
            <div>
              <p class="text-[14px] font-semibold text-slate-800 mb-0.5">{{ $rec["title"] }}</p>
              <p class="text-[13px] text-slate-500 leading-relaxed">{{ $rec["desc"] }}</p>
            </div>
          </div>
          @endforeach
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
    <div class="space-y-5">

      {{-- ── Sidebar: Ringkasan Data ── --}}
      <div class="result-card">
        <h3 class="text-[15px] font-bold text-emerald-700 mb-4 flex items-center gap-2">
          <span class="material-symbols-rounded text-[18px]">summarize</span>
          Ringkasan data
        </h3>
        <div>
          <div class="data-row">
            <span class="data-label">Usia</span>
            <span class="data-value">{{ $result["usia"] }} bulan</span>
          </div>
          <div class="data-row">
            <span class="data-label">Jenis kelamin</span>
            <span class="data-value">{{ $result["gender"] === "L" ? "Laki-laki" : "Perempuan" }}</span>
          </div>
          <div class="data-row">
            <span class="data-label">Tinggi badan</span>
            <span class="data-value">{{ $result["tb"] }} cm</span>
          </div>
          <div class="data-row">
            <span class="data-label">Berat badan</span>
            <span class="data-value">{{ $result["bb"] }} kg</span>
          </div>
          @if(!empty($result["tb_ibu"]))
          <div class="data-row">
            <span class="data-label">Tinggi ibu</span>
            <span class="data-value">{{ $result["tb_ibu"] }} cm</span>
          </div>
          @endif
          <div class="data-row">
            <span class="data-label">TB ideal (median)</span>
            <span class="data-value text-emerald-600">{{ $result["ideal_tb"]["median"] }} cm</span>
          </div>
          <div class="data-row">
            <span class="data-label">BB ideal (median)</span>
            <span class="data-value text-emerald-600">{{ $result["ideal_bb"]["median"] }} kg</span>
          </div>
        </div>
      </div>

      {{-- ── Sidebar: Catatan Edukasi ── --}}
      <div class="result-card bg-emerald-50 border-emerald-100">
        <h3 class="text-[14px] font-bold text-emerald-700 mb-2 flex items-center gap-2">
          <span class="material-symbols-rounded text-[17px]">school</span>
          Catatan edukasi
        </h3>
        <p class="text-[13px] text-emerald-800 leading-relaxed">
          WHO menyediakan alat dan standar pertumbuhan untuk mendukung implementasi pemantauan fisik anak,
          termasuk indikator tinggi badan menurut usia. Standar ini digunakan secara global oleh tenaga kesehatan.
        </p>
      </div>

      {{-- ── Sidebar: Referensi Normal ── --}}
      <div class="result-card">
        <h3 class="text-[14px] font-bold text-slate-700 mb-3 flex items-center gap-2">
          <span class="material-symbols-rounded text-[17px] text-blue-500">info</span>
          Referensi normal WHO
        </h3>
        <div class="space-y-2 text-[13px]">
          <div class="flex justify-between">
            <span class="text-slate-500">TB normal minimal</span>
            <span class="font-semibold text-slate-700">{{ $result["ideal_tb"]["min_normal"] }} cm</span>
          </div>
          <div class="flex justify-between">
            <span class="text-slate-500">BB normal minimal</span>
            <span class="font-semibold text-slate-700">{{ $result["ideal_bb"]["min_normal"] }} kg</span>
          </div>
          <p class="text-[11px] text-slate-400 mt-2 leading-relaxed">
            Berdasarkan z-score &ge; &minus;2 SD untuk anak usia {{ $result["usia"] }} bulan,
            {{ $result["gender"] === "L" ? "laki-laki" : "perempuan" }}.
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
