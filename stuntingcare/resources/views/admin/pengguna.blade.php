<!DOCTYPE html>
<html lang="id"data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Pengguna — SiCegah Stunting</title>
  <meta name="description" content="Panel admin untuk mengelola data pengguna dan kader." />

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
          <div class="text-xs text-slate-500">Kelola konten & data</div>
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
            <a href="{{ route('admin.analisis') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 font-medium">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna
            </a>
          </nav>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-blue-600 text-base">info</span>
            <div>
              <h2 class="text-sm font-semibold text-blue-900">Catatan data pengguna</h2>
              <p class="text-xs text-blue-800 mt-1 leading-relaxed">
                Gunakan nama lengkap dan nomor kontak yang valid agar mudah dihubungi saat kegiatan pendampingan dan monitoring.
              </p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main content -->
      <section class="lg:col-span-9 space-y-4">

        <!-- Header -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna & kader
            </p>
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
              Kelola akun pengguna SiCegah
            </h1>
            <p class="text-xs text-slate-500 mt-1">
              Tambah, edit, dan atur peran pengguna untuk kebutuhan program stunting.
            </p>
          </div>
          <div class="flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">download</span>
              Ekspor CSV
            </button>
            <button type="button" class="btn btn-primary btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">person_add</span>
              Tambah pengguna
            </button>
          </div>
        </div>

        <!-- Filter + summary -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 space-y-4">
          <form method="GET" action="{{ route('admin.pengguna') }}">
            @if(request()->has('per_page'))
              <input type="hidden" name="per_page" value="{{ request('per_page') }}">
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
              <!-- Search -->
              <div class="form-control md:col-span-2">
                <label class="label pb-1">
                  <span class="label-text text-xs font-medium text-slate-600">Cari pengguna</span>
                </label>
                <div class="relative">
                  <span class="material-symbols-rounded absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base">search</span>
                  <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nama, email, atau nomor HP"
                    class="input input-bordered w-full pl-9 text-sm"
                  />
                </div>
              </div>

              <!-- Role filter -->
              <div class="form-control">
                <label class="label pb-1">
                  <span class="label-text text-xs font-medium text-slate-600">Filter peran</span>
                </label>
                <select name="role" class="select select-bordered w-full text-sm" onchange="this.form.submit()">
                  <option value="" {{ request('role') == '' ? 'selected' : '' }}>Semua peran</option>
                  <option value="Admin Wilayah" {{ request('role') == 'Admin Wilayah' ? 'selected' : '' }}>Admin Wilayah</option>
                  <option value="Koordinator Cabang" {{ request('role') == 'Koordinator Cabang' ? 'selected' : '' }}>Koordinator Cabang</option>
                  <option value="Kader Lapangan" {{ request('role') == 'Kader Lapangan' ? 'selected' : '' }}>Kader Lapangan</option>
                  <option value="Pengguna Umum" {{ request('role') == 'Pengguna Umum' ? 'selected' : '' }}>Pengguna Umum</option>
                </select>
              </div>
            </div>
          </form>
        </div>

        <!-- Ringkasan kecil -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex items-center justify-between">
              <div>
                <p class="text-slate-500">Total pengguna</p>
                <p class="text-base font-semibold text-slate-900">{{ $totalUsers }}</p>
              </div>
              <span class="material-symbols-rounded text-emerald-500 text-2xl">groups</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex items-center justify-between">
              <div>
                <p class="text-slate-500">Admin & koordinator</p>
                <p class="text-base font-semibold text-slate-900">{{ $totalAdminKoordinator }}</p>
              </div>
              <span class="material-symbols-rounded text-indigo-500 text-2xl">supervisor_account</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex items-center justify-between">
              <div>
                <p class="text-slate-500">Kader aktif</p>
                <p class="text-base font-semibold text-slate-900">{{ $totalKader }}</p>
              </div>
              <span class="material-symbols-rounded text-sky-500 text-2xl">volunteer_activism</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex items-center justify-between">
              <div>
                <p class="text-slate-500">Baru 30 hari ini</p>
                <p class="text-base font-semibold text-slate-900">{{ $newUsers30d }}</p>
              </div>
              <span class="material-symbols-rounded text-amber-500 text-2xl">trending_up</span>
            </div>
          </div>
        </div>

        <!-- Tabel pengguna -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 overflow-x-auto">
          <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-slate-500">
              Menampilkan <span class="font-semibold text-slate-700">{{ $users->firstItem() }}–{{ $users->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $users->total() }}</span> pengguna
            </p>
            <div class="flex items-center gap-2 text-xs">
              <span class="text-slate-500">Tampilkan</span>
              <select class="select select-bordered select-xs" onchange="const url = new URL(window.location.href); url.searchParams.set('per_page', this.value); url.searchParams.set('page', 1); window.location.href = url.href;">
                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
              </select>
              <span class="text-slate-500">per halaman</span>
            </div>
          </div>

          <table class="table table-zebra text-sm">
            <thead class="text-xs text-slate-500">
              <tr>
                <th class="w-10">
                  <input type="checkbox" class="checkbox checkbox-xs" />
                </th>
                <th>Pengguna</th>
                <th>Peran</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th class="text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
              @php
                $avatarColor = match($user->role) {
                    'admin_wilayah'      => 'bg-emerald-100 text-emerald-700',
                    'koordinator_cabang' => 'bg-indigo-100 text-indigo-700',
                    'kader_lapangan'     => 'bg-sky-100 text-sky-700',
                    'pengguna_umum'      => 'bg-slate-100 text-slate-600',
                    default              => 'bg-slate-100 text-slate-600',
                };
              @endphp
              <tr>
                <td>
                  <input type="checkbox" class="checkbox checkbox-xs" />
                </td>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                      <div class="w-8 h-8 rounded-full {{ $avatarColor }} text-xs flex items-center justify-center">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                      </div>
                    </div>
                    <div>
                      <p class="font-medium text-slate-800 text-sm">{{ $user->name }}</p>
                      <p class="text-xs text-slate-500">{{ $user->email }}{{ $user->phone_number ? ' · ' . $user->phone_number : '' }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-sm badge-ghost">{{ ucwords(str_replace('_', ' ', $user->role)) }}</span>
                </td>
                <td>
                  <p class="text-xs text-slate-600">{{ $user->city ?? '-' }}</p>
                </td>
                <td>
                  @if ($user->is_active)
                    <span class="badge badge-sm badge-success gap-1">
                      <span class="material-symbols-rounded text-xs">check_circle</span>
                      Aktif
                    </span>
                  @else
                    <span class="badge badge-sm badge-outline gap-1">
                      <span class="material-symbols-rounded text-xs">pause_circle</span>
                      Nonaktif
                    </span>
                  @endif
                </td>
                <td class="text-right">
                  <div class="flex justify-end gap-1">
                    <button class="btn btn-ghost btn-xs rounded-full">
                      <span class="material-symbols-rounded text-sm">edit</span>
                    </button>
                    <button type="button" class="btn btn-ghost btn-xs rounded-full text-red-500"
                      onclick="if(confirm('Yakin hapus pengguna ini?')) document.getElementById('del-{{ $user->id }}').submit()">
                      <span class="material-symbols-rounded text-sm">delete</span>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-8 text-slate-400 text-sm">Belum ada pengguna.</td>
              </tr>
              @endforelse
            </tbody>
          </table>

          {{-- Hidden delete forms (luar tabel agar tidak merusak layout) --}}
          @foreach ($users as $user)
          <form id="del-{{ $user->id }}" method="POST" action="{{ route('admin.pengguna.destroy', $user) }}" class="hidden">
            @csrf @method('DELETE')
          </form>
          @endforeach

          <!-- Pagination sederhana -->
          <div class="flex items-center justify-between mt-4 text-xs text-slate-600">
            <p>Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}</p>
            <div class="join">
              @if ($users->onFirstPage())
                <button class="btn btn-ghost btn-xs join-item text-slate-400" disabled>
                  <span class="material-symbols-rounded text-sm">chevron_left</span>
                </button>
              @else
                <a href="{{ $users->previousPageUrl() }}" class="btn btn-ghost btn-xs join-item">
                  <span class="material-symbols-rounded text-sm">chevron_left</span>
                </a>
              @endif

              @for ($i = 1; $i <= $users->lastPage(); $i++)
                @if ($i == $users->currentPage())
                  <button class="btn btn-primary btn-xs join-item">{{ $i }}</button>
                @else
                  <a href="{{ $users->url($i) }}" class="btn btn-ghost btn-xs join-item">{{ $i }}</a>
                @endif
              @endfor

              @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="btn btn-ghost btn-xs join-item">
                  <span class="material-symbols-rounded text-sm">chevron_right</span>
                </a>
              @else
                <button class="btn btn-ghost btn-xs join-item text-slate-400" disabled>
                  <span class="material-symbols-rounded text-sm">chevron_right</span>
                </button>
              @endif
            </div>
          </div>
        </div>

        <!-- Panel form singkat (slide-in modal bisa nanti di-Django) -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <h2 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-1">
            <span class="material-symbols-rounded text-sm text-slate-600">person_add</span>
            Tambah / edit pengguna (ringkas)
          </h2>
          <form class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm" method="POST" action="{{ route('admin.pengguna.store') }}">
            @csrf
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Nama lengkap</span>
              </label>
              <input type="text" class="input input-bordered w-full text-sm" placeholder="Nama pengguna" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Email</span>
              </label>
              <input type="email" class="input input-bordered w-full text-sm" placeholder="email@contoh.com" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Nomor HP</span>
              </label>
              <input type="tel" class="input input-bordered w-full text-sm" placeholder="08xx-xxxx-xxxx" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Peran</span>
              </label>
              <select class="select select-bordered w-full text-sm">
                <option>Pengguna Umum</option>
                <option>Kader Lapangan</option>
                <option>Koordinator Cabang</option>
                <option>Admin Wilayah</option>
              </select>
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Wilayah</span>
              </label>
              <input type="text" class="input input-bordered w-full text-sm" placeholder="Kota / Kabupaten" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Status</span>
              </label>
              <select class="select select-bordered w-full text-sm">
                <option>Aktif</option>
                <option>Nonaktif</option>
              </select>
            </div>
            <div class="md:col-span-3 flex justify-end gap-2 pt-2">
              <button type="button" class="btn btn-ghost btn-sm rounded-full">
                <span class="material-symbols-rounded text-sm">close</span>
                Batal
              </button>
              <button type="submit" class="btn btn-primary btn-sm rounded-full">
                <span class="material-symbols-rounded text-sm">save</span>
                Simpan pengguna
              </button>
            </div>
          </form>
        </div>

      </section>
    </div>
  </main>

</body>
</html>
