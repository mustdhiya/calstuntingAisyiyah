@extends('admin.layouts.app')

@section('title', 'Manajemen FAQ — SiCegah Stunting')

@section('sidebar-extra')
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-blue-600 text-base">help</span>
            <div>
              <h2 class="text-sm font-semibold text-blue-900">Manajemen FAQ</h2>
              <p class="text-xs text-blue-800 mt-1 leading-relaxed">
                Pertanyaan yang diset berstatus <strong>Aktif</strong> akan otomatis ditampilkan pada halaman FAQ publik untuk membantu edukasi masyarakat.
              </p>
            </div>
          </div>
        </div>
@endsection

@section('content')

        <!-- Alert Notification -->
        @if(session('success'))
          <div class="alert alert-success bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 flex items-center justify-between text-sm shadow-sm mb-4">
            <div class="flex items-center gap-2">
              <span class="material-symbols-rounded text-emerald-600">check_circle</span>
              <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
              <span class="material-symbols-rounded text-sm">close</span>
            </button>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-error bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 flex items-center gap-2 text-sm shadow-sm mb-4">
            <span class="material-symbols-rounded text-red-600">error</span>
            <div>
              @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl">
              <span class="material-symbols-rounded">quiz</span>
            </div>
            <div>
              <p class="text-xs text-slate-500 font-medium">Total FAQ</p>
              <h3 class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalFaqs }}</h3>
            </div>
          </div>

          <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl">
              <span class="material-symbols-rounded">check_circle</span>
            </div>
            <div>
              <p class="text-xs text-slate-500 font-medium">Aktif (Tampil Publik)</p>
              <h3 class="text-xl font-bold text-emerald-600 mt-0.5">{{ $activeFaqs }}</h3>
            </div>
          </div>

          <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xl">
              <span class="material-symbols-rounded">archive</span>
            </div>
            <div>
              <p class="text-xs text-slate-500 font-medium">Draf (Disembunyikan)</p>
              <h3 class="text-xl font-bold text-amber-600 mt-0.5">{{ $draftFaqs }}</h3>
            </div>
          </div>
        </div>

        <!-- Header Controls -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-sm">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
              <h1 class="text-lg md:text-xl font-bold text-slate-900 flex items-center gap-2">
                <span class="material-symbols-rounded text-blue-600">help_outline</span>
                Manajemen Data FAQ
              </h1>
              <p class="text-xs text-slate-500 mt-1">Kelola pertanyaan dan jawaban umum seputar stunting dan sistem.</p>
            </div>
            <button onclick="openFormModal()" class="btn btn-primary btn-sm rounded-xl flex items-center gap-2">
              <span class="material-symbols-rounded text-base">add</span>
              Tambah FAQ Baru
            </button>
          </div>

          <!-- Filter & Search Bar -->
          <form method="GET" action="{{ route('admin.crud-faq') }}" class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
              <span class="material-symbols-rounded absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan atau jawaban..." class="input input-sm input-bordered w-full pl-9 text-xs rounded-xl" />
            </div>
            <div class="w-full sm:w-48">
              <select name="status" onchange="this.form.submit()" class="select select-sm select-bordered w-full text-xs rounded-xl">
                <option value="">Semua Status</option>
                <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif (Tampil)</option>
                <option value="Draf" {{ request('status') === 'Draf' ? 'selected' : '' }}>Draf (Disembunyikan)</option>
              </select>
            </div>
            @if(request()->hasAny(['search', 'status']))
              <a href="{{ route('admin.crud-faq') }}" class="btn btn-ghost btn-sm rounded-xl text-xs">Reset</a>
            @endif
          </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm mt-6 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="table w-full text-xs">
              <thead>
                <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                  <th class="py-3 px-4 w-12 text-center">No</th>
                  <th class="py-3 px-4 w-1/3">Pertanyaan</th>
                  <th class="py-3 px-4">Jawaban</th>
                  <th class="py-3 px-4 text-center w-28">Status</th>
                  <th class="py-3 px-4 text-center w-28">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                @forelse($faqs as $index => $faq)
                  <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="py-3 px-4 text-center text-slate-500 font-medium">
                      {{ $faqs->firstItem() + $index }}
                    </td>
                    <td class="py-3 px-4 font-semibold text-slate-900">
                      {{ $faq->question }}
                    </td>
                    <td class="py-3 px-4 text-slate-600 leading-relaxed">
                      <p class="line-clamp-2">{{ $faq->answer }}</p>
                    </td>
                    <td class="py-3 px-4 text-center">
                      @if($faq->status === 'Aktif')
                        <span class="badge badge-success text-white text-[11px] gap-1 py-2 px-2.5 font-medium">
                          <span class="material-symbols-rounded text-xs">check_circle</span> Aktif
                        </span>
                      @else
                        <span class="badge badge-ghost text-slate-600 text-[11px] gap-1 py-2 px-2.5 font-medium border-slate-200">
                          <span class="material-symbols-rounded text-xs">archive</span> Draf
                        </span>
                      @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                      <div class="flex items-center justify-center gap-1">
                        <button onclick="editFaq({{ json_encode($faq) }})" class="btn btn-square btn-ghost btn-xs text-blue-600 hover:bg-blue-50" title="Edit FAQ">
                          <span class="material-symbols-rounded text-base">edit</span>
                        </button>
                        <button onclick="promptDelete({{ $faq->id }}, '{{ addslashes($faq->question) }}')" class="btn btn-square btn-ghost btn-xs text-red-600 hover:bg-red-50" title="Hapus FAQ">
                          <span class="material-symbols-rounded text-base">delete</span>
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-12">
                      <div class="flex flex-col items-center justify-center">
                        <span class="material-symbols-rounded text-slate-300 text-4xl mb-2">inbox</span>
                        <p class="text-slate-500 font-medium text-sm">Belum ada data FAQ</p>
                        <p class="text-slate-400 text-xs mt-1">Mulai tambahkan pertanyaan dan jawaban baru.</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($faqs->hasPages())
            <div class="p-4 border-t border-slate-100">
              {{ $faqs->links() }}
            </div>
          @endif
        </div>

        <!-- Form Modal (Create / Edit) -->
        <dialog id="form-modal" class="modal">
          <div class="modal-box max-w-lg bg-white rounded-2xl p-6">
            <form method="dialog">
              <button class="btn btn-sm btn-circle btn-ghost absolute right-3 top-3 text-slate-400">✕</button>
            </form>
            <h3 id="modal-title" class="font-bold text-lg text-slate-900 mb-4 flex items-center gap-2">
              <span class="material-symbols-rounded text-blue-600">help</span>
              Tambah FAQ Baru
            </h3>

            <form id="faq-form" method="POST" action="{{ route('admin.crud-faq.store') }}" data-store-url="{{ route('admin.crud-faq.store') }}" class="space-y-4">
              @csrf
              <input type="hidden" name="_method" id="form-method" value="POST">

              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">
                  Pertanyaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="question" id="question" required placeholder="Contoh: Bagaimana cara menginput data balita?" class="input input-sm input-bordered w-full rounded-xl text-xs" />
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">
                  Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea name="answer" id="answer" required rows="4" placeholder="Tuliskan jawaban yang informatif..." class="textarea textarea-bordered w-full rounded-xl text-xs leading-relaxed"></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Publikasi</label>
                <select name="status" id="status" class="select select-sm select-bordered w-full rounded-xl text-xs">
                  <option value="Aktif">Aktif (Tampilkan di website)</option>
                  <option value="Draf">Draf (Sembunyikan dari publik)</option>
                </select>
              </div>

              <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeFormModal()" class="btn btn-ghost btn-sm rounded-xl">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm rounded-xl">Simpan Data</button>
              </div>
            </form>
          </div>
          <form method="dialog" class="modal-backdrop bg-slate-900/40">
            <button>close</button>
          </form>
        </dialog>

        <!-- Delete Modal -->
        <dialog id="delete-modal" class="modal">
          <div class="modal-box max-w-sm bg-white rounded-2xl p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-3">
              <span class="material-symbols-rounded text-2xl">warning</span>
            </div>
            <h3 class="font-bold text-base text-slate-900 mb-1">Hapus FAQ ini?</h3>
            <p id="delete-question-text" class="text-xs text-slate-500 mb-6 italic line-clamp-2"></p>
            
            <form id="delete-form" method="POST" action="" class="flex justify-center gap-2">
              @csrf
              @method('DELETE')
              <button type="button" onclick="closeDeleteModal()" class="btn btn-ghost btn-sm rounded-xl flex-1">Batal</button>
              <button type="submit" class="btn btn-error btn-sm rounded-xl text-white flex-1">Ya, Hapus</button>
            </form>
          </div>
          <form method="dialog" class="modal-backdrop bg-slate-900/40">
            <button>close</button>
          </form>
        </dialog>

        <script src="{{ asset('js/admin/faq.js') }}"></script>
@endsection
