@php
  if (!function_exists('markdownToHtml')) {
      function markdownToHtml($text) {
          if (!$text) return '';
          
          // Escape HTML bawaan agar aman
          $html = e($text);
          
          // 1. Headings (###, ##, #)
          $html = preg_replace('/^### (.*)$/m', '<h3 class="text-lg font-bold text-slate-800 mt-4 mb-2">$1</h3>', $html);
          $html = preg_replace('/^## (.*)$/m', '<h2 class="text-xl font-bold text-slate-900 mt-6 mb-3 border-b pb-1">$1</h2>', $html);
          $html = preg_replace('/^# (.*)$/m', '<h1 class="text-2xl font-extrabold text-slate-900 mt-6 mb-4">$1</h1>', $html);
          
          // 2. Bold & Italic (*, **)
          $html = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $html);
          $html = preg_replace('/\*([^\*]+)\*/s', '<em>$1</em>', $html);
          
          // 3. Blockquotes (>)
          $html = preg_replace('/^&gt;\s?(.*)$/m', '<blockquote class="border-l-4 border-emerald-500 pl-4 py-2 italic bg-emerald-50/50 rounded-r my-3">$1</blockquote>', $html);
          
          // 4. Bullet Points (* atau -)
          $html = preg_replace('/^\s*[\*\-]\s+(.*)$/m', '<li class="ml-4 list-disc">$1</li>', $html);
          
          // 5. Wrap Paragraf
          $lines = explode("\n\n", $html);
          foreach ($lines as &$line) {
              $line = trim($line);
              if (empty($line)) continue;
              // Jika bukan tag HTML khusus, bungkus <p>
              if (!preg_match('/^<(h[1-6]|ul|ol|li|blockquote|div)/i', $line)) {
                  $line = '<p class="mb-3 leading-relaxed">' . nl2br($line) . '</p>';
              }
          }
          return implode("\n", $lines);
      }
  }

  $categoryThemes = [
      'Gizi Anak'           => ['icon' => 'restaurant',     'bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'badge' => 'badge-success'],
      'ASI Eksklusif'       => ['icon' => 'child_care',     'bg' => 'bg-cyan-100',    'text' => 'text-cyan-700',    'badge' => 'badge-info'],
      'MPASI'               => ['icon' => 'lunch_dining',    'bg' => 'bg-amber-100',   'text' => 'text-amber-700',   'badge' => 'badge-warning'],
      'Pencegahan Stunting' => ['icon' => 'shield_with_heart','bg' => 'bg-indigo-100',  'text' => 'text-indigo-700',  'badge' => 'badge-primary'],
      'Kesehatan Ibu'       => ['icon' => 'pregnant_woman',  'bg' => 'bg-pink-100',    'text' => 'text-pink-700',    'badge' => 'badge-secondary'],
      'FAQ'                 => ['icon' => 'help',           'bg' => 'bg-purple-100',  'text' => 'text-purple-700',  'badge' => 'badge-ghost'],
  ];
  $theme = $categoryThemes[$article->category] ?? ['icon' => 'article', 'bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'badge' => 'badge-ghost'];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $article->title }} — SiCegah Stunting</title>
  <meta name="description" content="{{ $article->summary ?? 'Detail artikel edukasi tentang pencegahan stunting.' }}" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=2') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico?v=2') }}">
<link rel="apple-touch-icon" href="{{ asset('img/logo.png?v=2') }}">

  
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
            <div class="w-11 h-11 rounded-2xl bg-white shadow-sm border border-slate-200 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('img/logo.png') }}" alt="Logo SiCegah Stunting" class="w-9 h-9 object-contain">
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

      <a href="{{ route('edukasi') }}" class="btn btn-outline btn-primary rounded-full btn-sm px-4">
        <span class="material-symbols-rounded text-sm">arrow_back</span> Kembali ke Edukasi
      </a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 lg:px-8 py-10">
    <article class="grid lg:grid-cols-3 gap-8">
      
      <!-- Left Column: Article Content -->
      <div class="lg:col-span-2 space-y-6">
        <div>
          <div class="badge {{ $theme['badge'] }} badge-outline mb-3 text-xs font-semibold">{{ $article->category }}</div>
          <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">
            {{ $article->title }}
          </h1>
          <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500 mt-4">
            <span class="flex items-center gap-1">
              <span class="material-symbols-rounded text-sm text-slate-400">calendar_month</span>
              {{ $article->published_date ? $article->published_date->format('d M Y') : $article->created_at->format('d M Y') }}
            </span>
            <span class="flex items-center gap-1">
              <span class="material-symbols-rounded text-sm text-slate-400">person</span>
              {{ $article->author_name }}
            </span>
            <span class="flex items-center gap-1">
              <span class="material-symbols-rounded text-sm text-slate-400">schedule</span>
              {{ $article->read_time }} menit baca
            </span>
          </div>
        </div>

        <!-- Featured Image (Real Image or Fallback) -->
        <figure class="rounded-3xl overflow-hidden border border-slate-200 h-80 relative">
          @if($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="object-cover w-full h-full" />
          @else
            <div class="w-full h-full {{ $theme['bg'] }} flex items-center justify-center">
              <span class="material-symbols-rounded text-[84px] {{ $theme['text'] }}">{{ $theme['icon'] }}</span>
            </div>
          @endif
        </figure>

        @if($article->summary)
        <div class="alert alert-info bg-sky-50 border-sky-100 text-sky-900 rounded-2xl p-4 flex gap-3 items-start">
          <span class="material-symbols-rounded text-sky-600 mt-0.5">lightbulb</span>
          <div class="text-xs leading-relaxed">
            <span class="font-bold">Ringkasan:</span> {{ $article->summary }}
          </div>
        </div>
        @endif

        <!-- Body Content -->
        <div class="prose prose-slate max-w-none bg-white p-6 md:p-8 rounded-3xl border border-slate-200 shadow-sm text-slate-700">
          {!! markdownToHtml($article->content) !!}
        </div>
      </div>

      <!-- Right Column: Sidebar -->
      <aside class="space-y-6">
        
        <!-- Tips Card -->
        <div class="card bg-amber-50 border border-amber-100 shadow-sm rounded-3xl">
          <div class="card-body p-5">
            <h2 class="card-title text-amber-800 text-sm font-bold flex items-center gap-1">
              <span class="material-symbols-rounded text-base text-amber-600">tips_and_updates</span>
              Tips Praktis Kesehatan
            </h2>
            <ul class="space-y-2 text-xs text-amber-900 list-disc pl-4 mt-2 leading-relaxed">
              <li>Mulai dari menu yang disukai anak secara bertahap.</li>
              <li>Pilih bahan lokal berkualitas yang segar dan bersih.</li>
              <li>Lakukan pencatatan berkala terhadap tinggi/berat badan anak.</li>
              <li>Konsultasikan perkembangan anak dengan kader Posyandu.</li>
            </ul>
          </div>
        </div>

        <!-- References Card -->
        @if($article->references)
        <div class="card bg-white border border-slate-200 shadow-sm rounded-3xl">
          <div class="card-body p-5">
            <h2 class="card-title text-slate-800 text-sm font-bold flex items-center gap-1">
              <span class="material-symbols-rounded text-base text-slate-500">bookmark</span>
              Referensi Artikel
            </h2>
            <div class="text-xs text-slate-600 mt-2 leading-relaxed">
              {!! markdownToHtml($article->references) !!}
            </div>
          </div>
        </div>
        @endif

        <!-- Related Articles Card -->
        <div class="card bg-white border border-slate-200 shadow-sm rounded-3xl">
          <div class="card-body p-5">
            <h2 class="card-title text-slate-800 text-sm font-bold">Artikel Terkait</h2>
            <div class="space-y-3 mt-3">
              @forelse($relatedArticles as $related)
                <a href="{{ route('artikel.detail', $related->slug) }}" class="block p-3 rounded-2xl bg-slate-50 hover:bg-emerald-50 hover:text-emerald-800 transition-all font-medium text-xs text-slate-700">
                  {{ $related->title }}
                </a>
              @empty
                <p class="text-xs text-slate-400">Tidak ada artikel terkait.</p>
              @endforelse
            </div>
          </div>
        </div>

      </aside>

    </article>
  </main>

  <!-- Footer -->
  <footer class="footer p-10 bg-slate-900 text-slate-200 mt-16">
    <nav>
      <h6 class="footer-title">Navigasi</h6>
      <a class="link link-hover" href="{{ route('home') }}">Beranda</a>
      <a class="link link-hover" href="{{ route('kalkulator') }}">Kalkulator</a>
      <a class="link link-hover" href="{{ route('tentang') }}">Tentang</a>
    </nav>
    <nav>
      <h6 class="footer-title">Halaman</h6>
      <a class="link link-hover" href="{{ route('edukasi') }}">Edukasi</a>
      <a class="link link-hover" href="{{ route('faq') }}">FAQ</a>
      <a class="link link-hover" href="{{ route('kontak') }}">Kontak</a>
    </nav>
    <aside>
      <div class="flex items-center gap-2 text-white font-extrabold text-sm mb-2">
        <span class="material-symbols-rounded text-emerald-500">health_and_safety</span> SiCegah Stunting
      </div>
      <p class="text-xs text-slate-400">� 2026 calstuntingAisyiyah. Hak Cipta Dilindungi.</p>
    </aside>
  </footer>

</body>
</html>
