@extends('admin.layouts.app')

@section('title', 'Admin Pengguna — SiCegah')

@section('sidebar-extra')
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
@endsection

@section('content')

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
            <a href="{{ route('admin.pengguna.export', request()->query()) }}" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">download</span>
              Ekspor CSV
            </a>
            <button type="button" class="btn btn-primary btn-sm rounded-full" onclick="resetForm()">
              <span class="material-symbols-rounded text-sm">person_add</span>
              Tambah pengguna
            </button>
          </div>
        </div>

        <!-- Filter + summary -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 space-y-4">
          <form id="filter-form" method="GET" action="{{ route('admin.pengguna') }}">

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
              <select name="per_page" form="filter-form" class="select select-bordered select-xs" onchange="this.form.submit()">
                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
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
                    <button type="button" class="btn btn-ghost btn-xs rounded-full"
                      onclick="editUser({{ json_encode($user->only(['id', 'name', 'email', 'phone_number', 'role', 'city', 'is_active'])) }})">
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

        <!-- Panel form singkat -->
        <div id="user-form-card" class="bg-white border border-slate-200 rounded-2xl p-4">
          <h2 id="form-title" class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-1">
            <span class="material-symbols-rounded text-sm text-slate-600">person_add</span>
            Tambah pengguna baru
          </h2>
          <form id="user-form" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm" method="POST" action="{{ route('admin.pengguna.store') }}" data-store-url="{{ route('admin.pengguna.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Nama lengkap</span>
              </label>
              <input type="text" name="name" id="user-name" class="input input-bordered w-full text-sm" placeholder="Nama pengguna" required />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Email</span>
              </label>
              <input type="email" name="email" id="user-email" class="input input-bordered w-full text-sm" placeholder="email@contoh.com" required />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Nomor HP</span>
              </label>
              <input type="tel" name="phone_number" id="user-phone" class="input input-bordered w-full text-sm" placeholder="08xx-xxxx-xxxx" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Peran</span>
              </label>
              <select name="role" id="user-role" class="select select-bordered w-full text-sm" required>
                <option value="pengguna_umum">Pengguna Umum</option>
                <option value="kader_lapangan">Kader Lapangan</option>
                <option value="koordinator_cabang">Koordinator Cabang</option>
                <option value="admin_wilayah">Admin Wilayah</option>
              </select>
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Wilayah</span>
              </label>
              <input type="text" name="city" id="user-city" class="input input-bordered w-full text-sm" placeholder="Kota / Kabupaten" />
            </div>
            <div class="form-control">
              <label class="label pb-1">
                <span class="label-text text-xs font-medium">Status</span>
              </label>
              <select name="is_active" id="user-status" class="select select-bordered w-full text-sm" required>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
              </select>
            </div>
            <div class="md:col-span-3 flex justify-end gap-2 pt-2">
              <button type="button" class="btn btn-ghost btn-sm rounded-full" onclick="resetForm()">
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

@endsection

@section('scripts')
  <script src="{{ asset('js/admin/users.js') }}"></script>
@endsection
