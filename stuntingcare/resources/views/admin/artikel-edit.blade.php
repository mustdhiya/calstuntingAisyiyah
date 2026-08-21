@extends('admin.layouts.app')

@section('title', $article ? 'Edit Artikel' : 'Tambah Artikel')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/admin/artikel.css') }}" />
@endsection




@section('sidebar-extra')
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4">
          <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-amber-600 text-base">lightbulb</span>
            <div>
              <h2 class="text-sm font-semibold text-amber-900">Tips penulisan</h2>
              <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                Gunakan kalimat pendek dan jelas. Fokus pada pesan utama agar mudah dipahami ibu-ibu dan kader.
              </p>
            </div>
          </div>
        </div>
@endsection

@section('content')

        @if(session('success'))
          <div class="alert alert-success text-sm rounded-2xl">
            <span class="material-symbols-rounded">check_circle</span>
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-error text-sm rounded-2xl">
            <span class="material-symbols-rounded">error</span>
            <ul class="list-disc ml-4">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if($article)
          <form id="article-form" method="POST" action="{{ route('admin.artikel.update', $article) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
        @else
          <form id="article-form" method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
            @csrf
        @endif


          <!-- Header card -->
          <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
              <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
                <span class="material-symbols-rounded text-sm">edit</span>
                {{ $article ? 'Edit artikel edukasi' : 'Tambah artikel baru' }}
              </p>
              <h1 class="text-lg md:text-xl font-semibold text-slate-900" id="header-title">
                {{ $article ? $article->title : 'Artikel baru' }}
              </h1>
              <p class="text-xs text-slate-500 mt-1">
                Perbarui judul, metadata, dan isi artikel dalam satu tempat.
              </p>
            </div>
            <div class="flex flex-wrap gap-2 shrink-0">
              <a href="{{ route('admin.artikel.list') }}" class="btn btn-outline btn-sm rounded-full text-slate-700 border-slate-300">
                <span class="material-symbols-rounded text-sm">arrow_back</span>Kembali
              </a>
              @if($article)
                <a href="{{ route('admin.artikel.preview', $article) }}" target="_blank" class="btn btn-outline btn-sm rounded-full text-slate-700 border-slate-300">
                  <span class="material-symbols-rounded text-sm">visibility</span>Preview
                </a>
              @else
                <button type="button" onclick="alert('Simpan artikel sebagai draf terlebih dahulu untuk melihat pratinjau halaman.')" class="btn btn-outline btn-sm rounded-full text-slate-700 border-slate-300 opacity-60">
                  <span class="material-symbols-rounded text-sm">visibility</span>Preview
                </button>
              @endif
              <button type="submit" class="btn btn-primary btn-sm rounded-full">
                <span class="material-symbols-rounded text-sm">save</span>Simpan
              </button>
            </div>
          </div>

          <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

            <!-- Kolom kiri: form utama -->
            <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-5 space-y-4">
              <h2 class="text-sm font-semibold text-slate-900">Data artikel</h2>

              <!-- Judul -->
              <div class="form-control">
                <label class="label pb-1">
                  <span class="label-text text-sm font-medium text-slate-800">Judul artikel</span>
                </label>
                <input type="text" name="title" id="title-input"
                  class="input input-bordered w-full text-sm @error('title') input-error @enderror"
                  placeholder="Tulis judul artikel..."
                  value="{{ old('title', $article?->title) }}" required />
                @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <!-- Slug & Kategori -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                  <label class="label pb-1">
                    <span class="label-text text-sm font-medium text-slate-800">Slug</span>
                  </label>
                  <input type="text" name="slug" id="slug-input"
                    class="input input-bordered w-full text-sm @error('slug') input-error @enderror"
                    placeholder="judul-dengan-tanda-hubung"
                    value="{{ old('slug', $article?->slug) }}" />
                  @error('slug') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="form-control">
                  <label class="label pb-1">
                    <span class="label-text text-sm font-medium text-slate-800">Kategori</span>
                  </label>
                  <select name="category" class="select select-bordered w-full text-sm @error('category') select-error @enderror" required>
                    @foreach(['Gizi Anak', 'ASI Eksklusif', 'MPASI', 'Pencegahan Stunting', 'Kesehatan Ibu', 'FAQ'] as $cat)
                      <option value="{{ $cat }}" {{ old('category', $article?->category)===$cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                  </select>
                  @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
              </div>

              <!-- Penulis, tanggal, estimasi baca -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-control">
                  <label class="label pb-1">
                    <span class="label-text text-sm font-medium text-slate-800">Penulis</span>
                  </label>
                  <input type="text" name="author_name"
                    class="input input-bordered w-full text-sm @error('author_name') input-error @enderror"
                    placeholder="Nama penulis"
                    value="{{ old('author_name', $article?->author_name ?? 'Tim Edukasi SiCegah') }}" required />
                  @error('author_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="form-control">
                  <label class="label pb-1">
                    <span class="label-text text-sm font-medium text-slate-800">Tanggal</span>
                  </label>
                  <input type="date" name="published_date"
                    class="input input-bordered w-full text-sm"
                    value="{{ old('published_date', $article?->published_date?->format('Y-m-d')) }}" />
                </div>
                <div class="form-control">
                  <label class="label pb-1">
                    <span class="label-text text-sm font-medium text-slate-800">Estimasi baca (menit)</span>
                  </label>
                  <input type="number" name="read_time" min="1"
                    class="input input-bordered w-full text-sm"
                    value="{{ old('read_time', $article?->read_time ?? 5) }}" />
                </div>
              </div>

              <!-- Gambar Utama (Upload File) -->
              <div class="form-control">
                <label class="label pb-1">
                  <span class="label-text text-sm font-medium text-slate-800">Gambar utama artikel</span>
                </label>
                <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                  <div class="w-24 h-24 rounded-xl overflow-hidden border border-slate-200 shrink-0 bg-slate-100 flex items-center justify-center relative" id="preview-container">
                    @if($article?->image_url)
                      <img id="preview-img" src="{{ $article->image_url }}" alt="Preview" class="object-cover w-full h-full" />
                    @else
                      <span id="preview-placeholder" class="text-xs text-slate-400 font-medium">No Image</span>
                      <img id="preview-img" class="object-cover w-full h-full hidden" alt="Preview" />
                    @endif
                  </div>
                  <div class="w-full">
                    <input type="file" name="image" id="image-input" class="file-input file-input-bordered file-input-sm w-full text-sm @error('image') file-input-error @enderror" accept="image/*" />
                    <p class="text-[11px] text-slate-400 mt-1">Format gambar: JPG, PNG, WebP (maks. 2MB). Jika diisi, akan menggantikan gambar saat ini.</p>
                  </div>
                </div>
                @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <!-- Referensi Artikel -->
              <div class="form-control">
                <label class="label pb-1">
                  <span class="label-text text-sm font-medium text-slate-800">Referensi artikel (opsional)</span>
                </label>
                <textarea name="references" rows="3"
                  class="textarea textarea-bordered w-full text-sm font-mono text-xs"
                  placeholder="Contoh:&#10;1. WHO. (2020). Infant and young child feeding.&#10;2. Kementerian Kesehatan RI. (2021). Buku Saku Pemantauan Status Gizi.">{{ old('references', $article?->references) }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Tuliskan daftar referensi/jurnal medis pendukung. Pisahkan setiap baris dengan menekan Enter.</p>
                @error('references') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <!-- Ringkasan -->
              <div class="form-control">
                <label class="label pb-1">
                  <span class="label-text text-sm font-medium text-slate-800">Ringkasan singkat</span>
                </label>
                <textarea name="summary" rows="3"
                  class="textarea textarea-bordered w-full text-sm"
                  placeholder="Protein hewani setiap hari penting untuk pertumbuhan optimal anak dan pencegahan stunting.">{{ old('summary', $article?->summary) }}</textarea>
              </div>

              <!-- Markdown editor + live preview -->
              <div class="form-control">
                <div class="flex items-center justify-between mb-2">
                  <label class="label p-0">
                    <span class="label-text text-sm font-medium text-slate-800">Isi artikel (Markdown)</span>
                  </label>
                  <div class="text-xs text-slate-500 flex items-center gap-3">
                    <span class="flex items-center gap-1 cursor-pointer font-medium text-slate-600"><span class="material-symbols-rounded text-sm">edit</span>Editor</span>
                    <span class="flex items-center gap-1 cursor-pointer text-slate-400"><span class="material-symbols-rounded text-sm">preview</span>Preview</span>
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <textarea id="markdown-input" name="content" rows="14"
                    class="textarea textarea-bordered w-full text-sm leading-relaxed"
                    placeholder="# Judul contoh&#10;&#10;Protein hewani dibutuhkan untuk membantu pembentukan jaringan tubuh dan mendukung pertumbuhan anak.&#10;&#10;- Telur&#10;- Ikan&#10;- Daging ayam&#10;- Hati&#10;- Susu&#10;&#10;Dalam pencegahan stunting, protein hewani perlu disertai pemantauan pertumbuhan, ASI eksklusif, MPASI yang tepat, imunisasi, dan kebersihan lingkungan."
                    required>{{ old('content', $article?->content) }}</textarea>
                  <div id="markdown-preview"
                    class="border border-slate-200 rounded-xl bg-slate-50 p-3 text-sm markdown-preview overflow-auto min-h-[20rem] text-slate-700">
                  </div>
                </div>
                @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-100 items-center">
                <button type="submit" class="btn btn-primary btn-sm rounded-full ml-auto">
                  <span class="material-symbols-rounded text-sm">save</span>Simpan perubahan
                </button>
              </div>
            </div>

            <!-- Kolom kanan: pengaturan -->
            <div class="space-y-4">

              <!-- Pengaturan publikasi -->
              <div class="bg-white border border-slate-200 rounded-2xl p-4">
                <h3 class="text-sm font-semibold text-slate-900 mb-3">Pengaturan publikasi</h3>
                <div class="space-y-3">
                  <label class="flex items-center justify-between gap-3 text-sm cursor-pointer">
                    <span class="text-slate-600">Terbitkan artikel</span>
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" class="toggle toggle-success"
                      {{ old('is_published', ($article && $article->status === 'published')) ? 'checked' : '' }} />
                  </label>
                  <label class="flex items-center justify-between gap-3 text-sm cursor-pointer">
                    <span class="text-slate-600">Tampilkan di beranda</span>
                    <input type="hidden" name="show_on_homepage" value="0">
                    <input type="checkbox" name="show_on_homepage" value="1" class="toggle toggle-success"
                      {{ old('show_on_homepage', $article?->show_on_homepage) ? 'checked' : '' }} />
                  </label>
                  <label class="flex items-center justify-between gap-3 text-sm cursor-pointer">
                    <span class="text-slate-600">Artikel unggulan</span>
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" class="toggle toggle-success"
                      {{ old('is_featured', $article?->is_featured) ? 'checked' : '' }} />
                  </label>
                </div>
              </div>

              <!-- SEO -->
              <div class="bg-white border border-slate-200 rounded-2xl p-4">
                <h3 class="text-sm font-semibold text-slate-900 mb-3">SEO & meta</h3>
                <div class="space-y-3">
                  <div class="form-control">
                    <label class="label pb-1"><span class="label-text text-sm font-medium text-slate-700">Meta title</span></label>
                    <input type="text" name="meta_title" class="input input-bordered w-full text-sm"
                      placeholder="Protein Hewani Harian untuk Pert." value="{{ old('meta_title', $article?->meta_title) }}" />
                  </div>
                  <div class="form-control">
                    <label class="label pb-1"><span class="label-text text-sm font-medium text-slate-700">Meta description</span></label>
                    <textarea name="meta_description" rows="3" class="textarea textarea-bordered w-full text-sm"
                      placeholder="Artikel edukasi tentang pentingnya protein hewani harian untuk pertumbuhan anak...">{{ old('meta_description', $article?->meta_description) }}</textarea>
                  </div>
                </div>
              </div>

              <!-- Info -->
              <div class="bg-white border border-slate-200 rounded-2xl p-4">
                <h3 class="text-xs font-semibold text-slate-800 mb-2 flex items-center gap-1">
                  <span class="material-symbols-rounded text-sm text-slate-500">info</span>Informasi artikel
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                  Data seperti jumlah pembaca dan dibagikan akan ditampilkan di dashboard utama. Di halaman ini fokus ke konten dan publikasi saja.
                </p>
              </div>

            </div>
          </div>
        </form>
@endsection

@section('scripts')
  <script>
    const titleInput  = document.getElementById('title-input');
    const slugInput   = document.getElementById('slug-input');
    const headerTitle = document.getElementById('header-title');
    if (titleInput && slugInput) {
      titleInput.addEventListener('input', function() {
        if (headerTitle) headerTitle.textContent = this.value || 'Artikel baru';
        if (!slugInput.dataset.manual) {
          slugInput.value = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
        }
      });
      slugInput.addEventListener('input', function() { this.dataset.manual='true'; });
    }
    function escapeHtml(s){ return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
    function md2html(t){
      if(!t) return '';
      let h=escapeHtml(t);
      h=h.replace(/^### (.*)$/gm,'<h3>$1</h3>');
      h=h.replace(/^## (.*)$/gm,'<h2>$1</h2>');
      h=h.replace(/^# (.*)$/gm,'<h1>$1</h1>');
      h=h.replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>');
      h=h.replace(/`([^`]+)`/g,'<code>$1</code>');
      h=h.replace(/^\s*-\s+(.*)$/gm,'<li>$1</li>');
      h=h.replace(/(<li>[\s\S]*?<\/li>)/g,'<ul>$1</ul>');
      h=h.replace(/(^|\n)([^<\n][^\n]*)/g,function(m,br,l){
        if(!l.trim()) return m;
        if(l.startsWith('<h')||l.startsWith('<ul>')||l.startsWith('<li>')) return br+l;
        return br+'<p>'+l+'</p>';
      });
      return h;
    }
    function updatePreview(){
      const i=document.getElementById('markdown-input');
      const p=document.getElementById('markdown-preview');
      if(i&&p) p.innerHTML=md2html(i.value);
    }
    document.addEventListener('DOMContentLoaded',function(){
      updatePreview();
      const i=document.getElementById('markdown-input');
      if(i) i.addEventListener('input',updatePreview);

      // Live Image Preview lokal
      const imageInput = document.getElementById('image-input');
      const previewImg = document.getElementById('preview-img');
      const previewPlaceholder = document.getElementById('preview-placeholder');

      if (imageInput) {
        imageInput.addEventListener('change', function() {
          const file = this.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
              }
              if (previewPlaceholder) {
                previewPlaceholder.classList.add('hidden');
              }
            }
            reader.readAsDataURL(file);
          }
        });
      }
    });
  </script>
@endsection
