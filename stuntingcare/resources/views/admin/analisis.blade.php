<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Analisis - Admin SiCegah Stunting</title>
  <meta name="description" content="Panel admin untuk melihat dan mereview hasil analisis kalkulator stunting." />

  <!-- Font & Icon -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24..48,400,0..1,0..200" rel="stylesheet" />

  <!-- Tailwind + DaisyUI (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    .material-symbols-rounded {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      vertical-align: middle;
    }
    .badge-status-normal   { background-color: #E8F5E9; color:#2E7D32; }
    .badge-status-risiko   { background-color: #FFF3E0; color:#E65100; }
    .badge-status-stunting { background-color:#FFEBEE; color:#C62828; }
    .badge-status-berat    { background-color:#FFEBEE; color:#B71C1C; }
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
          <div class="text-xs text-slate-500">Kelola konten & analisis</div>
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">dashboard</span>
              Dashboard
            </a>
            <a href="{{ route('admin.artikel.list') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">article</span>
              Artikel edukasi
            </a>
            <a href="{{ route('admin.analisis') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 font-medium">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna
            </a>
          </nav>
        </div>

        <div class="bg-sky-50 border border-sky-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-sky-600 text-base">insights</span>
            <div>
              <h2 class="text-sm font-semibold text-sky-900">Tips analisis</h2>
              <p class="text-xs text-sky-800 mt-1 leading-relaxed">
                Perhatikan tren usia dan status risiko. Data ini membantu menentukan fokus edukasi dan intervensi di lapangan.
              </p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main content -->
      <section class="lg:col-span-9 space-y-4">
        
        <!-- ====== PETA KALIMANTAN TIMUR (GEOCHART) ====== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">map</span>
              Peta sebaran risiko per kabupaten/kota (Kaltim)
            </h2>
            <span class="text-[11px] text-slate-500">
              Warna lebih pekat = jumlah stunting lebih tinggi
            </span>
          </div>

          <!-- Container peta -->
          <div id="kaltim-map" class="w-full h-72 md:h-80 lg:h-96"></div>

          <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-slate-500">
            <div class="flex items-center gap-1">
              <span class="w-4 h-3 rounded-full"
                    style="background: linear-gradient(to right,#ecfdf3,#22c55e);"></span>
              <span>Jumlah stunting (rendah ? tinggi)</span>
            </div>
            <span class="flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">info</span>
              Arahkan kursor ke kabupaten/kota untuk melihat detail nilai
            </span>
          </div>
        </div>

        <!-- Header -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis kalkulator
            </p>
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
              Rekap hasil kalkulator risiko stunting
            </h1>
            <p class="text-xs text-slate-500 mt-1">
              Lihat ringkasan, filter data, dan review hasil per anak untuk tindak lanjut.
            </p>
          </div>
          <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.analisis.export') }}" class="btn btn-outline btn-sm rounded-full text-xs font-semibold">
              <span class="material-symbols-rounded text-sm">download</span>
              Ekspor CSV
            </a>
            <a href="{{ route('admin.analisis') }}" class="btn btn-primary btn-sm rounded-full text-xs font-semibold">
              <span class="material-symbols-rounded text-sm">refresh</span>
              Segarkan data
            </a>
          </div>
        </div>

        <!-- Ringkasan singkat + Chart komposisi -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
          <!-- Stats -->
          <div class="lg:col-span-1 space-y-4">
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <p class="text-xs text-slate-500 mb-1 flex items-center gap-1">
                <span class="material-symbols-rounded text-sm">summarize</span>
                Total pemeriksaan
              </p>
              <p class="text-2xl font-semibold text-slate-900">{{ $totalAll }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <p class="text-xs text-slate-500 mb-1 flex items-center gap-1">
                <span class="material-symbols-rounded text-sm">sentiment_satisfied</span>
                Normal
              </p>
              <p class="text-xl font-semibold text-emerald-700">{{ $totalNormal }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <p class="text-xs text-slate-500 mb-1 flex items-center gap-1">
                <span class="material-symbols-rounded text-sm">warning</span>
                Risiko & stunting
              </p>
              <p class="text-xl font-semibold text-amber-600">{{ $totalStunting }}</p>
            </div>
          </div>

          <!-- Chart komposisi status -->
          <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
            <div class="flex items-center justify-between mb-2">
              <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
                <span class="material-symbols-rounded text-sm text-slate-600">pie_chart</span>
                Komposisi status risiko
              </h2>
              <span class="text-[11px] text-slate-500">Data semua pemeriksaan</span>
            </div>
            <div class="h-56">
              <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-3 flex flex-wrap gap-2 text-[11px] text-slate-600">
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span> Normal
              </span>
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-amber-400"></span> Pendek (Stunting)
              </span>
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-rose-500"></span> Sangat Pendek (Stunting Berat)
              </span>
            </div>
          </div>
        </div>

        <!-- Filter & Pencarian -->
        <form method="GET" action="{{ route('admin.analisis') }}" class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
            <!-- Nama / ID -->
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium text-slate-700">Cari nama anak</span>
              </label>
              <div class="relative">
                <span class="material-symbols-rounded text-slate-400 text-base absolute left-3 top-1/2 -translate-y-1/2">search</span>
                <input
                  type="text"
                  name="search"
                  value="{{ $search }}"
                  class="input input-bordered w-full text-sm pl-9 h-10 min-h-10"
                  placeholder="Contoh: Axel"
                />
              </div>
            </div>
            <!-- Status -->
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium text-slate-700">Status risiko</span>
              </label>
              <select name="status" class="select select-bordered w-full text-sm h-10 min-h-10">
                <option value="">Semua status</option>
                <option value="Normal" {{ $status === 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Pendek" {{ $status === 'Pendek' ? 'selected' : '' }}>Pendek (Stunting)</option>
                <option value="Sangat Pendek" {{ $status === 'Sangat Pendek' ? 'selected' : '' }}>Sangat Pendek (Stunting Berat)</option>
              </select>
            </div>
            <!-- Rentang usia -->
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium text-slate-700">Usia (bulan)</span>
              </label>
              <div class="flex gap-2">
                <input type="number" name="age_min" value="{{ $ageMin }}" min="0" class="input input-bordered w-full text-sm h-10 min-h-10" placeholder="min" />
                <input type="number" name="age_max" value="{{ $ageMax }}" min="0" class="input input-bordered w-full text-sm h-10 min-h-10" placeholder="max" />
              </div>
            </div>
          </div>

          <div class="flex gap-2 shrink-0">
            <a href="{{ route('admin.analisis') }}" class="btn btn-ghost btn-sm rounded-full text-xs">
              <span class="material-symbols-rounded text-sm">restart_alt</span>
              Reset
            </a>
            <button type="submit" class="btn btn-primary btn-sm rounded-full text-xs">
              <span class="material-symbols-rounded text-sm">filter_alt</span>
              Terapkan
            </button>
          </div>
        </form>

        <!-- Chart distribusi usia -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">bar_chart</span>
              Distribusi usia per status
            </h2>
            <span class="text-[11px] text-slate-500">Kelompok usia (bulan)</span>
          </div>
          <div class="h-64">
            <canvas id="ageChart"></canvas>
          </div>
        </div>
        
        <!-- Tabel hasil -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-slate-900">Daftar hasil pemeriksaan</h2>
            <span class="text-xs text-slate-500">
              Menampilkan {{ $measurements->firstItem() ?? 0 }} - {{ $measurements->lastItem() ?? 0 }} dari {{ $measurements->total() }} data
            </span>
          </div>

          <div class="overflow-x-auto">
            <table class="table table-sm">
              <thead>
                <tr class="text-xs text-slate-500">
                  <th>No</th>
                  <th>Nama anak</th>
                  <th>Usia</th>
                  <th>JK</th>
                  <th>Status</th>
                  <th>TB/U</th>
                  <th>BB/U</th>
                  <th>Tgl cek</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="text-xs">
                @forelse($measurements as $index => $m)
                  <tr class="hover cursor-pointer" onclick="showQuickDetail({{ json_encode($m) }})">
                    <td>{{ $measurements->firstItem() + $index }}</td>
                    <td>
                      <span class="font-semibold text-slate-800">{{ $m->child_name }}</span>
                      <div class="text-[10px] text-slate-400">{{ substr($m->id, 0, 8) }}</div>
                    </td>
                    <td>{{ $m->age_months }} bln</td>
                    <td>{{ $m->gender }}</td>
                    <td>
                      @php
                        $badgeClass = match($m->status_growth) {
                          'Normal' => 'badge-status-normal',
                          'Pendek' => 'badge-status-risiko',
                          'Sangat Pendek' => 'badge-status-stunting',
                          default => 'badge-status-normal'
                        };
                      @endphp
                      <span class="badge {{ $badgeClass }} border-none px-2 py-0.5 text-[10px] rounded-full">
                        {{ $m->status_growth }}
                      </span>
                    </td>
                    <td>{{ $m->height }} cm</td>
                    <td>{{ $m->weight }} kg</td>
                    <td>{{ $m->created_at->format('d/m/Y') }}</td>
                    <td>
                      <button type="button" class="btn btn-ghost btn-xs rounded-full text-[10px] flex items-center gap-0.5" onclick="event.stopPropagation(); showQuickDetail({{ json_encode($m) }})">
                        <span class="material-symbols-rounded text-xs">visibility</span>
                        Detail
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center py-8 text-slate-400">Tidak ada data pemeriksaan ditemukan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="mt-4">
            {{ $measurements->links() }}
          </div>
        </div>

        <!-- Panel detail (review cepat) -->
        @php $defaultDetail = $measurements->first(); @endphp
        <div class="bg-white border border-slate-200 rounded-2xl p-4" id="detail-panel">
          <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">visibility</span>
              Detail singkat pemeriksaan terpilih
            </h2>
          </div>

          @if($defaultDetail)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
              <div class="space-y-1">
                <p class="text-slate-500">Nama anak</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-name">{{ $defaultDetail->child_name }}</p>
                <p class="text-[11px] text-slate-400" id="det-id">ID: {{ $defaultDetail->id }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-slate-500">Usia & jenis kelamin</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-age-gender">
                  {{ $defaultDetail->age_months }} bulan - {{ $defaultDetail->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </p>
              </div>
              <div class="space-y-1">
                <p class="text-slate-500">Tanggal pemeriksaan</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-date">{{ $defaultDetail->created_at->format('d F Y') }}</p>
              </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 text-xs">
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Status</p>
                @php
                  $defaultBadge = match($defaultDetail->status_growth) {
                    'Normal' => 'badge-status-normal',
                    'Pendek' => 'badge-status-risiko',
                    'Sangat Pendek' => 'badge-status-stunting',
                    default => 'badge-status-normal'
                  };
                @endphp
                <span class="badge {{ $defaultBadge }} border-none px-2 py-0.5 text-[11px] rounded-full" id="det-status-badge">
                  {{ $defaultDetail->status_growth }}
                </span>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Tinggi badan</p>
                <p class="font-semibold text-slate-900" id="det-tb">{{ $defaultDetail->height }} cm</p>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Berat badan</p>
                <p class="font-semibold text-slate-900" id="det-bb">{{ $defaultDetail->weight }} kg</p>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Kota</p>
                <p class="font-semibold text-slate-900" id="det-city">{{ $defaultDetail->city }}</p>
              </div>
            </div>

            <div class="mt-4 border-t border-slate-100 pt-3 text-xs">
              <p class="text-slate-500 mb-1">Catatan & rekomendasi tindakan</p>
              <p class="text-slate-700 leading-relaxed font-medium" id="det-recs">
                @if(in_array($defaultDetail->status_growth, ['Pendek', 'Sangat Pendek']))
                  Tinggi badan berdasarkan usia berada di bawah standar WHO. Rujuk ke layanan kesehatan/Puskesmas terdekat, berikan makanan padat kaya zat besi & protein hewani harian, serta pantau pertumbuhan berkala.
                @else
                  Pertumbuhan anak dalam batas normal. Pertahankan asupan gizi seimbang, ASI/MPASI berkualitas, dan imunisasi rutin.
                @endif
              </p>
            </div>
          @else
            <p class="text-xs text-slate-400">Belum ada data pemeriksaan terpilih.</p>
          @endif
        </div>

      </section>
    </div>
  </main>

  <!-- Apache ECharts (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

  <!-- Script Chart.js & ECharts (dashboard) -->
  <script>
    // === DATA DASHBOARD ===
    const totalNormal   = {{ $totalNormal }};
    const totalRisiko   = {{ $chartStatus['Pendek'] }};
    const totalStunting = {{ $chartStatus['Sangat Pendek'] }};
    const totalBerat    = 0; // standard grouped into stunting/sgt-pendek

    // Data per kab/kota Kaltim (heatmap stunting)
    const kaltimData = @json($mapData);

    // Mapping nama di GeoJSON -> nama yang dipakai di dashboard
    const nameMapping = {
      "KOTA SAMARINDA": "Samarinda",
      "KOTA BALIKPAPAN": "Balikpapan",
      "KOTA BONTANG": "Bontang",
      "KUTAI KARTANEGARA": "Kutai Kartanegara",
      "KUTAI TIMUR": "Kutai Timur",
      "KUTAI BARAT": "Kutai Barat",
      "BERAU": "Berau",
      "PASER": "Paser",
      "PENAJAM PASER UTARA": "Penajam Paser Utara",
      "MAHAKAM ULU": "Mahakam Ulu"
    };

    // Hitung min & max untuk visualMap
    const values = Object.values(kaltimData);
    const minVal = values.length ? Math.min.apply(null, values) : 0;
    const maxVal = values.length ? Math.max.apply(null, values) : 10;

    // JavaScript to handle quick detail review panel
    function showQuickDetail(m) {
      document.getElementById('det-name').textContent = m.child_name;
      document.getElementById('det-id').textContent = 'ID: ' + m.id;
      document.getElementById('det-age-gender').textContent = m.age_months + ' bulan - ' + (m.gender === 'L' ? 'Laki-laki' : 'Perempuan');
      
      const createdDate = new Date(m.created_at);
      const formattedDate = createdDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
      document.getElementById('det-date').textContent = formattedDate;
      
      const statusBadge = document.getElementById('det-status-badge');
      statusBadge.textContent = m.status_growth;
      
      statusBadge.className = 'badge border-none px-2 py-0.5 text-[11px] rounded-full';
      if (m.status_growth === 'Normal') {
        statusBadge.classList.add('badge-status-normal');
      } else if (m.status_growth === 'Pendek') {
        statusBadge.classList.add('badge-status-risiko');
      } else {
        statusBadge.classList.add('badge-status-stunting');
      }
      
      document.getElementById('det-tb').textContent = m.height + ' cm';
      document.getElementById('det-bb').textContent = m.weight + ' kg';
      document.getElementById('det-city').textContent = m.city;
      
      const recsEl = document.getElementById('det-recs');
      if (m.status_growth === 'Normal') {
        recsEl.textContent = 'Pertumbuhan anak dalam batas normal. Pertahankan asupan gizi seimbang, ASI/MPASI berkualitas, dan imunisasi rutin.';
      } else {
        recsEl.textContent = 'Tinggi badan berdasarkan usia berada di bawah standar WHO. Rujuk ke layanan kesehatan/Puskesmas terdekat, berikan makanan padat kaya zat besi & protein hewani harian, serta pantau pertumbuhan berkala.';
      }
    }

    document.addEventListener("DOMContentLoaded", function () {
      // ==================== 1. PETA KALIMANTAN TIMUR (ECharts) ====================
      const mapContainer = document.getElementById("kaltim-map");
      if (mapContainer && typeof echarts !== "undefined") {
        const mapChart = echarts.init(mapContainer);

        fetch("{{ asset('static/maps/kalimantan-timur-kabkota.geojson') }}")
          .then(resp => resp.json())
          .then(geoJson => {
            echarts.registerMap("KaltimKab", geoJson);

            const seriesData = geoJson.features.map(f => {
              const rawName = (f.properties.NAME_2 || f.properties.NAME || "").toUpperCase();
              const displayName = nameMapping[rawName] || rawName;
              const val = kaltimData[displayName] || 0;
              return { name: displayName, value: val };
            });

            const option = {
              tooltip: {
                trigger: "item",
                formatter: function (params) {
                  const value = params.value || 0;
                  const percentBase = maxVal || 1;
                  const percent = ((value / percentBase) * 100).toFixed(1);
                  return `
                    <div style="font-size:12px;">
                      <strong>${params.name}</strong><br/>
                      Jumlah Kasus Stunting: ${value}<br/>
                      Perbandingan: ${percent}% dari nilai tertinggi
                    </div>
                  `;
                }
              },
              visualMap: {
                min: minVal,
                max: maxVal,
                orient: "vertical",
                left: "left",
                top: "middle",
                text: ["Tinggi", "Rendah"],
                textStyle: { fontSize: 11, color: "#64748b" },
                inRange: {
                  color: ["#ecfdf3", "#a7f3d0", "#22c55e", "#15803d"]
                },
                calculable: false,
                itemWidth: 10,
                itemHeight: 80
              },
              series: [{
                type: "map",
                map: "KaltimKab",
                roam: true,
                zoom: 1.1,
                label: {
                  show: true,
                  fontSize: 10,
                  color: "#0f172a"
                },
                emphasis: {
                  label: {
                    show: true,
                    fontWeight: "600",
                    color: "#0f172a"
                  },
                  itemStyle: {
                    areaColor: "#bfdbfe"
                  }
                },
                itemStyle: {
                  borderColor: "#e5e7eb",
                  borderWidth: 1
                },
                data: seriesData
              }]
            };

            mapChart.setOption(option);
            window.addEventListener("resize", () => mapChart.resize());
          })
          .catch(err => {
            console.error("Gagal memuat GeoJSON Kaltim:", err);
          });
      }

      // ==================== 2. PIE CHART KOMPOSISI STATUS ====================
      const statusCtx = document.getElementById("statusChart");
      if (statusCtx) {
        new Chart(statusCtx, {
          type: "doughnut",
          data: {
            labels: ["Normal", "Pendek (Stunting)", "Sangat Pendek (Stunting Berat)"],
            datasets: [{
              data: [totalNormal, totalRisiko, totalStunting],
              backgroundColor: ["#22c55e", "#fb923c", "#fb7185"],
              borderWidth: 0
            }]
          },
          options: {
            plugins: {
              legend: { display: false }
            },
            cutout: "65%",
            responsive: true,
            maintainAspectRatio: false
          }
        });
      }

      // ==================== 3. BAR CHART DISTRIBUSI USIA ====================
      const ageCtx = document.getElementById("ageChart");
      if (ageCtx) {
        new Chart(ageCtx, {
          type: "bar",
          data: {
            labels: ["0-6", "7-12", "13-24", "25-36", "37-60"],
            datasets: [
              {
                label: "Normal",
                data: [
                  {{ $chartAge['0-6']['Normal'] }},
                  {{ $chartAge['7-12']['Normal'] }},
                  {{ $chartAge['13-24']['Normal'] }},
                  {{ $chartAge['25-36']['Normal'] }},
                  {{ $chartAge['37-60']['Normal'] }}
                ],
                backgroundColor: "#22c55e"
              },
              {
                label: "Pendek",
                data: [
                  {{ $chartAge['0-6']['Pendek'] }},
                  {{ $chartAge['7-12']['Pendek'] }},
                  {{ $chartAge['13-24']['Pendek'] }},
                  {{ $chartAge['25-36']['Pendek'] }},
                  {{ $chartAge['37-60']['Pendek'] }}
                ],
                backgroundColor: "#fb923c"
              },
              {
                label: "Sangat Pendek",
                data: [
                  {{ $chartAge['0-6']['Sangat Pendek'] }},
                  {{ $chartAge['7-12']['Sangat Pendek'] }},
                  {{ $chartAge['13-24']['Sangat Pendek'] }},
                  {{ $chartAge['25-36']['Sangat Pendek'] }},
                  {{ $chartAge['37-60']['Sangat Pendek'] }}
                ],
                backgroundColor: "#fb7185"
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              x: {
                stacked: true,
                ticks: { font: { size: 11 } }
              },
              y: {
                stacked: true,
                ticks: {
                  stepSize: 5,
                  font: { size: 11 }
                },
                beginAtZero: true
              }
            },
            plugins: {
              legend: {
                labels: { font: { size: 11 } }
              }
            }
          }
        });
      }
    });
  </script>
</body>
</html>
