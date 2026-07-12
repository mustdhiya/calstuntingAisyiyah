<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Analisis Risiko - SiCegah Stunting</title>
  <meta name="description" content="Contoh hasil analisis risiko stunting lengkap dengan badge status, faktor yang memengaruhi, dan rekomendasi awal." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    rel="icon"
    type="image/svg+xml"
    href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='8' y='8' width='48' height='48' rx='14' fill='%2316a34a'/%3E%3Cpath d='M32 18c-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 18.8 18c-3.5 0-6.3 2.8-6.3 6.3 0 2 .9 3.9 2.4 5.1L32 45l17.1-15.6a6.26 6.26 0 0 0 2.1-4.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.3.7-4.5 1.9l-2.1 2.1-2.1-2.1A6.36 6.36 0 0 0 32 18Z' fill='white'/%3E%3Cpath d='M29 24h6v6h6v6h-6v6h-6v-6h-6v-6h6z' fill='%2316a34a'/%3E%3C/svg%3E"
    sizes="any"
  />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: Inter, sans-serif;
    }
    .material-symbols-rounded {
      font-variation-settings:
        "FILL" 1,
        "wght" 500,
        "GRAD" 0,
        "opsz" 24;
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">
  <header class="navbar bg-white border-b border-slate-200 sticky top-0 z-50 px-4 lg:px-8">
    <div class="navbar-start">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center">
          <span class="material-symbols-rounded">health_and_safety</span>
        </div>
        <div>
          <div class="font-extrabold text-emerald-700">SiCegah Stunting</div>
          <div class="text-xs text-slate-500">Edukasi dan Skrining Awal</div>
        </div>
      </a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal gap-1">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('kalkulator') }}">Kalkulator</a></li>
        <li><a href="{{ route('edukasi') }}">Edukasi</a></li>
        <li><a href="{{ url('/tentang') }}">Tentang</a></li>
        <li><a href="{{ url('/faq') }}">FAQ</a></li>
        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
      </ul>
    </div>
    <div class="navbar-end gap-2">
      @guest
        <a href="{{ route('login') }}" class="btn btn-outline border-emerald-600 text-emerald-700 hover:bg-emerald-50 rounded-full px-4 btn-sm font-semibold">
          <span class="material-symbols-rounded text-sm">login</span>
          Masuk
        </a>
      @endguest

      @auth
        <div class="hidden md:flex items-center gap-1 bg-slate-100 rounded-full px-2.5 py-1 text-xs font-semibold text-slate-600">
          <span class="material-symbols-rounded text-base text-emerald-600">account_circle</span>
          <span class="max-w-[70px] truncate">{{ Auth::user()->name }}</span>
        </div>
        @if(Auth::user()->isAdminWilayah())
          <a href="{{ route('admin.dashboard') }}" class="btn bg-slate-800 hover:bg-slate-900 text-white rounded-full px-4 btn-sm font-semibold border-0">
            Dashboard
          </a>
        @endif
        @if(!Auth::user()->isAdminWilayah())
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="btn bg-red-50 hover:bg-red-100 text-red-600 rounded-full px-4 btn-sm font-semibold border-0">
            Keluar
          </button>
        </form>
        @endif
      @endauth

      <a href="{{ route('kalkulator') }}" class="btn btn-primary rounded-full px-5 btn-sm font-semibold">Hitung Ulang</a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 lg:px-8 py-10">
    <section class="mb-8">
      <div class="badge badge-warning badge-outline mb-3">
        Contoh Hasil Analisis
      </div>
      <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">
        Ringkasan hasil skrining awal
      </h1>
      <p class="text-slate-600 mt-3 max-w-3xl">
        Halaman ini menampilkan contoh hasil dengan status risiko sedang agar
        mudah dipresentasikan dalam konteks edukasi masyarakat dan pengabdian
        masyarakat.
      </p>
    </section>

    <div class="grid lg:grid-cols-3 gap-6">
      <section class="lg:col-span-2 space-y-6">
        <div class="card bg-white shadow-lg border border-slate-200">
          <div class="card-body">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
              <div>
                <h2 class="card-title text-2xl">Status Analisis</h2>
                <p class="text-slate-500">
                  Nama anak: Aulia Rahma, usia 24 bulan
                </p>
              </div>
              <div class="badge badge-warning badge-lg py-4 px-4">
                Risiko Sedang
              </div>
            </div>
            <p class="text-slate-600">
              Data contoh menunjukkan bahwa tinggi badan anak berada di bawah
              harapan untuk usianya, disertai beberapa faktor yang dapat
              meningkatkan risiko gangguan pertumbuhan. Penilaian tinggi badan
              menurut usia merupakan indikator utama untuk identifikasi
              stunting pada balita.
            </p>
            <progress class="progress progress-warning w-full" value="62" max="100"></progress>
            <div class="flex justify-between text-sm text-slate-500">
              <span>Risiko rendah</span><span>Posisi hasil: 62/100</span><span>Risiko tinggi</span>
            </div>
          </div>
        </div>

        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title">Faktor yang memengaruhi</h2>
            <ul class="timeline timeline-vertical">
              <li>
                <div class="timeline-start timeline-box bg-slate-50 text-slate-700 border-slate-200">
                  Tinggi badan anak relatif rendah untuk usia 24 bulan.
                </div>
                <div class="timeline-middle text-emerald-600">
                  <span class="material-symbols-rounded">straighten</span>
                </div>
                <hr class="bg-emerald-500" />
              </li>
              <li>
                <hr class="bg-emerald-500" />
                <div class="timeline-start timeline-box bg-slate-50 text-slate-700 border-slate-200">
                  Berat badan perlu dipantau agar sesuai dengan pertumbuhan
                  usia.
                </div>
                <div class="timeline-middle text-cyan-600">
                  <span class="material-symbols-rounded">monitor_weight</span>
                </div>
                <hr class="bg-cyan-500" />
              </li>
              <li>
                <hr class="bg-cyan-500" />
                <div class="timeline-start timeline-box bg-slate-50 text-slate-700 border-slate-200">
                  Tinggi ibu di bawah 150 cm dan riwayat KEK dapat menjadi
                  faktor risiko tambahan dalam skrining.[web:25]
                </div>
                <div class="timeline-middle text-amber-600">
                  <span class="material-symbols-rounded">family_home</span>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="card bg-white shadow-md border border-slate-200">
          <div class="card-body">
            <h2 class="card-title">Rekomendasi awal</h2>
            <div class="space-y-4">
              <div class="alert bg-emerald-50 border border-emerald-100">
                <span class="material-symbols-rounded text-emerald-700">check_circle</span>
                <span>Tinjau kembali pola makan anak dan utamakan protein hewani harian setelah usia 6 bulan.</span>
              </div>
              <div class="alert bg-cyan-50 border border-cyan-100">
                <span class="material-symbols-rounded text-cyan-700">check_circle</span>
                <span>Lakukan pemantauan berat badan dan tinggi badan secara rutin di Posyandu atau Puskesmas.</span>
              </div>
              <div class="alert bg-amber-50 border border-amber-100">
                <span class="material-symbols-rounded text-amber-700">check_circle</span>
                <span>Konsultasikan dengan tenaga kesehatan bila ada penurunan nafsu makan, infeksi berulang, atau pertumbuhan anak tidak sesuai.</span>
              </div>
            </div>
          </div>
        </div>

        <div class="alert alert-warning">
          <span class="material-symbols-rounded">warning</span>
          <span>Disclaimer: hasil ini hanya contoh skrining awal untuk edukasi dan tidak menggantikan diagnosis atau konsultasi medis profesional.</span>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
          <a href="{{ route('edukasi') }}" class="btn btn-primary rounded-full">Lanjut ke Edukasi</a>
          <a href="{{ route('kalkulator') }}" class="btn btn-outline btn-secondary rounded-full">Hitung Ulang</a>
        </div>
      </section>

      <aside class="space-y-6">
        <div class="card bg-emerald-50 border border-emerald-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-emerald-800">Ringkasan data</h3>
            <div class="overflow-x-auto">
              <table class="table table-sm">
                <tbody>
                  <tr>
                    <td>Usia</td>
                    <td>24 bulan</td>
                  </tr>
                  <tr>
                    <td>Jenis kelamin</td>
                    <td>Perempuan</td>
                  </tr>
                  <tr>
                    <td>Tinggi badan</td>
                    <td>80 cm</td>
                  </tr>
                  <tr>
                    <td>Berat badan</td>
                    <td>9,2 kg</td>
                  </tr>
                  <tr>
                    <td>Lokasi</td>
                    <td>Samarinda (Kaltim)</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card bg-cyan-50 border border-cyan-100 shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-cyan-800">Catatan edukasi</h3>
            <p class="text-sm text-cyan-900">
              WHO menyediakan alat dan standar pertumbuhan untuk mendukung implementasi pemantauan fisik anak, termasuk indikator tinggi badan menurut usia.
            </p>
          </div>
        </div>
      </aside>
    </div>
  </main>

  <footer class="footer p-10 bg-slate-900 text-slate-200 mt-10">
    <nav>
      <h6 class="footer-title">Navigasi</h6>
      <a class="link link-hover" href="{{ route('home') }}">Beranda</a>
      <a class="link link-hover" href="{{ route('kalkulator') }}">Kalkulator</a>
      <a class="link link-hover" href="{{ route('hasil') }}">Hasil</a>
    </nav>
    <nav>
      <h6 class="footer-title">Informasi</h6>
      <a class="link link-hover" href="{{ route('edukasi') }}">Edukasi</a>
      <a class="link link-hover" href="{{ url('/faq') }}">FAQ</a>
      <a class="link link-hover" href="{{ url('/kontak') }}">Kontak</a>
    </nav>
    <aside>
      <p>Pengurus Wilayah Aisyiyah Kalimantan Timur</p>
    </aside>
  </footer>
</body>
</html>