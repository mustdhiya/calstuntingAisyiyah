@php
  if (!function_exists('getArticleIcon')) {
      function getArticleIcon($title, $category) {
          $title = strtolower($title);
          $category = strtolower($category);
          
          if (str_contains($title, 'protein') || str_contains($title, 'makan') || str_contains($title, 'besi')) {
              return 'restaurant';
          }
          if (str_contains($title, 'asi eksklusif') || str_contains($title, 'menyusui') || str_contains($title, 'perah')) {
              return 'child_care';
          }
          if (str_contains($title, 'mpasi')) {
              return 'lunch_dining';
          }
          if (str_contains($title, 'posyandu') || str_contains($title, 'imunisasi')) {
              return 'vaccines';
          }
          if (str_contains($title, 'ibu hamil') || str_contains($title, 'gizi ibu') || str_contains($title, 'kesehatan ibu')) {
              return 'pregnant_woman';
          }
          if (str_contains($title, 'sanitasi') || str_contains($title, 'bersih')) {
              return 'water_drop';
          }
          if (str_contains($title, 'pendidikan') || str_contains($title, 'sekolah')) {
              return 'school';
          }
          if (str_contains($title, 'grafik') || str_contains($title, 'timbang') || str_contains($title, 'tinggi badan')) {
              return 'monitor_heart';
          }
          if (str_contains($title, 'keluarga') || str_contains($title, 'asuh')) {
              return 'family_restroom';
          }
          
          // Fallbacks based on category
          if (str_contains($category, 'gizi')) return 'restaurant';
          if (str_contains($category, 'asi')) return 'child_care';
          if (str_contains($category, 'mpasi')) return 'lunch_dining';
          if (str_contains($category, 'stunting') || str_contains($category, 'pencegahan')) return 'vaccines';
          if (str_contains($category, 'ibu')) return 'pregnant_woman';
          return 'article';
      }
  }

  $columnThemes = [
      0 => [
          'bg' => 'bg-[#eafaf1]', 
          'iconColor' => 'text-[#16a34a]', 
          'badge' => 'border-[#bbf7d0] text-[#15803d] bg-[#f0fdf4]'
      ],
      1 => [
          'bg' => 'bg-[#ebf5fb]', 
          'iconColor' => 'text-[#2980b9]', 
          'badge' => 'border-[#d2e4f1] text-[#1b4f72] bg-[#f4f9fd]'
      ],
      2 => [
          'bg' => 'bg-[#fef9e7]', 
          'iconColor' => 'text-[#d68910]', 
          'badge' => 'border-[#fdebd0] text-[#7e5109] bg-[#fefcf5]'
      ]
  ];
@endphp

<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edukasi Stunting — SiCegah Stunting</title>
  <meta name="description" content="Halaman edukasi berisi artikel gizi anak, ASI eksklusif, MPASI, pencegahan stunting, dan kesehatan ibu." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user/edukasi.css') }}" />
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
      <ul class="menu menu-horizontal gap-1 font-medium">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('kalkulator') }}">Kalkulator</a></li>
        <li><a class="text-emerald-700 font-semibold" href="{{ route('edukasi') }}">Edukasi</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('faq') }}">FAQ</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
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

      <a href="{{ route('artikel.detail', 'protein-hewani-harian-untuk-pertumbuhan-optimal-anak') }}" class="btn bg-blue-600 hover:bg-blue-700 text-white border-0 rounded-full px-5 btn-sm font-semibold">
        Buka Artikel
      </a>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
    <section class="mb-8">
      <div class="badge badge-info badge-outline mb-3">Pusat Edukasi</div>
      <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Artikel edukasi untuk orang tua dan kader kesehatan</h1>
      <p class="text-slate-600 mt-3 text-sm max-w-3xl">Konten disusun dengan bahasa formal yang mudah dipahami agar dapat digunakan sebagai media literasi digital dan bahan komunikasi kesehatan.</p>
    </section>

    <!-- Search and Filter Section -->
    <section class="card bg-white border border-slate-200 shadow-sm mb-8">
      <div class="card-body gap-4">
        <form method="GET" action="{{ route('edukasi') }}" class="form-control">
          <label class="input input-bordered flex items-center gap-2">
            <span class="material-symbols-rounded text-slate-500">search</span>
            <input type="text" name="search" class="grow text-sm" placeholder="Cari artikel, misalnya: MPASI, ASI, atau gizi anak" value="{{ request('search') }}" />
          </label>
        </form>

        <div class="flex flex-wrap gap-2">
          @php $activeCategory = request('category'); @endphp
          <a href="{{ route('edukasi', array_merge(request()->except('category', 'page'), [])) }}"
            class="btn btn-sm rounded-full {{ !$activeCategory ? 'bg-[#4f46e5] text-white border-0' : 'btn-outline border-slate-200 hover:bg-slate-100 hover:text-slate-800' }}">Semua</a>

          @foreach(['Gizi Anak', 'ASI Eksklusif', 'MPASI', 'Pencegahan Stunting', 'Kesehatan Ibu'] as $cat)
            <a href="{{ route('edukasi', array_merge(request()->except('page'), ['category' => $cat])) }}"
              class="btn btn-sm rounded-full {{ $activeCategory === $cat ? 'bg-[#4f46e5] text-white border-0' : 'btn-outline border-slate-200 hover:bg-slate-100 hover:text-slate-800' }}">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Articles Grid -->
    <section>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $index => $article)
          @php
            $theme = $columnThemes[$index % 3];
            $icon = getArticleIcon($article->title, $article->category);
          @endphp
          <article class="card bg-white shadow-sm border border-slate-200 rounded-[2rem] overflow-hidden flex flex-col justify-between h-full">
            <figure class="h-48 overflow-hidden relative">
              @if($article->image)
                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="object-cover w-full h-full transition-transform duration-300 hover:scale-105" />
              @else
                <div class="w-full h-full {{ $theme['bg'] }} flex items-center justify-center">
                  <span class="material-symbols-rounded text-6xl {{ $theme['iconColor'] }}">{{ $icon }}</span>
                </div>
              @endif
            </figure>
            <div class="card-body p-6 flex flex-col justify-between flex-grow">
              <div>
                <div class="badge badge-sm border {{ $theme['badge'] }} rounded-full px-2.5 py-2 mb-3 text-[10px] font-semibold">
                  {{ $article->category }}
                </div>
                <h2 class="card-title text-base font-bold text-slate-800 leading-snug mb-2 hover:text-emerald-700">
                  <a href="{{ route('artikel.detail', $article->slug) }}">
                    {{ $article->title }}
                  </a>
                </h2>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">
                  {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}
                </p>
              </div>
              <div class="card-actions justify-end mt-auto">
                <a href="{{ route('artikel.detail', $article->slug) }}" class="text-xs font-bold text-slate-800 hover:text-emerald-700">
                  Baca
                </a>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-full bg-white border border-slate-200 rounded-3xl p-12 text-center text-slate-500">
            <span class="material-symbols-rounded text-5xl text-slate-300 mb-2">search_off</span>
            <p class="font-medium">Tidak ada artikel ditemukan</p>
            <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian atau kategori yang berbeda.</p>
          </div>
        @endforelse
      </div>

      <!-- Pagination Links -->
      <div class="mt-12 flex justify-center">
        {{ $articles->links() }}
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer p-10 bg-slate-900 text-slate-200 mt-16">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h6 class="footer-title">NAVIGASI</h6>
        <div class="flex flex-col gap-2 mt-2 text-sm text-slate-400">
          <a class="hover:underline" href="{{ route('home') }}">Beranda</a>
          <a class="hover:underline" href="{{ route('kalkulator') }}">Kalkulator</a>
          <a class="hover:underline" href="{{ route('tentang') }}">Tentang</a>
        </div>
      </div>
      <div>
        <h6 class="footer-title">HALAMAN</h6>
        <div class="flex flex-col gap-2 mt-2 text-sm text-slate-400">
          <a class="hover:underline" href="{{ route('artikel.detail', 'protein-hewani-harian-untuk-pertumbuhan-optimal-anak') }}">Detail Artikel</a>
          <a class="hover:underline" href="{{ route('faq') }}">FAQ</a>
          <a class="hover:underline" href="{{ route('kontak') }}">Kontak</a>
        </div>
      </div>
      <div class="text-xs text-slate-400 leading-relaxed">
        <p>Konten dummy realistis untuk presentasi prototipe.</p>
      </div>
    </div>
  </footer>
</body>
</html>
