@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
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

@endsection