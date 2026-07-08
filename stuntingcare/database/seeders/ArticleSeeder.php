<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan artikel lama agar tidak terjadi duplikasi slug
        Article::query()->delete();

        $admin = User::where('role', 'admin_wilayah')->first();
        if (!$admin) {
            $admin = User::first();
        }

        $articlesData = [
            // ==================== 1. Gizi Anak (3) ====================
            [
                'title'            => 'Protein Hewani Harian untuk Pertumbuhan Optimal Anak',
                'category'         => 'Gizi Anak',
                'summary'          => 'Pentingnya konsumsi protein hewani setiap hari untuk mendukung tumbuh kembang anak dan pencegahan stunting.',
                'content'          => "# Protein Hewani untuk Anak\n\nProtein hewani sangat penting karena mengandung asam amino esensial lengkap yang dibutuhkan untuk pembentukan jaringan tubuh dan mendukung pertumbuhan tinggi badan anak.\n\nBeberapa sumber protein hewani terbaik:\n- **Telur**: Sumber protein murah dan lengkap.\n- **Ikan**: Terutama ikan lokal seperti kembung yang kaya Omega-3.\n- **Daging ayam dan sapi**: Kaya zat besi untuk mencegah anemia.\n- **Susu dan produk olahannya**: Sumber kalsium yang baik.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => true,
                'read_time'        => 5,
                'published_date'   => now()->subDays(2),
                'image'            => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Kementerian Kesehatan RI. (2022). Profil Kesehatan Indonesia Tahun 2021.\n2. WHO. (2020). Nutrition and food safety: Infant and young child feeding.",
            ],
            [
                'title'            => 'Kebutuhan Vitamin D dan Kalsium untuk Pertumbuhan Tulang Anak',
                'category'         => 'Gizi Anak',
                'summary'          => 'Vitamin D dan kalsium bekerja bersama secara sinergis untuk membangun tulang yang kuat pada masa pertumbuhan balita.',
                'content'          => "# Sinergi Kalsium dan Vitamin D\n\nKalsium adalah mineral utama pembentuk tulang, sementara Vitamin D membantu penyerapannya di dalam tubuh. Kekurangan salah satunya dapat memicu gangguan pertumbuhan tinggi badan.\n\nTips pemenuhan:\n1. Ajak anak beraktivitas di bawah sinar matahari pagi (10-15 menit).\n2. Berikan makanan kaya kalsium seperti teri, tempe, dan sayuran hijau.\n3. Pertimbangkan konsumsi susu pertumbuhan jika asupan harian kurang.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 4,
                'published_date'   => now()->subDays(5),
                'image'            => 'https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. IDAI. (2018). Rekomendasi Suplementasi Vitamin D pada Anak.\n2. British Nutrition Foundation. (2021). Calcium and Vitamin D in Children's Diets.",
            ],
            [
                'title'            => 'Pentingnya Memantau Berat Badan Balita Setiap Bulan di Posyandu',
                'category'         => 'Gizi Anak',
                'summary'          => 'Kenaikan berat badan yang tidak adekuat (faltering) adalah tanda awal sebelum terjadinya stunting.',
                'content'          => "# Deteksi Dini via Posyandu\n\nStunting tidak terjadi secara tiba-tiba. Biasanya diawali dengan berat badan anak yang sulit naik atau grafiknya mendatar pada KMS (Kartu Menuju Sehat).\n\nLangkah pencegahan:\n- Timbang berat badan dan ukur tinggi badan balita rutin setiap bulan.\n- Konsultasikan ke petugas kesehatan jika berat badan tidak naik 2 kali berturut-turut.\n- Lakukan evaluasi asupan makan harian anak.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => false,
                'read_time'        => 4,
                'published_date'   => now()->subDays(10),
                'image'            => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Depkes RI. (2019). Buku KIA (Kesehatan Ibu dan Anak).\n2. UNICEF. (2021). Child Malnutrition in Indonesia: A Policy Brief.",
            ],

            // ==================== 2. ASI Eksklusif (3) ====================
            [
                'title'            => 'ASI Eksklusif: Investasi Terbaik untuk Masa Depan Anak',
                'category'         => 'ASI Eksklusif',
                'summary'          => 'Pemberian ASI eksklusif selama 6 bulan pertama memberikan perlindungan optimal bagi bayi dari berbagai infeksi.',
                'content'          => "# Keajaiban ASI Eksklusif\n\nASI eksklusif artinya hanya memberikan ASI saja tanpa makanan atau minuman lain termasuk air putih selama 6 bulan pertama kehidupan.\n\nManfaat utama:\n- Mengandung antibodi alami untuk kekebalan tubuh bayi.\n- Komposisi nutrisi yang dinamis dan menyesuaikan kebutuhan usia bayi.\n- Mempererat ikatan psikologis (bonding) antara ibu dan anak.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => true,
                'read_time'        => 5,
                'published_date'   => now()->subDays(1),
                'image'            => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. WHO & UNICEF. (2021). Global breastfeeding scorecard.\n2. IDAI. (2020). Nilai Nutrisi ASI dan Praktik Menyusui Terkini.",
            ],
            [
                'title'            => 'Cara Menyimpan ASI Perah agar Nutrisinya Tetap Terjaga',
                'category'         => 'ASI Eksklusif',
                'summary'          => 'Panduan bagi ibu pekerja untuk memerah, menyimpan, dan menyajikan ASI dengan cara yang benar.',
                'content'          => "# Penyimpanan ASI Perah (ASIP)\n\nAgar nutrisi dalam ASIP tidak rusak, perhatikan aturan penyimpanan berikut:\n- **Suhu Ruang**: Bertahan hingga 4 jam.\n- **Cooler Bag**: Bertahan hingga 24 jam.\n- **Kulkas Bawah**: Bertahan hingga 4 hari.\n- **Freezer**: Bertahan hingga 6 bulan.\n\n*Catatan*: Cairkan ASIP beku di kulkas bawah terlebih dahulu, lalu rendam di air hangat. Jangan gunakan microwave atau air mendidih.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 4,
                'published_date'   => now()->subDays(6),
                'image'            => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Centers for Disease Control and Prevention (CDC). (2022). Proper Storage and Preparation of Breast Milk.\n2. Akademi Kedokteran Menyusui (ABM). (2018). Clinical Protocol for Breastmilk Storage.",
            ],
            [
                'title'            => 'Teknik Menyusui yang Benar untuk Mencegah Puting Lecet',
                'category'         => 'ASI Eksklusif',
                'summary'          => 'Posisi dan pelekatan menyusui yang tepat menjamin aliran ASI lancar dan kenyamanan bagi ibu.',
                'content'          => "# Pelekatan Menyusui yang Tepat\n\nPelekatan yang salah adalah penyebab utama puting lecet dan ASI tidak keluar optimal.\n\nTanda pelekatan benar:\n1. Mulut bayi terbuka lebar.\n2. Sebagian besar areola (bagian hitam payudara) masuk ke mulut bayi.\n3. Dagu bayi menempel pada payudara.\n4. Bibir bawah bayi melipat ke luar.\n5. Tidak terasa nyeri saat menyusu.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(12),
                'image'            => 'https://images.unsplash.com/photo-1596464716127-f2a82984de30?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. La Leche League International. (2020). Positioning and Latch-on.\n2. Kementerian Kesehatan RI. (2020). Buku Saku Pemantauan Status Gizi Balita.",
            ],

            // ==================== 3. MPASI (3) ====================
            [
                'title'            => 'Panduan Lengkap MPASI Bergizi untuk Usia 6 Sampai 24 Bulan',
                'category'         => 'MPASI',
                'summary'          => 'Transisi makan yang tepat setelah lulus ASI eksklusif untuk menghindari risiko stunting.',
                'content'          => "# Memulai MPASI pada Usia 6 Bulan\n\nSetelah usia 6 bulan, kebutuhan energi dan zat besi bayi tidak lagi tercukupi hanya dari ASI. Karenanya, pemberian MPASI yang padat gizi sangat krusial.\n\nPrinsip MPASI WHO:\n- **Tepat waktu**: Dimulai tepat usia 6 bulan.\n- **Adekual**: Memenuhi zat gizi makro dan mikro.\n- **Aman**: Disiapkan dan disajikan secara higienis.\n- **Responsif**: Memperhatikan tanda lapar dan kenyang anak.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => false,
                'read_time'        => 6,
                'published_date'   => now()->subDays(3),
                'image'            => 'https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. WHO. (2018). Guidance on Infant and Young Child Feeding.\n2. IDAI. (2020). Panduan Praktis Pemberian Makanan Pendamping ASI.",
            ],
            [
                'title'            => 'Strategi Mengatasi Anak yang Pilih-Pilih Makanan atau Picky Eater',
                'category'         => 'MPASI',
                'summary'          => 'Tips bagi orang tua menghadapi fase anak menolak makan tanpa harus memicu stres di meja makan.',
                'content'          => "# Menghadapi Picky Eater\n\nFase pilih-pilih makanan umum terjadi pada usia 1-3 tahun karena anak mulai menunjukkan kemandirian.\n\nTips praktis:\n1. Buat jadwal makan yang teratur (makan besar & camilan).\n2. Batasi pemberian susu atau air putih menjelang waktu makan.\n3. Jangan memaksa anak menghabiskan makanan.\n4. Sajikan makanan dalam porsi kecil namun menarik secara visual.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(8),
                'image'            => 'https://images.unsplash.com/photo-1584269600464-37b1b58a9fe7?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. American Academy of Pediatrics. (2020). Picky Eating: How to Cope.\n2. IDAI. (2019). Kesulitan Makan pada Anak: Diagnosis dan Tata Laksana.",
            ],
            [
                'title'            => 'Keamanan dan Higienitas dalam Mempersiapkan MPASI Harian',
                'category'         => 'MPASI',
                'summary'          => 'Pentingnya kebersihan alat dan bahan makanan untuk mencegah infeksi bakteri penyebab diare pada balita.',
                'content'          => "# Sanitasi MPASI\n\nPenyakit infeksi seperti diare dapat langsung menurunkan berat badan balita secara drastis. Diare berulang sangat erat kaitannya dengan risiko stunting.\n\nAturan kebersihan:\n- Selalu cuci tangan sebelum memasak dan menyuapi anak.\n- Pisahkan talenan untuk bahan mentah (daging) dan bahan matang/sayuran.\n- Masak daging dan telur hingga benar-benar matang.\n- Sajikan makanan maksimal 2 jam setelah dimasak pada suhu ruang.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 4,
                'published_date'   => now()->subDays(15),
                'image'            => 'https://images.unsplash.com/photo-1584269600519-112d0b1b355b?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. BPOM RI. (2021). Pedoman Keamanan Pangan untuk Pembuatan MPASI.\n2. WHO. (2020). Five Keys to Safer Food.",
            ],

            // ==================== 4. Pencegahan Stunting (3) ====================
            [
                'title'            => '1000 Hari Pertama Kehidupan: Periode Emas Cegah Stunting',
                'category'         => 'Pencegahan Stunting',
                'summary'          => 'Fase krusial sejak janin dalam kandungan hingga anak berusia 2 tahun yang menentukan kesehatan masa depannya.',
                'content'          => "# Periode Emas 1000 HPK\n\nStunting paling efektif dicegah pada periode 1000 Hari Pertama Kehidupan (HPK). Periode ini dimulai sejak masa kehamilan (270 hari) hingga anak berusia 2 tahun (730 hari).\n\nMengapa sangat penting?\n- **Perkembangan Otak**: 80% perkembangan otak terjadi di fase ini.\n- **Sistem Imun**: Pembentukan sistem kekebalan tubuh jangka panjang.\n- **Reversibilitas**: Setelah usia 2 tahun, dampak buruk stunting sangat sulit diperbaiki.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => true,
                'read_time'        => 6,
                'published_date'   => now()->subDays(4),
                'image'            => 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Bappenas. (2021). Strategi Nasional Percepatan Pencegahan Stunting.\n2. Lancet Maternal and Child Nutrition Series. (2013-2020).",
            ],
            [
                'title'            => 'Hubungan Antara Akses Air Bersih dan Sanitasi dengan Stunting',
                'category'         => 'Pencegahan Stunting',
                'summary'          => 'Faktor sensitif lingkungan yang sering terabaikan namun memiliki andil besar dalam pertumbuhan balita.',
                'content'          => "# Sanitasi Layak untuk Tumbuh Kembang\n\nLingkungan yang kotor menyebabkan anak sering terkena penyakit infeksi seperti diare dan cacingan. Energi yang harusnya dipakai untuk tumbuh akhirnya habis digunakan tubuh untuk melawan penyakit.\n\nLangkah intervensi:\n1. Pastikan akses air bersih untuk minum dan memasak.\n2. Stop buang air besar sembarangan (ODF).\n3. Budayakan cuci tangan pakai sabun (CTPS) sebelum makan dan setelah dari toilet.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(9),
                'image'            => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. UNICEF. (2020). Water, Sanitation, and Hygiene (WASH) Linkages to Stunting.\n2. Jurnal Kesehatan Masyarakat Indonesia. (2019). Analisis Dampak Sanitasi Terhadap Kejadian Stunting Balita.",
            ],
            [
                'title'            => 'Peran Imunisasi Dasar Lengkap dalam Ekosistem Pencegahan Stunting',
                'category'         => 'Pencegahan Stunting',
                'summary'          => 'Melindungi balita dari penyakit infeksi menular yang dapat menurunkan status gizi anak secara drastis.',
                'content'          => "# Imunisasi untuk Cegah Stunting\n\nImunisasi melatih tubuh anak mengenali dan melawan bakteri/virus berbahaya. Anak yang diimunisasi lengkap memiliki risiko lebih kecil mengalami sakit berat.\n\nPenyakit yang dapat dicegah:\n- TBC Paru (BCG)\n- Campak & Rubella (MR)\n- Diare berat akibat Rotavirus\n- Pneumonia (PCV)\n- Polio, Difteri, Pertusis, dan Tetanus.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(14),
                'image'            => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Kementerian Kesehatan RI. (2021). Buku Pedoman Penyelenggaraan Imunisasi.\n2. WHO. (2019). Immunization in Practice: A Practical Guide.",
            ],

            // ==================== 5. Kesehatan Ibu (3) ====================
            [
                'title'            => 'Gizi Seimbang Ibu Hamil Guna Mencegah Bayi Lahir Stunting',
                'category'         => 'Kesehatan Ibu',
                'summary'          => 'Pencegahan stunting dimulai sejak masa kehamilan dengan menjaga asupan nutrisi makro dan mikro ibu.',
                'content'          => "# Nutrisi Masa Kehamilan\n\nKondisi gizi ibu hamil menentukan berat dan panjang badan bayi saat lahir. Ibu hamil dengan KEK (Kekurangan Energi Kronis) berisiko melahirkan bayi BBLR (Berat Badan Lahir Rendah).\n\nAsupan penting bagi ibu hamil:\n- **Tablet Tambah Darah (TTD)**: Minimal 90 tablet selama hamil untuk cegah anemia.\n- **Asam Folat**: Mencegah kecacatan tabung saraf bayi.\n- **Protein Hewani**: Ditingkatkan porsinya dibanding sebelum hamil.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => true,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(3),
                'image'            => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. WHO. (2016). WHO Recommendations on Antenatal Care for a Positive Pregnancy Experience.\n2. IDAI. (2021). Pentingnya Pencegahan Anemia untuk Mencegah Generasi Stunting.",
            ],
            [
                'title'            => 'Mencegah Anemia pada Ibu Hamil dengan Tablet Tambah Darah',
                'category'         => 'Kesehatan Ibu',
                'summary'          => 'Anemia selama kehamilan meningkatkan risiko kelahiran prematur dan stunting pada anak kelak.',
                'content'          => "# Bahaya Anemia pada Kehamilan\n\nAnemia terjadi ketika tubuh kekurangan sel darah merah yang membawa oksigen ke janin. Akibatnya, pertumbuhan janin di dalam rahim menjadi terhambat.\n\nLangkah praktis pencegahan:\n1. Konsumsi satu Tablet Tambah Darah (TTD) setiap hari.\n2. Makan makanan tinggi zat besi seperti hati ayam, daging merah, dan bayam.\n3. Hindari minum teh atau kopi bersamaan dengan makan karena dapat menghambat penyerapan zat besi.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 4,
                'published_date'   => now()->subDays(11),
                'image'            => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. Depkes RI. (2020). Program Pencegahan dan Penanggulangan Anemia pada Ibu Hamil.\n2. UNICEF. (2022). Prevention of Nutritional Anemia in Pregnant Women.",
            ],
            [
                'title'            => 'Kesehatan Mental Ibu Menyusui Memengaruhi Produksi ASI',
                'category'         => 'Kesehatan Ibu',
                'summary'          => 'Stres dan kecemasan dapat menghambat hormon oksitosin yang berperan penting dalam aliran air susu ibu.',
                'content'          => "# Kesehatan Mental & Refleks Oksitosin\n\nProduksi ASI dipengaruhi oleh dua hormon utama: Prolaktin (membuat ASI) dan Oksitosin (mengalirkan ASI). Hormon oksitosin sangat dipengaruhi oleh suasana hati ibu.\n\nTips menjaga ketenangan ibu:\n- Dukungan suami dan keluarga dalam mengurus rumah tangga dan bayi.\n- Istirahat yang cukup di sela-sela waktu tidur bayi.\n- Cari komunitas pendukung menyusui untuk bertukar informasi.",
                'status'           => 'published',
                'is_published'     => true,
                'show_on_homepage' => false,
                'is_featured'      => false,
                'read_time'        => 5,
                'published_date'   => now()->subDays(16),
                'image'            => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=600&auto=format&fit=crop',
                'references'       => "1. World Journal of Clinical Pediatrics. (2018). Maternal Stress and Its Impact on Lactation.\n2. IDAI. (2021). Peran Suami dalam Keberhasilan Ibu Menyusui (Fathering).",
            ],
        ];

        foreach ($articlesData as $index => $a) {
            // Tentukan penulis per kelompok 5 artikel
            if ($index < 5) {
                $authorName = 'Tim Kesehatan Gizi Aisyiyah';
            } elseif ($index < 10) {
                $authorName = 'Bidan Desa Aisyiyah Kaltim';
            } else {
                $authorName = 'Kader Penggerak SiCegah';
            }

            // Tentukan status per kelompok 5 artikel
            if ($index < 5) {
                $status = 'published';
            } elseif ($index < 10) {
                $status = 'draft';
            } else {
                $status = 'scheduled';
            }

            // Hapus is_published dari array asal agar tidak bentrok dengan skema DB
            unset($a['is_published']);

            Article::create(array_merge($a, [
                'author_name'  => $authorName,
                'status'       => $status,
                'slug'         => Str::slug($a['title']),
                'user_id'      => $admin?->id,
            ]));
        }
    }
}