<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin — SiCegah Stunting</title>
  <meta name="description" content="Dashboard ringkas untuk memantau artikel edukasi dan hasil analisis stunting." />

  <!-- Font & Icon -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24..48,400,0..1,0..200" rel="stylesheet" />

  <!-- Tailwind + DaisyUI (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    .material-symbols-rounded {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      vertical-align: middle;
    }
  </style>
</head>

<body class="bg-slate-50 text-slate-800">

  <!-- Navbar -->
  <header class="sticky top-0 z-40 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center">
          <span class="material-symbols-rounded">admin_panel_settings</span>
        </div>
        <div>
          <div class="font-bold text-emerald-700 text-sm">Admin SiCegah</div>
          <div class="text-xs text-slate-500">Kelola konten edukasi</div>
        </div>
      </a>

      <div class="flex items-center gap-3">
        <div class="hidden sm:flex items-center gap-2 text-xs text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full">
          <span class="material-symbols-rounded text-sm">account_circle</span>
          Admin Aisyiyah
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline btn-sm rounded-full">
          <span class="material-symbols-rounded text-sm">open_in_new</span>
          Lihat Website
        </a>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

      <!-- Sidebar -->
      <aside class="lg:col-span-3 space-y-4">
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <p class="text-xs text-slate-500 mb-2">Menu admin</p>
          <nav class="space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 font-medium">
              <span class="material-symbols-rounded text-sm">dashboard</span>
              Dashboard
            </a>
            <a href="{{ route('admin.artikel.list') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">article</span>
              Artikel edukasi
            </a>
            <a href="{{ route('admin.analisis') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna
            </a>
          </nav>
        </div>

        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-emerald-600 text-base">info</span>
            <div>
              <h2 class="text-sm font-semibold text-emerald-900">Ringkasan hari ini</h2>
              <p class="text-xs text-emerald-800 mt-1 leading-relaxed">
                Lihat sekilas jumlah artikel, analisis terbaru, dan aktivitas pengguna untuk memantau program.
              </p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main content -->
      <section class="lg:col-span-9 space-y-6">

        <!-- Header dashboard -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">dashboard</span>
              Dashboard program stunting
            </p>
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
              Ringkasan aktivitas Admin SiCegah
            </h1>
            <p class="text-xs text-slate-500 mt-1">
              Pantau artikel edukasi, penggunaan kalkulator, dan data pengguna secara singkat.
            </p>
          </div>
          <div class="flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">refresh</span>
              Refresh
            </button>
            <button type="button" class="btn btn-primary btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">add</span>
              Artikel baru
            </button>
          </div>
        </div>

        <!-- Statistik ringkas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
          <!-- Card 1: Artikel terbit -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
              <span class="text-xs font-medium text-slate-500">Artikel terbit</span>
              <span class="material-symbols-rounded text-emerald-500 text-base">article</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $publishedArticles }}</p>
            <p class="text-xs text-slate-500">
              {{ $totalArticles }} total artikel
            </p>
          </div>

          <!-- Card 2: Total pengukuran -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
              <span class="text-xs font-medium text-slate-500">Analisis kalkulator</span>
              <span class="material-symbols-rounded text-indigo-500 text-base">calculate</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalMeasurements }}</p>
            <p class="text-xs text-slate-500">
              Total skrining tercatat
            </p>
          </div>

          <!-- Card 3: Risiko stunting -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
              <span class="text-xs font-medium text-slate-500">Risiko stunting</span>
              <span class="material-symbols-rounded text-amber-500 text-base">warning</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalStunted }}</p>
            <p class="text-xs text-slate-500">
              Kasus pendek & sangat pendek
            </p>
          </div>

          <!-- Card 4: Pengguna terdaftar -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
              <span class="text-xs font-medium text-slate-500">Pengguna terdaftar</span>
              <span class="material-symbols-rounded text-sky-500 text-base">group</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalUsers }}</p>
            <p class="text-xs text-slate-500">
              {{ $totalKader }} kader aktif
            </p>
          </div>
        </div>

        <!-- Dua kolom: aktivitas & artikel -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

          <!-- Aktivitas terbaru -->
          <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
            <div class="flex items-center justify-between mb-3">
              <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
                <span class="material-symbols-rounded text-sm text-slate-600">timeline</span>
                Aktivitas terbaru
              </h2>
              <button type="button" class="btn btn-ghost btn-xs rounded-full text-xs">
                Lihat semua
              </button>
            </div>

            <ul class="divide-y divide-slate-100 text-sm">
              @forelse ($recentMeasurements as $m)
              <li class="py-3 flex items-start gap-3">
                <div class="w-8 h-8 rounded-full
                  {{ $m->status_growth === 'Normal' ? 'bg-emerald-50 text-emerald-600' : ($m->status_growth === 'Pendek' ? 'bg-amber-50 text-amber-600' : 'bg-rose-50 text-rose-600') }}
                  flex items-center justify-center">
                  <span class="material-symbols-rounded text-base">calculate</span>
                </div>
                <div class="flex-1">
                  <p class="font-medium text-slate-800 text-sm">
                    Skrining: <span class="font-semibold">{{ $m->child_name ?? 'Tanpa nama' }}</span>
                    <span class="ml-1 text-xs font-normal
                      {{ $m->status_growth === 'Normal' ? 'text-emerald-600' : ($m->status_growth === 'Pendek' ? 'text-amber-600' : 'text-rose-600') }}">
                      · {{ $m->status_growth }}
                    </span>
                  </p>
                  <p class="text-xs text-slate-500 mt-0.5">
                    {{ $m->city ?? '-' }} · {{ $m->created_at->diffForHumans() }}
                  </p>
                </div>
              </li>
              @empty
              <li class="py-6 text-center text-slate-400 text-xs">Belum ada data pengukuran.</li>
              @endforelse
            </ul>
          </div>

          <!-- Artikel terbaru -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4">
            <div class="flex items-center justify-between mb-3">
              <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
                <span class="material-symbols-rounded text-sm text-slate-600">menu_book</span>
                Artikel edukasi terbaru
              </h2>
              <a href="{{ route('admin.artikel.list') }}" class="text-xs text-emerald-700 hover:underline">
                Kelola
              </a>
            </div>

            @php
              $latestArticles = \App\Models\Article::latest('published_date')->limit(3)->get();
            @endphp
            <ul class="space-y-3 text-sm">
              @forelse ($latestArticles as $article)
              <li class="border border-slate-100 rounded-xl p-3">
                <p class="font-medium text-slate-800 text-sm line-clamp-2">
                  {{ $article->title }}
                </p>
                <p class="text-xs text-slate-500 mt-1">
                  {{ $article->category }} · {{ $article->published_date ? $article->published_date->translatedFormat('j M Y') : '-' }}
                  @if ($article->is_published)
                    <span class="ml-1 text-emerald-600">· Terbit</span>
                  @else
                    <span class="ml-1 text-slate-400">· Draf</span>
                  @endif
                </p>
              </li>
              @empty
              <li class="py-4 text-center text-slate-400 text-xs">Belum ada artikel.</li>
              @endforelse
            </ul>
          </div>
        </div>

        <!-- Baris terakhir: ringkasan analisis & info program -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <!-- Ringkasan hasil analisis -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4">
            <h2 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">insights</span>
              Ringkasan hasil analisis
            </h2>
            @php
              $pctNormal  = $totalMeasurements > 0 ? round($totalNormal / $totalMeasurements * 100) : 0;
              $pctPendek  = $totalMeasurements > 0 ? round($totalPendek / $totalMeasurements * 100) : 0;
              $pctSangat  = $totalMeasurements > 0 ? round($totalSangatPendek / $totalMeasurements * 100) : 0;
            @endphp
            <div class="space-y-3 text-sm">
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Normal</span>
                <div class="flex items-center gap-2">
                  <div class="w-24 h-2 rounded-full bg-emerald-100">
                    <div class="h-2 rounded-full bg-emerald-500" style="width: {{ $pctNormal }}%;"></div>
                  </div>
                  <span class="text-xs text-slate-500">{{ $pctNormal }}%</span>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Pendek</span>
                <div class="flex items-center gap-2">
                  <div class="w-24 h-2 rounded-full bg-amber-100">
                    <div class="h-2 rounded-full bg-amber-500" style="width: {{ $pctPendek }}%;"></div>
                  </div>
                  <span class="text-xs text-slate-500">{{ $pctPendek }}%</span>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Sangat Pendek</span>
                <div class="flex items-center gap-2">
                  <div class="w-24 h-2 rounded-full bg-rose-100">
                    <div class="h-2 rounded-full bg-rose-500" style="width: {{ $pctSangat }}%;"></div>
                  </div>
                  <span class="text-xs text-slate-500">{{ $pctSangat }}%</span>
                </div>
              </div>
              <p class="text-xs text-slate-500 mt-2">
                Berdasarkan {{ $totalMeasurements }} data skrining yang tercatat. Detail dapat dilihat di menu "Analisis".
              </p>
            </div>
          </div>

          <!-- Info program -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4">
            <h2 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">health_and_safety</span>
              Catatan program
            </h2>
            <p class="text-sm text-slate-700 leading-relaxed mb-3">
              Dashboard ini dirancang sederhana agar mudah digunakan oleh dosen, mitra, dan kader Aisyiyah. Fokus utama adalah memantau konten edukasi dan pemanfaatan kalkulator stunting.
            </p>
            <ul class="text-sm text-slate-700 space-y-1.5">
              <li class="flex items-start gap-2">
                <span class="material-symbols-rounded text-base text-emerald-600 mt-0.5">check_circle</span>
                <span>Konten edukasi terstruktur dan mudah dicari.</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="material-symbols-rounded text-base text-emerald-600 mt-0.5">check_circle</span>
                <span>Data analisis dapat digunakan untuk laporan penelitian dan pengabdian.</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="material-symbols-rounded text-base text-emerald-600 mt-0.5">check_circle</span>
                <span>Tampilan ringan, responsif, dan nyaman untuk presentasi.</span>
              </li>
            </ul>
          </div>
        </div>

      </section>
    </div>
  </main>
</body>
</html>