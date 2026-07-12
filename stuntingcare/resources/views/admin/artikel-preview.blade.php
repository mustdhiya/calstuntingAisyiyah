@php
  if (!function_exists('markdownToHtml')) {
      function markdownToHtml($text) {
          if (!$text) return '';
          // Simple Markdown parser
          $html = e($text);
          $html = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $html);
          $html = preg_replace('/^## (.*)$/m', '<h2>$1</h2>', $html);
          $html = preg_replace('/^# (.*)$/m', '<h1>$1</h1>', $html);
          $html = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $html);
          $html = preg_replace('/`([^`]+)`/', '<code>$1</code>', $html);
          $html = preg_replace('/^\s*-\s+(.*)$/m', '<li>$1</li>', $html);

          // Wrap adjacent li elements in ul
          $html = preg_replace('/(<li>.*?<\/li>)/s', '<ul>$1</ul>', $html);
          
          // Paragraphs
          $lines = explode("\n\n", $html);
          foreach ($lines as &$line) {
              $line = trim($line);
              if (empty($line)) continue;
              if (strpos($line, '<h') === 0 || strpos($line, '<ul>') === 0 || strpos($line, '<li>') === 0) {
                  continue;
              }
              $line = '<p>' . nl2br($line) . '</p>';
          }
          return implode("\n\n", $lines);
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
  <title>[Pratinjau] {{ $article->title }} — SiCegah Stunting</title>
  <meta name="description" content="Halaman pratinjau internal admin." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    rel="icon"
    type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='8' y='8' width='48' height='48' rx='14' fill='%2316a34a'/%3E%3Cpath d='M32 18c-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 18.8 18c-3.5 0-6.3 2.8-6.3 6.3 0 2 .9 3.9 2.4 5.1L32 45l17.1-15.6a6.26 6.26 0 0 0 2.1-4.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 32 18Z' fill='white'/%3E%3Cpath d='M29 24h6v6h6v6h-6v6h-6v-6h-6v-6h6z' fill='%2316a34a'/%3E%3C/svg%3E"
    sizes="any"
  />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/user/global.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user/edukasi.css') }}" />
</head>
<body class="bg-slate-50 text-slate-800">

  <!-- Banner Pratinjau Admin Khusus -->
  <div class="bg-amber-500 text-white text-center py-2.5 px-4 text-xs font-semibold flex items-center justify-center gap-1.5 z-[100] relative shadow-sm" style="background-color: #f59e0b;">
    <span class="material-symbols-rounded text-sm">visibility</span>
    <span><strong>MODE PRATINJAU ADMIN</strong> — Artikel ini masih berstatus <strong>{{ strtoupper($article->status) }}</strong> (tidak terlihat oleh publik).</span>
  </div>

  <!-- Navbar Replikasi Publik -->
  <header class="navbar bg-white border-b border-slate-200 sticky top-0 z-50 px-4 lg:px-8">
    <div class="navbar-start">
      <div class="flex items-center gap-3 select-none">
        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center">
          <span class="material-symbols-rounded">health_and_safety</span>
        </div>
        <div>
          <div class="font-extrabold text-emerald-700">SiCegah Stunting</div>
          <div class="text-xs text-slate-500">Edukasi dan Skrining Awal</div>
        </div>
      </div>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal gap-1 font-medium disabled opacity-60 pointer-events-none">
        <li><a>Beranda</a></li>
        <li><a>Kalkulator</a></li>
        <li><a class="text-emerald-700 font-semibold">Edukasi</a></li>
        <li><a>Tentang</a></li>
        <li><a>FAQ</a></li>
        <li><a>Kontak</a></li>
      </ul>
    </div>
    <div class="navbar-end gap-2">
      <button onclick="window.close()" class="btn btn-neutral rounded-full btn-sm px-4">
        <span class="material-symbols-rounded text-sm">close</span> Tutup Pratinjau
      </button>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 lg:px-8 py-10">
    <div class="alert alert-warning bg-amber-50 border-amber-200 text-amber-950 rounded-2xl p-4 flex gap-3 items-start mb-6 text-sm">
      <span class="material-symbols-rounded text-amber-600 mt-0.5">info</span>
      <div>
        <span class="font-bold">Info Pratinjau:</span> Anda sedang melihat artikel ini dengan tampilan yang sama persis seperti yang akan dibaca oleh pengunjung umum. Gunakan tombol di pojok kanan atas untuk kembali.
      </div>
    </div>

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
          @if($article->image)
            <img src="{{ Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="object-cover w-full h-full" />
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
            <div class="text-xs text-slate-600 space-y-1 mt-2 leading-relaxed whitespace-pre-line">
              @php
                $safeReferences = e($article->references);
                $linkedReferences = preg_replace(
                    '#(https?://[^\s<>]+)#i',
                    '<a href="$1" target="_blank" class="text-emerald-600 hover:underline break-all">$1</a>',
                    $safeReferences
                );
              @endphp
              {!! $linkedReferences !!}
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
                <div class="block p-3 rounded-2xl bg-slate-50 font-medium text-xs text-slate-700 select-none">
                  {{ $related->title }}
                </div>
              @empty
                <p class="text-xs text-slate-400">Tidak ada artikel terkait.</p>
              @endforelse
            </div>
          </div>
        </div>

      </aside>

    </article>
  </main>

  <!-- Footer Replikasi Publik -->
  <footer class="footer p-10 bg-slate-900 text-slate-200 mt-16 select-none">
    <nav>
      <h6 class="footer-title">Navigasi</h6>
      <a class="link link-hover">Beranda</a>
      <a class="link link-hover">Kalkulator</a>
      <a class="link link-hover">Tentang</a>
    </nav>
    <nav>
      <h6 class="footer-title">Halaman</h6>
      <a class="link link-hover">Edukasi</a>
      <a class="link link-hover">FAQ</a>
      <a class="link link-hover">Kontak</a>
    </nav>
    <aside>
      <div class="flex items-center gap-2 text-white font-extrabold text-sm mb-2">
        <span class="material-symbols-rounded text-emerald-500">health_and_safety</span> SiCegah Stunting
      </div>
      <p class="text-xs text-slate-400">© 2026 calstuntingAisyiyah. Hak Cipta Dilindungi.</p>
    </aside>
  </footer>

</body>
</html>
