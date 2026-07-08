@extends('admin.layouts.app')

@section('title', 'Daftar Artikel — Admin')

@section('sidebar-extra')
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-amber-600 text-base">lightbulb</span>
            <div>
              <h2 class="text-sm font-semibold text-amber-900">Tips pengelolaan</h2>
              <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                Gunakan judul yang jelas dan ringkas. Tandai artikel penting sebagai unggulan agar mudah ditemukan di beranda.
              </p>
            </div>
          </div>
        </div>
@endsection

@section('content')

        <!-- Header + actions -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">article</span>
              Daftar artikel edukasi
            </p>
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
              Kelola artikel untuk edukasi stunting
            </h1>
            <p class="text-xs text-slate-500 mt-1">
              Tambah, edit, atau arsip artikel dengan tampilan tabel yang sederhana.
            </p>
          </div>
          <div class="flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">filter_list</span>
              Filter
            </button>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">add</span>
              Artikel baru
            </a>
          </div>
        </div>

        <!-- Filter bar -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
          <form method="GET" action="{{ route('admin.artikel.list') }}" class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <div class="flex-1">
              <label class="input input-bordered flex items-center gap-2 text-sm w-full">
                <span class="material-symbols-rounded text-base text-slate-500">search</span>
                <input type="text" name="search" class="grow" placeholder="Cari judul atau penulis..." value="{{ request('search') }}" />
              </label>
            </div>
            <div class="flex flex-wrap gap-2 text-xs">
              <select name="status" class="select select-bordered select-sm" onchange="this.form.submit()">
                <option value="">Status: Semua</option>
                <option value="published" {{ request('status')==='published' ? 'selected' : '' }}>Terbit</option>
                <option value="draft"     {{ request('status')==='draft'     ? 'selected' : '' }}>Draf</option>
                <option value="scheduled" {{ request('status')==='scheduled' ? 'selected' : '' }}>Terjadwal</option>
              </select>
              <select name="category" class="select select-bordered select-sm" onchange="this.form.submit()">
                <option value="">Kategori: Semua</option>
                @foreach(['Gizi Anak','MPASI','ASI Eksklusif','FAQ'] as $cat)
                  <option value="{{ $cat }}" {{ request('category')===$cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>

        <!-- Tabel artikel -->
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="table table-zebra-zebra w-full text-sm">
              <thead class="bg-slate-50 text-xs text-slate-500">
                <tr>
                  <th class="w-10">
                    <input type="checkbox" class="checkbox checkbox-xs" />
                  </th>
                  <th>Judul</th>
                  <th class="hidden md:table-cell">Kategori</th>
                  <th>Status</th>
                  <th class="hidden md:table-cell">Penulis</th>
                  <th class="hidden md:table-cell">Tgl</th>
                  <th class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($articles as $article)
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox checkbox-xs" />
                  </td>
                  <td>
                    <div class="flex flex-col">
                      <a href="{{ route('admin.artikel.edit', $article) }}" class="font-medium text-slate-800 hover:text-emerald-700">
                        {{ $article->title }}
                      </a>
                      <span class="text-xs text-slate-500 line-clamp-1">
                        {{ $article->summary }}
                      </span>
                    </div>
                  </td>
                  <td class="hidden md:table-cell text-xs text-slate-600">
                    {{ $article->category }}
                  </td>
                  <td>
                    @php
                      $badgeMap = [
                        'published' => ['label'=>'Terbit',    'class'=>'badge-status-published', 'icon'=>'check_circle'],
                        'draft'     => ['label'=>'Draf',      'class'=>'badge-status-draft',     'icon'=>'edit_note'],
                        'scheduled' => ['label'=>'Terjadwal', 'class'=>'badge-status-scheduled', 'icon'=>'schedule'],
                      ];
                      $b = $badgeMap[$article->status] ?? $badgeMap['draft'];
                    @endphp
                    <span class="badge {{ $b['class'] }} border-0 text-[10px] px-2 py-1 flex items-center gap-1">
                      <span class="material-symbols-rounded text-[14px]">{{ $b['icon'] }}</span>
                      {{ $b['label'] }}
                    </span>
                  </td>
                  <td class="hidden md:table-cell text-xs text-slate-600">
                    {{ $article->author_name }}
                  </td>
                  <td class="hidden md:table-cell text-xs text-slate-600">
                    {{ $article->published_date ? $article->published_date->format('d/m/Y') : '-' }}
                  </td>
                  <td class="text-right">
                    <div class="flex items-center justify-end gap-1 text-xs">
                      <a href="{{ route('admin.artikel.edit', $article) }}" class="btn btn-ghost btn-xs rounded-full">
                        <span class="material-symbols-rounded text-sm">edit</span>
                        Edit
                      </a>
                      <form method="POST" action="{{ route('admin.artikel.archive', $article) }}" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-ghost btn-xs rounded-full text-amber-600">
                          <span class="material-symbols-rounded text-sm">archive</span>
                          Arsip
                        </button>
                      </form>
                      <form method="POST" action="{{ route('admin.artikel.destroy', $article) }}" class="inline" onsubmit="return confirm('Yakin hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-ghost btn-xs rounded-full text-red-600">
                          <span class="material-symbols-rounded text-sm">delete</span>
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-8 text-slate-400 text-sm">Belum ada artikel.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Footer tabel: info & pagination -->
          <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-3 border-t border-slate-100 text-xs text-slate-500">
            <p>Halaman {{ $articles->currentPage() }} dari {{ $articles->lastPage() }}</p>
            <div class="join">
              @if ($articles->onFirstPage())
                <button class="btn btn-ghost btn-xs join-item text-slate-400" disabled>
                  <span class="material-symbols-rounded text-sm">chevron_left</span>
                </button>
              @else
                <a href="{{ $articles->previousPageUrl() }}" class="btn btn-ghost btn-xs join-item">
                  <span class="material-symbols-rounded text-sm">chevron_left</span>
                </a>
              @endif

              @for ($i = 1; $i <= $articles->lastPage(); $i++)
                @if ($i == $articles->currentPage())
                  <button class="btn btn-primary btn-xs join-item">{{ $i }}</button>
                @else
                  <a href="{{ $articles->url($i) }}" class="btn btn-ghost btn-xs join-item">{{ $i }}</a>
                @endif
              @endfor

              @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="btn btn-ghost btn-xs join-item">
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

@endsection
