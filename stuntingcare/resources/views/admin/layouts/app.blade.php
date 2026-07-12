<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Panel') — SiCegah Stunting</title>
  <meta name="description" content="@yield('description', 'Panel admin untuk SiCegah Stunting Aisyiyah Kalimantan Timur.')" />

  <!-- Font & Icon -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    rel="icon"
    type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='8' y='8' width='48' height='48' rx='14' fill='%2316a34a'/%3E%3Cpath d='M32 18c-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 18.8 18c-3.5 0-6.3 2.8-6.3 6.3 0 2 .9 3.9 2.4 5.1L32 45l17.1-15.6a6.26 6.26 0 0 0 2.1-4.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 32 18Z' fill='white'/%3E%3Cpath d='M29 24h6v6h6v6h-6v6h-6v-6h-6v-6h6z' fill='%2316a34a'/%3E%3C/svg%3E"
    sizes="any"
  />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24..48,400,0..1,0..200" rel="stylesheet" />

  <!-- Tailwind + DaisyUI (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="{{ asset('css/admin/global.css') }}" />
  @yield('styles')
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
          <div class="text-xs text-slate-500">Kelola konten &amp; analisis</div>
        </div>
      </a>

      <div class="flex items-center gap-3">
        @auth
          <div class="hidden sm:flex items-center gap-2 text-xs text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full">
            <span class="material-symbols-rounded text-sm">account_circle</span>
            {{ Auth::user()->name }}
            <span class="text-slate-400">·</span>
            <span class="capitalize text-emerald-700 font-medium">{{ str_replace('_', ' ', Auth::user()->role) }}</span>
          </div>
        @endauth
        <a href="{{ route('home') }}" class="btn btn-outline btn-sm rounded-full">
          <span class="material-symbols-rounded text-sm">open_in_new</span>
          Lihat Website
        </a>
        @auth
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm rounded-full text-slate-500 hover:text-red-600 hover:bg-red-50">
              <span class="material-symbols-rounded text-sm">logout</span>
              <span class="hidden sm:inline">Keluar</span>
            </button>
          </form>
        @endauth
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
            @php
              $activeClass = 'bg-emerald-50 text-emerald-700 font-medium';
              $inactiveClass = 'text-slate-600 hover:bg-slate-100';
            @endphp
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }}">
              <span class="material-symbols-rounded text-sm">dashboard</span>
              Dashboard
            </a>
            <a href="{{ route('admin.artikel.list') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ request()->routeIs('admin.artikel.*') ? $activeClass : $inactiveClass }}">
              <span class="material-symbols-rounded text-sm">article</span>
              Artikel edukasi
            </a>
            <a href="{{ route('admin.analisis') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ request()->routeIs('admin.analisis') ? $activeClass : $inactiveClass }}">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis
            </a>
            <a href="{{ route('admin.hasil-analisis-risiko') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ request()->routeIs('admin.hasil-analisis-risiko') ? $activeClass : $inactiveClass }}">
              <span class="material-symbols-rounded text-sm">tune</span>
              Simulasi Risiko
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl {{ request()->routeIs('admin.pengguna') ? $activeClass : $inactiveClass }}">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna
            </a>
          </nav>
        </div>

        @section('sidebar-extra')
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
        @show
      </aside>

      <!-- Main content -->
      <section class="lg:col-span-9 space-y-4">
        @yield('content')
      </section>

    </div>
  </main>

  @yield('scripts')
</body>
</html>
