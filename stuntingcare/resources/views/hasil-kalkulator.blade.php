<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Skrining: {{ $result['nama_anak'] }} - SiCegah Stunting</title>
  <meta name="description" content="Hasil analisis risiko stunting berdasarkan standar pertumbuhan WHO untuk {{ $result['nama_anak'] }}." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: Inter, sans-serif; }
    .material-symbols-rounded { font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24 }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">

  <!-- Navbar -->
  <header class="navbar bg-white border-b border-slate-200 sticky top-0 z-50 px-4 lg:px-8">
    <div class="navbar-start">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center">
          <span class="material-symbols-rounded">health_and_safety</span>
        </div>
        <div>
          <div class="font-extrabold text-emerald-700">SiCegah Stunting</div>
          <div class="text-xs text-slate-500">Edukasi dan Skrining Awal</div>
        </div>
      </a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal gap-1">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('kalkulator') }}">Kalkulator</a></li>
        <li><a href="{{ route('edukasi') }}">Edukasi</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('faq') }}">FAQ</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      <a href="{{ route('kalkulator') }}" class="btn btn-primary rounded-full">Hitung Ulang</a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 lg:px-8 py-10">
    <section class="mb-8">
      <div class="badge {{ $result['risk_level']['badge'] }} badge-outline mb-3">
        Hasil Analisis Risiko
      </div>
      <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Ringkasan hasil skrining awal</h1>
      <p class="text-slate-600 mt-3 max-w-3xl">
        Hasil skrining untuk <strong>{{ $result['nama_anak'] }}</strong> berdasarkan standar pertumbuhan WHO 2006.
        Ini merupakan skrining awal dan bukan pengganti diagnosis medis profesional.
      </p>
    </section>

    <div class="grid lg:grid-cols-3 gap-6">

      <!-- MAIN CONTENT -->
      <section class="lg:col-span-2 space-y-6">

        <!-- Status Card -->
        <div class="card bg-white shadow-lg border border-slate-200">
          <div class="card-body">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
              <div>
                <h2 class="card-title text-2xl">Status Analisis</h2>
                <p class="text-slate-500">
                  {{ $result['nama_anak'] }},
                  {{ $result['gender'] === 'L' ? 'Laki-laki' : 'Perempuan' }},
                  usia {{ $result['usia'] }} bulan
                </p>
              </div>
              <div class="badge {{ $result['risk_level']['badge'] }} badge-lg py-4 px-5 text-sm font-bold">
                {{ $result['risk_level']['label'] }}
              </div>
            </div>

            @php
              $statusDesc = match($result['status_tbu']['code']) {
                'normal'         => 'Tinggi badan anak sesuai dengan standar WHO untuk usianya. Pertumbuhan berjalan normal.',
                'stunting'       => 'Tinggi badan anak berada di bawah standar WHO untuk usianya (Z-score TB/U antara -3 dan -2 SD). Diperlukan pemantauan dan intervensi gizi.',
                'stunting_berat' => 'Tinggi badan anak jauh di bawah standar WHO (Z-score < -3 SD). Kondisi ini membutuhkan penanganan medis segera.',
                default          => 'Hasil analisis menunjukkan perlu adanya perhatian terhadap tumbuh kembang anak.',
              };
            @endphp
            <p class="text-slate-600 mt-2">{{ $statusDesc }}</p>

            <progress class="progress {{ $result['risk_level']['progress'] }} w-full mt-3" value="{{ $result['risk_score'] }}" max="100"></progress>
            <div class="flex justify-between text-sm text-slate-500 mt-1">
              <span>Risiko rendah</span>
              <span class="font-semibold">Skor: {{ $result['risk_score'] }}/100</span>
              <span>Risiko tinggi</span>
            </div>
          </div>
        </div>

        <!-- Z-Score Indicators -->
        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title mb-4">Indikator Z-Score WHO</h2>
            <div class="grid sm:grid-cols-3 gap-4">

              <!-- TB/U -->
              <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">TB/U</div>
                <div class="text-3xl font-extrabold {{ $result['status_tbu']['code'] === 'normal' ? 'text-emerald-600' : 'text-red-600' }} mb-1">
                  {{ $result['zscore_tbu'] }}
                </div>
                <div class="badge {{ $result['status_tbu']['badge'] }} badge-sm">{{ $result['status_tbu']['label'] }}</div>
                <div class="text-xs text-slate-500 mt-2">Median WHO: {{ $result['ideal_tb']['median'] }} cm</div>
              </div>

              <!-- BB/U -->
              <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">BB/U</div>
                <div class="text-3xl font-extrabold {{ $result['status_bbu']['code'] === 'normal' ? 'text-emerald-600' : 'text-amber-600' }} mb-1">
                  {{ $result['zscore_bbu'] }}
                </div>
                <div class="badge {{ $result['status_bbu']['badge'] }} badge-sm">{{ $result['status_bbu']['label'] }}</div>
                <div class="text-xs text-slate-500 mt-2">Median WHO: {{ $result['ideal_bb']['median'] }} kg</div>
              </div>

              <!-- BB/TB -->
              <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">BB/TB</div>
                <div class="text-3xl font-extrabold {{ $result['status_bbtb']['code'] === 'normal' ? 'text-emerald-600' : 'text-orange-600' }} mb-1">
                  {{ $result['zscore_bbtb'] }}
                </div>
                <div class="badge {{ $result['status_bbtb']['badge'] }} badge-sm">{{ $result['status_bbtb']['label'] }}</div>
                <div class="text-xs text-slate-500 mt-2">Wasting indicator</div>
              </div>

            </div>
          </div>
        </div>

        <!-- Rekomendasi -->
        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title mb-4">Rekomendasi awal</h2>
            <div class="space-y-3">
              @foreach($result['recommendations'] as $rec)
                <div class="flex items-start gap-3 p-3 {{ $rec['bg'] }} rounded-2xl border border-slate-100">
                  <span class="material-symbols-rounded {{ $rec['color'] }} mt-0.5 shrink-0">{{ $rec['icon'] }}</span>
                  <div>
                    <div class="font-semibold text-sm text-slate-800">{{ $rec['title'] }}</div>
                    <div class="text-xs text-slate-600 mt-0.5 leading-relaxed">{{ $rec['desc'] }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Disclaimer -->
        <div class="alert alert-warning">
          <span class="material-symbols-rounded">warning</span>
          <span class="text-sm">
            <strong>Disclaimer:</strong> Hasil ini merupakan skrining awal berbasis standar WHO dan tidak menggantikan
            diagnosis atau konsultasi dengan tenaga medis profesional. Untuk penanganan lebih lanjut, hubungi bidan,
            dokter, atau puskesmas terdekat.
          </span>
        </div>

        <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
          <a href="{{ route('edukasi') }}" class="btn btn-primary rounded-full">
            <span class="material-symbols-rounded">menu_book</span>
            Lanjut ke Edukasi
          </a>
          <a href="{{ route('kalkulator') }}" class="btn btn-outline btn-secondary rounded-full">
            <span class="material-symbols-rounded">refresh</span>
            Hitung Ulang
          </a>
        </div>
      </section>

      <!-- SIDEBAR -->
      <aside class="space-y-6">

        <!-- Ringkasan data input -->
        <div class="card bg-emerald-50 border border-emerald-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-emerald-800 text-base">Ringkasan data</h3>
            <div class="overflow-x-auto">
              <table class="table table-sm">
                <tbody>
                  <tr><td class="text-slate-600 text-xs">Nama anak</td><td class="font-medium text-sm">{{ $result['nama_anak'] }}</td></tr>
                  <tr><td class="text-slate-600 text-xs">Usia</td><td class="font-medium text-sm">{{ $result['usia'] }} bulan</td></tr>
                  <tr><td class="text-slate-600 text-xs">Jenis kelamin</td><td class="font-medium text-sm">{{ $result['gender'] === 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                  <tr><td class="text-slate-600 text-xs">Tinggi badan</td><td class="font-medium text-sm">{{ $result['tb'] }} cm</td></tr>
                  <tr><td class="text-slate-600 text-xs">Berat badan</td><td class="font-medium text-sm">{{ $result['bb'] }} kg</td></tr>
                  @if($result['tb_ibu'])
                  <tr><td class="text-slate-600 text-xs">Tinggi ibu</td><td class="font-medium text-sm">{{ $result['tb_ibu'] }} cm</td></tr>
                  @endif
                  @if($result['asi_eksklusif'])
                  <tr><td class="text-slate-600 text-xs">ASI eksklusif</td><td class="font-medium text-sm">{{ $result['asi_eksklusif'] === 'ya' ? 'Ya' : 'Tidak' }}</td></tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Referensi ideal -->
        <div class="card bg-white border border-slate-200 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-slate-700 text-base mb-3">Referensi WHO usia {{ $result['usia'] }} bulan</h3>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Median TB/U</span>
                <span class="font-bold text-sm text-emerald-700">{{ $result['ideal_tb']['median'] }} cm</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">TB/U normal min. (-2 SD)</span>
                <span class="font-bold text-sm text-amber-700">{{ $result['ideal_tb']['min_normal'] }} cm</span>
              </div>
              <div class="divider my-1"></div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Median BB/U</span>
                <span class="font-bold text-sm text-emerald-700">{{ $result['ideal_bb']['median'] }} kg</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">BB/U normal min. (-2 SD)</span>
                <span class="font-bold text-sm text-amber-700">{{ $result['ideal_bb']['min_normal'] }} kg</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Legenda Z-score -->
        <div class="card bg-blue-50 border border-blue-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-blue-800 text-sm mb-3">Kategori TB/U</h3>
            <div class="space-y-2 text-xs">
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                <span class="font-semibold text-green-700">Normal</span>
                <span class="text-slate-500">&ge; -2 SD</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-orange-400 shrink-0"></span>
                <span class="font-semibold text-orange-700">Pendek</span>
                <span class="text-slate-500">-3 s/d -2 SD</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-red-600 shrink-0"></span>
                <span class="font-semibold text-red-700">Sangat Pendek</span>
                <span class="text-slate-500">&lt; -3 SD</span>
              </div>
            </div>
          </div>
        </div>

      </aside>
    </div>
  </main>

  <footer class="footer p-10 bg-slate-900 text-slate-200 mt-10">
    <nav>
      <h6 class="footer-title">Navigasi</h6>
      <a class="link link-hover" href="{{ route('home') }}">Beranda</a>
      <a class="link link-hover" href="{{ route('kalkulator') }}">Kalkulator</a>
      <a class="link link-hover" href="{{ route('hasil') }}">Contoh Hasil</a>
    </nav>
    <nav>
      <h6 class="footer-title">Informasi</h6>
      <a class="link link-hover" href="{{ route('edukasi') }}">Edukasi</a>
      <a class="link link-hover" href="{{ route('faq') }}">FAQ</a>
      <a class="link link-hover" href="{{ route('kontak') }}">Kontak</a>
    </nav>
    <aside>
      <p>Pengurus Wilayah Aisyiyah Kalimantan Timur</p>
      <p class="text-xs text-slate-500 mt-1">Menggunakan standar WHO & Kemenkes RI</p>
    </aside>
  </footer>

</body>
</html>
