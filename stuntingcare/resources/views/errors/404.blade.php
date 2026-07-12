<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Tidak Ditemukan - SiCegah Stunting</title>
  <meta name="description" content="Halaman 404 SiCegah Stunting ketika halaman yang dicari tidak ditemukan." />

  <!-- Favicon SVG custom, konsisten dengan icon health_and_safety -->
  <link
    rel="icon"
    type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='8' y='8' width='48' height='48' rx='14' fill='%2316a34a'/%3E%3Cpath d='M32 18c-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 18.8 18c-3.5 0-6.3 2.8-6.3 6.3 0 2 .9 3.9 2.4 5.1L32 45l17.1-15.6a6.26 6.26 0 0 0 2.1-4.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 32 18Z' fill='white'/%3E%3Cpath d='M29 24h6v6h6v6h-6v6h-6v-6h-6v-6h6z' fill='%2316a34a'/%3E%3C/svg%3E"
    sizes="any"
  />

  <!-- Optional fallback -->
  <meta name="theme-color" content="#16a34a" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: Inter, sans-serif;
    }
    .material-symbols-rounded {
      font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">
  <main class="hero min-h-screen bg-gradient-to-br from-emerald-50 via-white to-cyan-50 px-4">
    <div class="hero-content text-center">
      <div class="max-w-xl">
        <div class="w-28 h-28 rounded-[2rem] bg-white shadow-lg border border-slate-200 flex items-center justify-center mx-auto mb-6">
          <span class="material-symbols-rounded text-[72px] text-emerald-700">search_off</span>
        </div>

        <h1 class="text-5xl font-extrabold">404</h1>
        <p class="py-4 text-lg text-slate-600">
          Halaman yang Anda cari tidak ditemukan. Tautan mungkin berubah atau halaman belum tersedia.
        </p>

        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-full">
          Kembali ke Beranda
        </a>
      </div>
    </div>
  </main>
</body>
</html>