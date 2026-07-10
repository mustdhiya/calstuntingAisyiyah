<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin – Konfigurasi Hasil Analisis Risiko</title>
  <meta name="description" content="Halaman admin untuk mengisi parameter analisis risiko stunting dan menghasilkan ringkasan hasil secara manual." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: Inter, sans-serif; }
    .material-symbols-rounded {
      font-variation-settings:'FILL' 1,'wght' 500,'GRAD' 0,'opsz' 24;
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">

  <!-- Navbar Admin -->
  <header class="navbar bg-white border-b border-slate-200 sticky top-0 z-50 px-4 lg:px-8">
    <div class="navbar-start">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center">
          <span class="material-symbols-rounded">admin_panel_settings</span>
        </div>
        <div>
          <div class="font-extrabold text-emerald-700 text-sm">Admin SiCegah</div>
          <div class="text-xs text-slate-500">Konfigurasi hasil analisis</div>
        </div>
      </a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal gap-1 text-sm">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.analisis') }}" class="font-semibold text-emerald-700">Hasil analisis</a></li>
        <li><a href="{{ route('admin.artikel.list') }}">Konten edukasi</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      @auth
        <span class="hidden sm:inline-flex items-center gap-2 text-xs text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full">
          <span class="material-symbols-rounded text-sm">account_circle</span>
          {{ Auth::user()->name }}
        </span>
      @endauth
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 lg:px-8 py-8">
    <!-- Header -->
    <section class="mb-6">
      <p class="text-xs font-semibold text-emerald-700 mb-1 flex items-center gap-1">
        <span class="material-symbols-rounded text-sm">tune</span>
        Konfigurasi parameter hasil
      </p>
      <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">
        Form admin hasil analisis risiko
      </h1>
      <p class="text-slate-600 mt-2 text-sm max-w-3xl">
        Admin dapat mengatur parameter (status, skor risiko, faktor, dan rekomendasi) secara manual.
        Hasil di bawah akan menyesuaikan dengan isian form, tanpa menampilkan data identitas ibu atau anak.
      </p>
    </section>

    <div class="grid lg:grid-cols-3 gap-6">
      <!-- FORM PARAMETER -->
      <section class="lg:col-span-1">
        <div class="card bg-white border border-slate-200 shadow-sm">
          <div class="card-body">
            <h2 class="card-title text-sm font-semibold text-slate-900 mb-1">
              <span class="material-symbols-rounded text-base text-emerald-600">edit_note</span>
              Parameter utama
            </h2>
            <p class="text-[12px] text-slate-500 mb-3">
              Isi parameter di bawah ini. Tekan tombol "Perbarui pratinjau" untuk melihat perubahan pada panel hasil.
            </p>

            <form id="paramForm" class="space-y-4">
              <!-- Status risiko -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-xs font-medium text-slate-700">
                    Status risiko
                  </span>
                </label>
                <select id="status" class="select select-bordered select-sm w-full">
                  <option value="normal">Normal</option>
                  <option value="rendah">Risiko rendah</option>
                  <option value="sedang" selected>Risiko sedang</option>
                  <option value="tinggi">Risiko tinggi</option>
                  <option value="sangat_tinggi">Stunting / risiko sangat tinggi</option>
                </select>
              </div>

              <!-- Skor (0-100) -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-xs font-medium text-slate-700">
                    Skor risiko (0–100)
                  </span>
                  <span class="label-text-alt text-[11px] text-slate-400" id="labelSkor">
                    Posisi saat ini: 62
                  </span>
                </label>
                <input id="skor" type="number" min="0" max="100"
                       class="input input-bordered input-sm w-full"
                       value="62" />
                <progress id="skorProgress"
                          class="progress progress-warning w-full mt-2"
                          value="62" max="100"></progress>
              </div>

              <!-- Faktor utama (checkbox) -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-xs font-medium text-slate-700">
                    Faktor yang dicentang
                  </span>
                </label>
                <div class="space-y-2 text-xs">
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="checkbox checkbox-xs"
                           value="tinggi_rendah"
                           checked />
                    <span>Tinggi badan relatif rendah untuk usia</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="checkbox checkbox-xs"
                           value="berat_pantau"
                           checked />
                    <span>Berat badan perlu dipantau</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="checkbox checkbox-xs"
                           value="tinggi_ibu_rendah"
                           checked />
                    <span>Tinggi ibu & riwayat gizi menjadi faktor tambahan</span>
                  </label>
                </div>
              </div>

              <!-- Rekomendasi (textarea pendek) -->
              <div class="form-control">
                <label class="label">
                  <span class="label-text text-xs font-medium text-slate-700">
                    Catatan / fokus rekomendasi
                  </span>
                  <span class="label-text-alt text-[11px] text-slate-400">
                    Opsional
                  </span>
                </label>
                <textarea id="catatan"
                          class="textarea textarea-bordered textarea-xs w-full"
                          rows="3"
                          placeholder="Contoh: fokus ke pola makan, pemantauan berkala, dan konsultasi bila ada infeksi berulang."></textarea>
              </div>

              <!-- Tombol -->
              <div class="flex gap-2 pt-2">
                <button type="button"
                        id="btnUpdate"
                        class="btn btn-primary btn-sm rounded-full flex-1">
                  <span class="material-symbols-rounded text-sm">refresh</span>
                  Perbarui pratinjau
                </button>
                <button type="reset"
                        class="btn btn-ghost btn-sm rounded-full">
                  Reset
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Panel info kecil -->
        <div class="mt-4 card bg-emerald-50 border border-emerald-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-emerald-800 text-sm">
              <span class="material-symbols-rounded text-base">info</span>
              Petunjuk singkat
            </h3>
            <p class="text-[12px] text-emerald-900">
              Halaman ini dirancang untuk admin. Fokus hanya pada parameter dan hasil,
              tanpa menampilkan identitas anak atau ibu. Hasil ini bisa dipakai untuk
              simulasi edukasi atau rekap internal.
            </p>
          </div>
        </div>
      </section>

      <!-- PANEL HASIL (PRATINJAU) -->
      <section class="lg:col-span-2 space-y-6">
        <!-- STATUS ANALISIS -->
        <div class="card bg-white shadow-lg border border-slate-200">
          <div class="card-body">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
              <div>
                <h2 class="card-title text-2xl" id="hasilTitle">
                  Status Analisis
                </h2>
                <p class="text-slate-500 text-sm" id="hasilSubTitle">
                  Ringkasan hasil berdasarkan parameter yang dipilih admin.
                </p>
              </div>
              <div id="hasilBadge"
                   class="badge badge-warning badge-lg py-4 px-4">
                Risiko Sedang
              </div>
            </div>

            <p class="text-slate-600 mt-3 text-sm" id="hasilDeskripsi">
              Berdasarkan parameter yang diisi admin, sistem menandai risiko berada pada
              kategori sedang. Skor risiko berada di tengah skala, sehingga perlu
              pemantauan pertumbuhan dan penguatan pola makan, namun belum masuk
              kategori sangat tinggi.
            </p>

            <progress id="hasilProgress"
                      class="progress progress-warning w-full mt-3"
                      value="62" max="100"></progress>
            <div class="flex justify-between text-[12px] text-slate-500 mt-1">
              <span>Risiko rendah</span>
              <span id="hasilPosisi">Posisi hasil: 62/100</span>
              <span>Risiko tinggi</span>
            </div>
          </div>
        </div>

        <!-- FAKTOR YANG MEMPENGARUHI -->
        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title text-sm font-semibold text-slate-900">
              Faktor yang memengaruhi (berdasarkan pilihan admin)
            </h2>
            <ul class="timeline timeline-vertical mt-2 text-sm" id="hasilTimeline">
              <!-- Akan diisi via JS sesuai checkbox -->
            </ul>
          </div>
        </div>

        <!-- REKOMENDASI AWAL -->
        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title text-sm font-semibold text-slate-900">
              Rekomendasi awal (disesuaikan status)
            </h2>
            <div class="space-y-3 text-sm" id="hasilRekomendasi">
              <!-- Diisi dinamis sesuai status -->
            </div>
          </div>
        </div>

        <!-- DISCLAIMER -->
        <div class="alert alert-warning">
          <span class="material-symbols-rounded">warning</span>
          <span class="text-xs">
            Hasil ini disusun dari parameter yang diisi admin dan hanya untuk keperluan
            edukasi & monitoring internal. Tidak menggantikan konsultasi medis profesional.
          </span>
        </div>
      </section>
    </div>
  </main>

  <footer class="footer p-6 bg-slate-900 text-slate-200 text-xs mt-8">
    <div class="max-w-6xl mx-auto w-full flex flex-col sm:flex-row gap-4 justify-between">
      <div>
        <p class="font-semibold">Admin SiCegah Stunting</p>
        <p>Pengurus Wilayah Aisyiyah Kalimantan Timur</p>
      </div>
      <div class="flex gap-4">
        <a href="{{ route('home') }}" class="link link-hover">Lihat halaman publik</a>
        <a href="{{ route('kalkulator') }}" class="link link-hover">Kalkulator publik</a>
      </div>
    </div>
  </footer>

  <script>
    const rekomendasiDefault = {
      normal: [
        {
          tone: "emerald",
          text: "Pertahankan pola makan seimbang dan jadwal pemantauan rutin di Posyandu."
        },
        {
          tone: "cyan",
          text: "Pastikan imunisasi lengkap dan pemantauan perkembangan dilakukan sesuai jadwal."
        }
      ],
      rendah: [
        {
          tone: "emerald",
          text: "Perkuat asupan protein hewani dan sayuran setiap hari."
        },
        {
          tone: "cyan",
          text: "Pantau kenaikan berat dan tinggi badan minimal setiap bulan."
        }
      ],
      sedang: [
        {
          tone: "emerald",
          text: "Tinjau kembali pola makan harian, terutama frekuensi dan kualitas sumber protein hewani."
        },
        {
          tone: "cyan",
          text: "Lakukan pemantauan tinggi badan dan berat badan secara rutin di Posyandu atau Puskesmas."
        },
        {
          tone: "amber",
          text: "Segera konsultasikan ke tenaga kesehatan bila ada infeksi berulang atau nafsu makan menurun."
        }
      ],
      tinggi: [
        {
          tone: "amber",
          text: "Segera rujuk ke fasilitas kesehatan untuk evaluasi pertumbuhan lebih lanjut."
        },
        {
          tone: "rose",
          text: "Pertimbangkan pemeriksaan tambahan bila ada tanda-tanda kelemahan umum atau infeksi kronis."
        }
      ],
      sangat_tinggi: [
        {
          tone: "rose",
          text: "Perlu evaluasi komprehensif oleh tenaga kesehatan, termasuk pemeriksaan status gizi dan penyakit penyerta."
        },
        {
          tone: "amber",
          text: "Pendampingan intensif kepada keluarga untuk perbaikan pola makan dan lingkungan rumah."
        }
      ]
    };

    function getBadgeConfig(status) {
      switch (status) {
        case "normal":
          return { text: "Normal", cls: "badge-success", progressCls: "progress-success" };
        case "rendah":
          return { text: "Risiko Rendah", cls: "badge-info", progressCls: "progress-info" };
        case "sedang":
          return { text: "Risiko Sedang", cls: "badge-warning", progressCls: "progress-warning" };
        case "tinggi":
          return { text: "Risiko Tinggi", cls: "badge-error", progressCls: "progress-error" };
        case "sangat_tinggi":
          return { text: "Stunting / Risiko Sangat Tinggi", cls: "badge-error", progressCls: "progress-error" };
        default:
          return { text: "Tidak diketahui", cls: "badge-outline", progressCls: "progress" };
      }
    }

    function buildTimelineItems(selectedFactors) {
      const items = [];

      if (selectedFactors.includes("tinggi_rendah")) {
        items.push({
          icon: "straighten",
          colorClass: "text-emerald-600",
          lineClass: "bg-emerald-500",
          text: "Tinggi badan anak relatif rendah untuk kelompok usia yang dinilai."
        });
      }

      if (selectedFactors.includes("berat_pantau")) {
        items.push({
          icon: "monitor_weight",
          colorClass: "text-cyan-600",
          lineClass: "bg-cyan-500",
          text: "Berat badan perlu dipantau agar mengikuti pola pertumbuhan yang sehat."
        });
      }

      if (selectedFactors.includes("tinggi_ibu_rendah")) {
        items.push({
          icon: "family_home",
          colorClass: "text-amber-600",
          lineClass: "bg-amber-500",
          text: "Tinggi ibu dan riwayat kondisi gizi dapat menjadi faktor tambahan dalam skrining risiko."
        });
      }

      return items;
    }

    function renderTimeline(timelineEl, items) {
      timelineEl.innerHTML = "";
      if (!items.length) {
        timelineEl.innerHTML = `
          <li>
            <div class="timeline-start timeline-box text-xs">
              Belum ada faktor yang dipilih. Centang minimal satu faktor di panel parameter.
            </div>
            <div class="timeline-middle text-slate-500">
              <span class="material-symbols-rounded">info</span>
            </div>
          </li>
        `;
        return;
      }

      items.forEach((item, idx) => {
        const isLast = idx === items.length - 1;
        const aboveClass = idx === 0 ? "" : item.lineClass;
        const belowClass = isLast ? "" : item.lineClass;

        timelineEl.innerHTML += `
          <li>
            ${idx === 0 ? "" : `<hr class="${aboveClass}" />`}
            <div class="timeline-start timeline-box text-xs">
              ${item.text}
            </div>
            <div class="timeline-middle ${item.colorClass}">
              <span class="material-symbols-rounded">${item.icon}</span>
            </div>
            ${isLast ? "" : `<hr class="${belowClass}" />`}
          </li>
        `;
      });
    }

    function renderRekomendasi(container, status, customNote) {
      const list = rekomendasiDefault[status] || [];
      if (!list.length && !customNote) {
        container.innerHTML = `
          <div class="alert bg-slate-50 border border-slate-200 text-xs">
            <span class="material-symbols-rounded text-slate-600">info</span>
            <span>Belum ada rekomendasi khusus untuk status ini. Admin dapat menambahkan catatan di form.</span>
          </div>
        `;
        return;
      }

      container.innerHTML = "";

      list.forEach(rec => {
        const tone = rec.tone || "emerald";
        const bgClass = tone === "emerald" ? "bg-emerald-50 border-emerald-100 text-emerald-900"
                      : tone === "cyan" ? "bg-cyan-50 border-cyan-100 text-cyan-900"
                      : tone === "amber" ? "bg-amber-50 border-amber-100 text-amber-900"
                      : "bg-rose-50 border-rose-100 text-rose-900";

        const iconClass = tone === "emerald" ? "text-emerald-700"
                        : tone === "cyan" ? "text-cyan-700"
                        : tone === "amber" ? "text-amber-700"
                        : "text-rose-700";

        container.innerHTML += `
          <div class="alert border ${bgClass} text-xs">
            <span class="material-symbols-rounded ${iconClass}">check_circle</span>
            <span>${rec.text}</span>
          </div>
        `;
      });

      if (customNote && customNote.trim() !== "") {
        container.innerHTML += `
          <div class="alert bg-slate-50 border border-slate-200 text-xs">
            <span class="material-symbols-rounded text-slate-700">edit</span>
            <span>${customNote}</span>
          </div>
        `;
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      const statusSelect = document.getElementById("status");
      const skorInput = document.getElementById("skor");
      const labelSkor = document.getElementById("labelSkor");
      const skorProgress = document.getElementById("skorProgress");
      const form = document.getElementById("paramForm");

      const hasilBadge = document.getElementById("hasilBadge");
      const hasilProgress = document.getElementById("hasilProgress");
      const hasilPosisi = document.getElementById("hasilPosisi");
      const hasilDeskripsi = document.getElementById("hasilDeskripsi");
      const hasilTitle = document.getElementById("hasilTitle");
      const hasilSubTitle = document.getElementById("hasilSubTitle");
      const hasilTimeline = document.getElementById("hasilTimeline");
      const hasilRekomendasi = document.getElementById("hasilRekomendasi");

      skorInput.addEventListener("input", () => {
        let val = Number(skorInput.value || 0);
        if (val < 0) val = 0;
        if (val > 100) val = 100;
        skorInput.value = val;
        labelSkor.textContent = `Posisi saat ini: ${val}`;
        skorProgress.value = val;
      });

      document.getElementById("btnUpdate").addEventListener("click", () => {
        const status = statusSelect.value;
        const skor = Number(skorInput.value || 0);
        const badgeCfg = getBadgeConfig(status);

        hasilBadge.textContent = badgeCfg.text;
        hasilBadge.className = `badge badge-lg py-4 px-4 ${badgeCfg.cls}`;
        hasilProgress.value = skor;
        hasilProgress.className = `progress w-full mt-3 ${badgeCfg.progressCls}`;
        hasilPosisi.textContent = `Posisi hasil: ${skor}/100`;

        let desc = "";
        switch (status) {
          case "normal":
            desc = "Parameter yang diisi admin menunjukkan bahwa hasil berada dalam kategori normal. Tetap jaga pola makan seimbang dan lakukan pemantauan rutin.";
            break;
          case "rendah":
            desc = "Parameter menunjukkan risiko rendah. Tetap perlu pemantauan berkala untuk memastikan anak tetap berada pada jalur pertumbuhan yang sehat.";
            break;
          case "sedang":
            desc = "Parameter menunjukkan risiko sedang. Diperlukan penguatan pola makan, pemantauan tinggi dan berat badan, serta kewaspadaan terhadap infeksi berulang.";
            break;
          case "tinggi":
            desc = "Parameter menunjukkan risiko tinggi. Disarankan untuk segera berkonsultasi dengan tenaga kesehatan untuk evaluasi lebih mendalam.";
            break;
          case "sangat_tinggi":
            desc = "Parameter menunjukkan risiko sangat tinggi / indikasi stunting. Perlu evaluasi komprehensif oleh tenaga kesehatan dan pendampingan intensif.";
            break;
          default:
            desc = "Parameter belum lengkap atau status tidak dikenali.";
        }
        hasilDeskripsi.textContent = desc;
        hasilTitle.textContent = "Status Analisis";
        hasilSubTitle.textContent = "Ringkasan hasil berdasarkan parameter yang dipilih admin.";

        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
        const selectedFactors = Array.from(checkboxes)
          .filter(cb => cb.checked)
          .map(cb => cb.value);

        const timelineItems = buildTimelineItems(selectedFactors);
        renderTimeline(hasilTimeline, timelineItems);

        const catatan = document.getElementById("catatan").value;
        renderRekomendasi(hasilRekomendasi, status, catatan);
      });

      const event = new Event("click");
      document.getElementById("btnUpdate").dispatchEvent(event);
    });
  </script>
</body>
</html>
