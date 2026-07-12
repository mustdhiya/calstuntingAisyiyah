
<!DOCTYPE html>
<html lang="id" data-theme="corporate">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Peta Interaktif Kalimantan Timur — GIS Viewer</title>
<meta name="description" content="Visualisasi peta interaktif wilayah administrasi Provinsi Kalimantan Timur." />
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<link
    rel="icon"
    type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='8' y='8' width='48' height='48' rx='14' fill='%2316a34a'/%3E%3Cpath d='M32 18c-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 18.8 18c-3.5 0-6.3 2.8-6.3 6.3 0 2 .9 3.9 2.4 5.1L32 45l17.1-15.6a6.26 6.26 0 0 0 2.1-4.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 32 18Z' fill='white'/%3E%3Cpath d='M29 24h6v6h6v6h-6v6h-6v-6h-6v-6h6z' fill='%2316a34a'/%3E%3C/svg%3E"
    sizes="any"
  />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24..48,400,1,0" rel="stylesheet" />
<link href="{{ asset('css/admin/analisis-peta.css') }}" rel="stylesheet" />
</head>
<body class="bg-slate-200 relative">
<header class="absolute top-0 left-0 z-30 p-4 flex items-center gap-2">
  <a href="{{ route('admin.analisis') }}" class="w-9 h-9 rounded-xl bg-white text-slate-700 hover:bg-slate-100 flex items-center justify-center shadow border border-slate-200" title="Kembali ke Halaman Analisis">
    <span class="material-symbols-rounded text-lg">arrow_back</span>
  </a>
  <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow">
    <span class="material-symbols-rounded text-lg">map</span>
  </div>
  <div class="bg-white/90 backdrop-blur rounded-xl px-3 py-1.5 shadow-sm border border-slate-200">
    <p class="text-xs font-semibold text-slate-800 leading-none">Kalimantan Timur</p>
    <p class="text-[10px] text-slate-500 leading-none mt-0.5">Peta Interaktif Wilayah</p>
  </div>
</header>
<div id="map"></div>
<div id="info-panel" class="floating-panel absolute top-4 right-4 z-30 w-64 rounded-2xl border border-slate-200 shadow-lg p-4 hidden">
  <div class="flex items-center justify-between mb-2">
    <span id="panel-status-badge" class="badge badge-sm rounded-full text-[10px] font-semibold px-2 py-2"></span>
    <span id="panel-rank" class="text-[10px] text-slate-400 font-medium"></span>
  </div>
  <h3 id="panel-nama" class="text-sm font-bold text-slate-900 mb-2">—</h3>
  <div class="space-y-1.5 text-xs">
    <div class="flex justify-between"><span class="text-slate-500">Nilai</span><span id="panel-nilai" class="font-semibold text-slate-800">—</span></div>
    <div class="flex justify-between"><span class="text-slate-500">Persentase</span><span id="panel-persen" class="font-semibold text-slate-800">—</span></div>
    <div class="flex justify-between"><span class="text-slate-500">Kontribusi</span><span id="panel-kontribusi" class="font-semibold text-slate-800">—</span></div>
  </div>
  <div class="mt-3 pt-2 border-t border-slate-100">
    <progress id="panel-progress" class="progress progress-success w-full h-1.5" value="0" max="100"></progress>
  </div>
</div>
<div class="absolute bottom-4 left-4 z-30 bg-white/90 backdrop-blur rounded-xl border border-slate-200 shadow-sm px-3 py-2">
  <p class="text-[10px] font-semibold text-slate-600 mb-1">Skala Nilai</p>
  <div class="flex items-center gap-1.5"><span class="w-24 h-2.5 rounded-full" style="background:linear-gradient(to right,#ecfdf5,#6ee7b7,#059669,#064e3b);"></span></div>
  <div class="flex justify-between text-[9px] text-slate-400 mt-0.5"><span>Rendah</span><span>Tinggi</span></div>
</div>
<div id="map-status" class="absolute inset-0 z-40 flex items-center justify-center bg-slate-100/80">
  <div class="flex items-center gap-2 text-slate-500 text-sm"><span class="loading loading-spinner loading-sm"></span><span id="map-status-text">Memuat peta...</span></div>
</div>
<script src="{{ asset('js/admin/analisis-peta.js') }}"></script>
</body>
</html>