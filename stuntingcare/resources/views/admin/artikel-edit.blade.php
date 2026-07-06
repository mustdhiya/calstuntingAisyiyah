<!DOCTYPE html>
<html lang="id"data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Artikel — SiCegah Stunting</title>
  <meta name="description" content="Panel admin untuk mengelola artikel edukasi stunting." />

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
    .markdown-preview h1,
    .markdown-preview h2,
    .markdown-preview h3 {
      font-weight: 600;
      margin-top: 1rem;
      margin-bottom: 0.5rem;
    }
    .markdown-preview p {
      margin-bottom: 0.75rem;
    }
    .markdown-preview ul {
      padding-left: 1.25rem;
      margin-bottom: 0.75rem;
      list-style-type: disc;
    }
    .markdown-preview li {
      margin-bottom: 0.25rem;
    }
    .markdown-preview code {
      background-color: #f3f4f6;
      padding: 0.15rem 0.3rem;
      border-radius: 0.25rem;
      font-size: 0.85em;
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
          <div class="text-xs text-slate-500">Kelola konten edukasi</div>
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
            <a href="{{ route('admin.artikel.list') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 font-medium">
              <span class="material-symbols-rounded text-sm">article</span>
              Artikel edukasi
            </a>
            <a href="{{ route('admin.analisis') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">analytics</span>
              Hasil analisis
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-100">
              <span class="material-symbols-rounded text-sm">group</span>
              Data pengguna
            </a>
          </nav>
        </div>

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
      </aside>

      <!-- Main content -->
      <section class="lg:col-span-9 space-y-4">

        <!-- Header -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
          <div>
            <p class="text-xs text-emerald-700 font-semibold mb-1 flex items-center gap-1">
              <span class="material-symbols-rounded text-sm">edit</span>
              Edit artikel edukasi
            </p>
            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
              Protein hewani harian untuk pertumbuhan optimal anak
            </h1>
            <p class="text-xs text-slate-500 mt-1">
              Perbarui judul, metadata, dan isi artikel dalam satu tempat.
            </p>
          </div>
          <div class="flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">visibility</span>
              Preview
            </button>
            <button type="button" class="btn btn-primary btn-sm rounded-full">
              <span class="material-symbols-rounded text-sm">save</span>
              Simpan
            </button>
          </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

          <!-- Form utama -->
          <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
            <h2 class="text-sm font-semibold text-slate-900 mb-4">Data artikel</h2>

            <form class="space-y-4">

              <!-- Judul -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-sm font-medium">Judul artikel</span>
                </label>
                <input
                  type="text"
                  class="input input-bordered w-full text-sm"
                  value="Protein hewani harian untuk pertumbuhan optimal anak"
                />
              </div>

              <!-- Slug & kategori -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Slug</span>
                  </label>
                  <input
                    type="text"
                    class="input input-bordered w-full text-sm"
                    value="protein-hewani-harian-untuk-pertumbuhan-optimal-anak"
                  />
                </div>
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Kategori</span>
                  </label>
                  <select class="select select-bordered w-full text-sm">
                    <option selected>Gizi Anak</option>
                    <option>MPASI</option>
                    <option>ASI Eksklusif</option>
                    <option>FAQ</option>
                  </select>
                </div>
              </div>

              <!-- Penulis, tanggal, estimasi baca -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Penulis</span>
                  </label>
                  <input
                    type="text"
                    class="input input-bordered w-full text-sm"
                    value="Tim Edukasi SiCegah"
                  />
                </div>
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Tanggal</span>
                  </label>
                  <input
                    type="date"
                    class="input input-bordered w-full text-sm"
                    value="2026-06-07"
                  />
                </div>
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Estimasi baca (menit)</span>
                  </label>
                  <input
                    type="number"
                    min="1"
                    class="input input-bordered w-full text-sm"
                    value="6"
                  />
                </div>
              </div>

              <!-- Ringkasan -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-sm font-medium">Ringkasan singkat</span>
                </label>
                <textarea rows="3" class="textarea textarea-bordered w-full text-sm">
Protein hewani setiap hari penting untuk pertumbuhan optimal anak dan pencegahan stunting.</textarea>
              </div>

              <!-- Markdown editor -->
              <div class="form-control">
                <div class="flex items-center justify-between mb-1.5">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Isi artikel (Markdown)</span>
                  </label>
                  <div class="text-xs text-slate-500 flex items-center gap-2">
                    <span class="flex items-center gap-1">
                      <span class="material-symbols-rounded text-sm">edit</span>
                      Editor
                    </span>
                    <span class="flex items-center gap-1">
                      <span class="material-symbols-rounded text-sm">preview</span>
                      Preview
                    </span>
                  </div>
                </div>

                <!-- Editor + Preview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <!-- Editor -->
                  <textarea
                    id="markdown-input"
                    rows="14"
                    class="textarea textarea-bordered w-full text-sm leading-relaxed"
                  ># Judul contoh

Protein hewani dibutuhkan untuk membantu pembentukan jaringan tubuh dan mendukung pertumbuhan anak.

- Telur
- Ikan
- Daging ayam
- Hati
- Susu

Dalam pencegahan stunting, protein hewani perlu disertai pemantauan pertumbuhan, ASI eksklusif, MPASI yang tepat, imunisasi, dan kebersihan lingkungan.</textarea>

                  <!-- Preview -->
                  <div
                    id="markdown-preview"
                    class="border border-slate-200 rounded-xl bg-slate-50 p-3 text-sm markdown-preview overflow-auto min-h-[5rem]"
                  >
                    <!-- diisi via JS -->
                  </div>
                </div>
              </div>

              <!-- Aksi -->
              <div class="flex flex-wrap gap-2 pt-2">
                <button type="button" class="btn btn-outline btn-sm rounded-full">
                  <span class="material-symbols-rounded text-sm">image</span>
                  Gambar utama
                </button>
                <button type="button" class="btn btn-outline btn-sm rounded-full">
                  <span class="material-symbols-rounded text-sm">link</span>
                  Referensi
                </button>
                <button type="submit" class="btn btn-primary btn-sm rounded-full ml-auto">
                  <span class="material-symbols-rounded text-sm">save</span>
                  Simpan perubahan
                </button>
              </div>
            </form>
          </div>

          <!-- Panel pengaturan -->
          <div class="space-y-4">

            <!-- Publikasi -->
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <h3 class="text-sm font-semibold text-slate-900 mb-3">Pengaturan publikasi</h3>
              <div class="space-y-2 text-sm">
                <label class="flex items-center justify-between gap-3">
                  <span class="text-slate-600">Terbitkan artikel</span>
                  <input type="checkbox" class="toggle toggle-success" checked />
                </label>
                <label class="flex items-center justify-between gap-3">
                  <span class="text-slate-600">Tampilkan di beranda</span>
                  <input type="checkbox" class="toggle toggle-success" checked />
                </label>
                <label class="flex items-center justify-between gap-3">
                  <span class="text-slate-600">Artikel unggulan</span>
                  <input type="checkbox" class="toggle toggle-warning" />
                </label>
              </div>
            </div>

            <!-- SEO -->
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <h3 class="text-sm font-semibold text-slate-900 mb-3">SEO & meta</h3>
              <div class="space-y-3 text-sm">
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Meta title</span>
                  </label>
                  <input
                    type="text"
                    class="input input-bordered w-full text-sm"
                    value="Protein Hewani Harian untuk Pertumbuhan Optimal Anak"
                  />
                </div>
                <div class="form-control">
                  <label class="label">
                    <span class="label-text text-sm font-medium">Meta description</span>
                  </label>
                  <textarea rows="3" class="textarea textarea-bordered w-full text-sm">
Artikel edukasi tentang pentingnya protein hewani harian untuk pertumbuhan optimal anak dan pencegahan stunting.</textarea>
                </div>
              </div>
            </div>

            <!-- Info singkat -->
            <div class="bg-white border border-slate-200 rounded-2xl p-4">
              <h3 class="text-sm font-semibold text-slate-900 mb-2 flex items-center gap-1">
                <span class="material-symbols-rounded text-sm text-slate-600">info</span>
                Informasi artikel
              </h3>
              <p class="text-xs text-slate-500 leading-relaxed">
                Data seperti jumlah pembaca dan dibagikan akan ditampilkan di dashboard utama. Di halaman ini fokus ke konten dan publikasi saja.
              </p>
            </div>

          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Markdown parser sederhana -->
  <script>
    function escapeHtml(str) {
      return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");
    }

    function simpleMarkdownToHtml(text) {
      if (!text) return "";

      let html = escapeHtml(text);

      // Heading
      html = html.replace(/^### (.*)$/gm, "<h3>$1</h3>");
      html = html.replace(/^## (.*)$/gm, "<h2>$1</h2>");
      html = html.replace(/^# (.*)$/gm, "<h1>$1</h1>");

      // Bold
      html = html.replace(/\*\*(.+?)\*\*/g, "<strong>$1</strong>");

      // Inline code
      html = html.replace(/`([^`]+)`/g, "<code>$1</code>");

      // List items (- )
      html = html.replace(/^\s*-\s+(.*)$/gm, "<li>$1</li>");
      // Bungkus kelompok <li> berurutan ke dalam <ul>
      html = html.replace(/(<li>[\s\S]*?<\/li>)/g, "<ul>$1</ul>");

      // Paragraf (baris non-heading, non-list)
      html = html.replace(/(^|\n)([^<\n][^\n]*)/g, function(match, br, line) {
        if (!line.trim()) return match;
        if (line.startsWith("<h") || line.startsWith("<ul>") || line.startsWith("<li>")) {
          return br + line;
        }
        return br + "<p>" + line + "</p>";
      });

      return html;
    }

    function updatePreview() {
      const input = document.getElementById("markdown-input");
      const preview = document.getElementById("markdown-preview");
      if (!input || !preview) return;
      preview.innerHTML = simpleMarkdownToHtml(input.value);
    }

    document.addEventListener("DOMContentLoaded", function () {
      updatePreview();
      const input = document.getElementById("markdown-input");
      if (input) {
        input.addEventListener("input", updatePreview);
      }
    });
  </script>
</body>
</html>