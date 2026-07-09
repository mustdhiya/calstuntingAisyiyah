@extends('admin.layouts.app')

@section('title', 'Hasil Analisis - Admin')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/admin/analisis.css') }}" />
@endsection

@section('sidebar-extra')
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
@endsection

@section('content')
        
        <!-- ====== PETA KALIMANTAN TIMUR (GEOCHART) ====== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
              <span class="material-symbols-rounded text-sm text-slate-600">map</span>
              Peta sebaran risiko per kabupaten/kota (Kaltim)
            </h2>
            <span class="text-[11px] text-slate-500">
              Warna lebih pekat = nilai lebih tinggi
            </span>
          </div>

          <!-- Container peta -->
          <div id="kaltim-map" class="w-full h-72 md:h-80 lg:h-96"></div>

          <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-slate-500">
            <div class="flex items-center gap-1">
              <span class="w-4 h-3 rounded-full"
                    style="background: linear-gradient(to right,#ecfdf3,#22c55e);"></span>
              <span>Level risiko (rendah → tinggi)</span>
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
            <a href="{{ route('admin.analisis.export') }}" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">download</span>
              Ekspor CSV
            </a>
            <a href="{{ route('admin.analisis') }}" class="btn btn-primary btn-sm rounded-full">
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
                <span class="material-symbols-rounded text-sm">info</span>
                Risiko Stunting
              </p>
              <p class="text-xl font-semibold text-amber-600">{{ $totalRisiko }}</p>
            </div>
          </div>

          <!-- Chart komposisi status -->
          <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
            <div class="flex items-center justify-between mb-2">
              <h2 class="text-sm font-semibold text-slate-900 flex items-center gap-1.5">
                <span class="material-symbols-rounded text-sm text-slate-600">pie_chart</span>
                Komposisi status risiko
              </h2>
              <span class="text-[11px] text-slate-500">Data 30 hari terakhir</span>
            </div>
            <div class="h-56">
              <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-slate-600">
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-[#22c55e]"></span> Normal
              </span>
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-[#fb923c]"></span> Risiko
              </span>
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-[#fb7185]"></span> Stunting
              </span>
              <span class="inline-flex items-center gap-1">
                <span class="w-3 h-3 rounded-full bg-[#b91c1c]"></span> Stunting berat
              </span>
            </div>
          </div>
        </div>

        <!-- Filter & Pencarian -->
        <form method="GET" action="{{ route('admin.analisis') }}" class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
            <!-- Nama / ID -->
            <div class="form-control">
              <label class="label">
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
              <label class="label">
                <span class="label-text text-xs font-medium text-slate-700">Status risiko</span>
              </label>
              <select name="status" class="select select-bordered w-full text-sm h-10 min-h-10">
                <option value="">Semua status</option>
                <option value="Normal" {{ $status === 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Risiko" {{ $status === 'Risiko' ? 'selected' : '' }}>Risiko</option>
                <option value="Stunting" {{ $status === 'Stunting' ? 'selected' : '' }}>Stunting</option>
                <option value="Stunting Berat" {{ $status === 'Stunting Berat' ? 'selected' : '' }}>Stunting Berat</option>
              </select>
            </div>
            <!-- Rentang usia -->
            <div class="form-control">
              <label class="label">
                <span class="label-text text-xs font-medium text-slate-700">Usia (bulan)</span>
              </label>
              <div class="flex gap-2">
                <input type="number" name="age_min" value="{{ $ageMin }}" min="0" class="input input-bordered w-full text-sm h-10 min-h-10" placeholder="min" />
                <input type="number" name="age_max" value="{{ $ageMax }}" min="0" class="input input-bordered w-full text-sm h-10 min-h-10" placeholder="max" />
              </div>
            </div>
          </div>

          <div class="flex gap-2 shrink-0">
            <a href="{{ route('admin.analisis') }}" class="btn btn-ghost btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">restart_alt</span>
              Reset
            </a>
            <button type="submit" class="btn btn-primary btn-sm rounded-full">
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
                      <div class="text-[11px] text-slate-400">{{ substr($m->id, 0, 8) }}</div>
                    </td>
                    <td>{{ $m->age_months }} bln</td>
                    <td>{{ $m->gender }}</td>
                    <td>
                      @php
                        $badgeClass = match($m->status_growth) {
                          'Normal'         => 'badge-status-normal',
                          'Risiko'         => 'badge-status-risiko',
                          'Stunting'       => 'badge-status-stunting',
                          'Stunting Berat' => 'badge-status-stunting bg-red-100 text-red-700',
                          default          => 'badge-status-normal'
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
                        <span class="material-symbols-rounded text-xs">open_in_new</span>
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
            <button class="btn btn-ghost btn-xs rounded-full text-[11px]">
              <span class="material-symbols-rounded text-sm">open_in_new</span>
              Buka halaman lengkap
            </button>
          </div>

          @if($defaultDetail)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
              <div class="space-y-1">
                <p class="text-slate-500">Nama anak</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-name">{{ $defaultDetail->child_name }}</p>
                <p class="text-[11px] text-slate-400" id="det-id">ID: {{ Str::upper(Str::substr($defaultDetail->id, 0, 8)) }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-slate-500">Usia &amp; jenis kelamin</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-age-gender">
                  {{ $defaultDetail->age_months }} bulan &middot; {{ $defaultDetail->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </p>
              </div>
              <div class="space-y-1">
                <p class="text-slate-500">Tanggal pemeriksaan</p>
                <p class="font-semibold text-slate-900 text-sm" id="det-date">{{ $defaultDetail->created_at->translatedFormat('d F Y') }}</p>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4 text-xs">
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Status</p>
                @php
                  $defaultBadge = match($defaultDetail->status_growth) {
                    'Normal'         => 'badge-status-normal',
                    'Risiko'         => 'badge-status-risiko',
                    'Stunting'       => 'badge-status-stunting',
                    'Stunting Berat' => 'badge-status-stunting bg-red-100 text-red-700',
                    default          => 'badge-status-normal'
                  };
                  $statusLabel = $defaultDetail->status_growth;
                @endphp
                <span class="badge {{ $defaultBadge }} border-none px-2 py-1 text-[11px] rounded-full" id="det-status-badge">
                  {{ $statusLabel }}
                </span>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Tinggi badan</p>
                <p class="font-semibold text-slate-900" id="det-tb">{{ number_format($defaultDetail->height, 1, ',', '.') }} cm</p>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">Berat badan</p>
                <p class="font-semibold text-slate-900" id="det-bb">{{ number_format($defaultDetail->weight, 1, ',', '.') }} kg</p>
              </div>
              <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-slate-500 mb-1">ASI eksklusif</p>
                <p class="font-semibold text-slate-900" id="det-asi">{{ $defaultDetail->asi_eksklusif ?? 'Ya' }}</p>
              </div>
            </div>

            <div class="mt-4 border-t border-slate-100 pt-3 text-xs">
              <p class="text-slate-500 mb-1">Catatan &amp; rekomendasi sistem</p>
              <p class="text-slate-700 leading-relaxed" id="det-recs">
                @if(in_array($defaultDetail->status_growth, ['Stunting', 'Stunting Berat']))
                  Tinggi badan berdasarkan usia berada di bawah -2 SD. Sarankan orang tua untuk konsultasi ke Posyandu/Puskesmas,
                  evaluasi pola makan, dan pantau pertumbuhan tiap bulan.
                @elseif($defaultDetail->status_growth === 'Risiko')
                  Tinggi badan berdasarkan usia berada di kisaran risiko pendek. Perlu pemantauan gizi secara intensif dan evaluasi pertumbuhan berkala.
                @else
                  Pertumbuhan anak dalam batas normal berdasarkan standar WHO. Pertahankan asupan gizi seimbang,
                  lanjutkan ASI/MPASI berkualitas, dan lakukan imunisasi rutin.
                @endif
              </p>
            </div>
          @else
            <div class="text-center py-6 text-slate-400">
              <span class="material-symbols-rounded text-3xl mb-2 block">inbox</span>
              <p class="text-xs">Belum ada data pemeriksaan.</p>
            </div>
          @endif
        </div>

     <a href="{{ route('admin.analisis.peta') }}"
       class="fixed bottom-6 right-6 z-50 flex items-center gap-2 px-4 py-3 rounded-full bg-emerald-600 text-white text-xs md:text-sm font-semibold shadow-lg hover:bg-emerald-700 transition">
      <span class="material-symbols-rounded text-base md:text-lg">map</span>
      <span>Peta analisis per kab/kota</span>
    </a>

@endsection

@section('scripts')
  <!-- Chart.js (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Apache ECharts (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

  <!-- Script Chart.js & ECharts (dashboard eksternal) -->
  <script>
    window.analisisData = {
      totalNormal: {{ $totalNormal }},
      totalRisiko: {{ $totalRisiko }},
      totalStunting: {{ $totalStunting }},
      totalBerat: {{ $totalBerat }},
      kaltimData: @json($mapData),
      geoJsonUrl: "{{ asset('static/maps/kalimantan-timur-kabkota.geojson') }}",
      chartAgeData: @json($chartAge)
    };
  </script>
  <script src="{{ asset('js/admin/analisis.js') }}"></script>
@endsection
