-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2026 at 10:15 AM
-- Server version: 10.11.19-MariaDB-cll-lve
-- PHP Version: 8.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `must1341_stuntingcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `published_date` date DEFAULT NULL,
  `read_time` int(11) NOT NULL DEFAULT 3,
  `summary` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `references` text DEFAULT NULL,
  `status` enum('published','draft','scheduled') NOT NULL DEFAULT 'draft',
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `author_name`, `published_date`, `read_time`, `summary`, `content`, `image`, `references`, `status`, `show_on_homepage`, `is_featured`, `meta_title`, `meta_description`, `views`, `user_id`, `created_at`, `updated_at`) VALUES
('019f5446-5442-72f8-b624-66804e30b63f', 'Protein Hewani Harian untuk Pertumbuhan Optimal Anak', 'protein-hewani-harian-untuk-pertumbuhan-optimal-anak', 'Gizi Anak', 'Tim Kesehatan Gizi Aisyiyah', '2026-07-10', 5, 'Pentingnya konsumsi protein hewani setiap hari untuk mendukung tumbuh kembang anak dan pencegahan stunting.', '# Protein Hewani untuk Anak\n\nProtein hewani sangat penting karena mengandung asam amino esensial lengkap yang dibutuhkan untuk pembentukan jaringan tubuh dan mendukung pertumbuhan tinggi badan anak.\n\nBeberapa sumber protein hewani terbaik:\n- **Telur**: Sumber protein murah dan lengkap.\n- **Ikan**: Terutama ikan lokal seperti kembung yang kaya Omega-3.\n- **Daging ayam dan sapi**: Kaya zat besi untuk mencegah anemia.\n- **Susu dan produk olahannya**: Sumber kalsium yang baik.', 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=600&auto=format&fit=crop', '1. Kementerian Kesehatan RI. (2022). Profil Kesehatan Indonesia Tahun 2021.\n2. WHO. (2020). Nutrition and food safety: Infant and young child feeding.', 'published', 1, 1, NULL, NULL, 63, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-09-21 06:36:34'),
('019f5446-5443-7266-a2b4-9826e58970d3', 'Kebutuhan Vitamin D dan Kalsium untuk Pertumbuhan Tulang Anak', 'kebutuhan-vitamin-d-dan-kalsium-untuk-pertumbuhan-tulang-anak', 'Gizi Anak', 'Tim Kesehatan Gizi Aisyiyah', '2026-07-07', 4, 'Vitamin D dan kalsium bekerja bersama secara sinergis untuk membangun tulang yang kuat pada masa pertumbuhan balita.', '# Sinergi Kalsium dan Vitamin D\n\nKalsium adalah mineral utama pembentuk tulang, sementara Vitamin D membantu penyerapannya di dalam tubuh. Kekurangan salah satunya dapat memicu gangguan pertumbuhan tinggi badan.\n\nTips pemenuhan:\n1. Ajak anak beraktivitas di bawah sinar matahari pagi (10-15 menit).\n2. Berikan makanan kaya kalsium seperti teri, tempe, dan sayuran hijau.\n3. Pertimbangkan konsumsi susu pertumbuhan jika asupan harian kurang.', 'https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?q=80&w=600&auto=format&fit=crop', '1. IDAI. (2018). Rekomendasi Suplementasi Vitamin D pada Anak.\n2. British Nutrition Foundation. (2021). Calcium and Vitamin D in Children\'s Diets.', 'published', 0, 0, NULL, NULL, 99, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-09-23 14:34:35'),
('019f5446-5444-71b2-8d79-9703bba39c12', 'Pentingnya Memantau Berat Badan Balita Setiap Bulan di Posyandu', 'pentingnya-memantau-berat-badan-balita-setiap-bulan-di-posyandu', 'Gizi Anak', 'Tim Kesehatan Gizi Aisyiyah', '2026-07-02', 4, 'Kenaikan berat badan yang tidak adekuat (faltering) adalah tanda awal sebelum terjadinya stunting.', '# Deteksi Dini via Posyandu\n\nStunting tidak terjadi secara tiba-tiba. Biasanya diawali dengan berat badan anak yang sulit naik atau grafiknya mendatar pada KMS (Kartu Menuju Sehat).\n\nLangkah pencegahan:\n- Timbang berat badan dan ukur tinggi badan balita rutin setiap bulan.\n- Konsultasikan ke petugas kesehatan jika berat badan tidak naik 2 kali berturut-turut.\n- Lakukan evaluasi asupan makan harian anak.', 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop', '1. Depkes RI. (2019). Buku KIA (Kesehatan Ibu dan Anak).\n2. UNICEF. (2021). Child Malnutrition in Indonesia: A Policy Brief.', 'published', 1, 0, NULL, NULL, 71, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-09-23 14:34:36'),
('019f5446-5444-71b2-8d79-9703bbfd20b6', 'ASI Eksklusif: Investasi Terbaik untuk Masa Depan Anak', 'asi-eksklusif-investasi-terbaik-untuk-masa-depan-anak', 'ASI Eksklusif', 'Tim Kesehatan Gizi Aisyiyah', '2026-07-11', 5, 'Pemberian ASI eksklusif selama 6 bulan pertama memberikan perlindungan optimal bagi bayi dari berbagai infeksi.', '# Keajaiban ASI Eksklusif\n\nASI eksklusif artinya hanya memberikan ASI saja tanpa makanan atau minuman lain termasuk air putih selama 6 bulan pertama kehidupan.\n\nManfaat utama:\n- Mengandung antibodi alami untuk kekebalan tubuh bayi.\n- Komposisi nutrisi yang dinamis dan menyesuaikan kebutuhan usia bayi.\n- Mempererat ikatan psikologis (bonding) antara ibu dan anak.', 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=600&auto=format&fit=crop', '1. WHO & UNICEF. (2021). Global breastfeeding scorecard.\n2. IDAI. (2020). Nilai Nutrisi ASI dan Praktik Menyusui Terkini.', 'draft', 1, 1, NULL, NULL, 20, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-22 20:35:07'),
('019f5446-5445-73e9-8f63-7a38f7a593af', 'Cara Menyimpan ASI Perah agar Nutrisinya Tetap Terjaga', 'cara-menyimpan-asi-perah-agar-nutrisinya-tetap-terjaga', 'ASI Eksklusif', 'Tim Kesehatan Gizi Aisyiyah', '2026-07-06', 4, 'Panduan bagi ibu pekerja untuk memerah, menyimpan, dan menyajikan ASI dengan cara yang benar.', '# Penyimpanan ASI Perah (ASIP)\n\nAgar nutrisi dalam ASIP tidak rusak, perhatikan aturan penyimpanan berikut:\n- **Suhu Ruang**: Bertahan hingga 4 jam.\n- **Cooler Bag**: Bertahan hingga 24 jam.\n- **Kulkas Bawah**: Bertahan hingga 4 hari.\n- **Freezer**: Bertahan hingga 6 bulan.\n\n*Catatan*: Cairkan ASIP beku di kulkas bawah terlebih dahulu, lalu rendam di air hangat. Jangan gunakan microwave atau air mendidih.', 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?q=80&w=600&auto=format&fit=crop', '1. Centers for Disease Control and Prevention (CDC). (2022). Proper Storage and Preparation of Breast Milk.\n2. Akademi Kedokteran Menyusui (ABM). (2018). Clinical Protocol for Breastmilk Storage.', 'published', 0, 0, NULL, NULL, 69, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-09-16 09:03:58'),
('019f5446-5446-71f0-9ae1-05d5d3125f95', 'Teknik Menyusui yang Benar untuk Mencegah Puting Lecet', 'teknik-menyusui-yang-benar-untuk-mencegah-puting-lecet', 'ASI Eksklusif', 'Bidan Desa Aisyiyah Kaltim', '2026-06-30', 5, 'Posisi dan pelekatan menyusui yang tepat menjamin aliran ASI lancar dan kenyamanan bagi ibu.', '# Pelekatan Menyusui yang Tepat\n\nPelekatan yang salah adalah penyebab utama puting lecet dan ASI tidak keluar optimal.\n\nTanda pelekatan benar:\n1. Mulut bayi terbuka lebar.\n2. Sebagian besar areola (bagian hitam payudara) masuk ke mulut bayi.\n3. Dagu bayi menempel pada payudara.\n4. Bibir bawah bayi melipat ke luar.\n5. Tidak terasa nyeri saat menyusu.', 'https://images.unsplash.com/photo-1596464716127-f2a82984de30?q=80&w=600&auto=format&fit=crop', '1. La Leche League International. (2020). Positioning and Latch-on.\n2. Kementerian Kesehatan RI. (2020). Buku Saku Pemantauan Status Gizi Balita.', 'draft', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5446-71f0-9ae1-05d5d3e7fbe2', 'Panduan Lengkap MPASI Bergizi untuk Usia 6 Sampai 24 Bulan', 'panduan-lengkap-mpasi-bergizi-untuk-usia-6-sampai-24-bulan', 'MPASI', 'Bidan Desa Aisyiyah Kaltim', '2026-07-09', 6, 'Transisi makan yang tepat setelah lulus ASI eksklusif untuk menghindari risiko stunting.', '# Memulai MPASI pada Usia 6 Bulan\n\nSetelah usia 6 bulan, kebutuhan energi dan zat besi bayi tidak lagi tercukupi hanya dari ASI. Karenanya, pemberian MPASI yang padat gizi sangat krusial.\n\nPrinsip MPASI WHO:\n- **Tepat waktu**: Dimulai tepat usia 6 bulan.\n- **Adekual**: Memenuhi zat gizi makro dan mikro.\n- **Aman**: Disiapkan dan disajikan secara higienis.\n- **Responsif**: Memperhatikan tanda lapar dan kenyang anak.', 'https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=600&auto=format&fit=crop', '1. WHO. (2018). Guidance on Infant and Young Child Feeding.\n2. IDAI. (2020). Panduan Praktis Pemberian Makanan Pendamping ASI.', 'draft', 1, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5447-70ef-9674-d3354c6546df', 'Strategi Mengatasi Anak yang Pilih-Pilih Makanan atau Picky Eater', 'strategi-mengatasi-anak-yang-pilih-pilih-makanan-atau-picky-eater', 'MPASI', 'Bidan Desa Aisyiyah Kaltim', '2026-07-04', 5, 'Tips bagi orang tua menghadapi fase anak menolak makan tanpa harus memicu stres di meja makan.', '# Menghadapi Picky Eater\n\nFase pilih-pilih makanan umum terjadi pada usia 1-3 tahun karena anak mulai menunjukkan kemandirian.\n\nTips praktis:\n1. Buat jadwal makan yang teratur (makan besar & camilan).\n2. Batasi pemberian susu atau air putih menjelang waktu makan.\n3. Jangan memaksa anak menghabiskan makanan.\n4. Sajikan makanan dalam porsi kecil namun menarik secara visual.', 'https://images.unsplash.com/photo-1584269600464-37b1b58a9fe7?q=80&w=600&auto=format&fit=crop', '1. American Academy of Pediatrics. (2020). Picky Eating: How to Cope.\n2. IDAI. (2019). Kesulitan Makan pada Anak: Diagnosis dan Tata Laksana.', 'draft', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5448-7014-b94c-2afa06a74998', 'Keamanan dan Higienitas dalam Mempersiapkan MPASI Harian', 'keamanan-dan-higienitas-dalam-mempersiapkan-mpasi-harian', 'MPASI', 'Bidan Desa Aisyiyah Kaltim', '2026-06-27', 4, 'Pentingnya kebersihan alat dan bahan makanan untuk mencegah infeksi bakteri penyebab diare pada balita.', '# Sanitasi MPASI\n\nPenyakit infeksi seperti diare dapat langsung menurunkan berat badan balita secara drastis. Diare berulang sangat erat kaitannya dengan risiko stunting.\n\nAturan kebersihan:\n- Selalu cuci tangan sebelum memasak dan menyuapi anak.\n- Pisahkan talenan untuk bahan mentah (daging) dan bahan matang/sayuran.\n- Masak daging dan telur hingga benar-benar matang.\n- Sajikan makanan maksimal 2 jam setelah dimasak pada suhu ruang.', 'https://images.unsplash.com/photo-1584269600519-112d0b1b355b?q=80&w=600&auto=format&fit=crop', '1. BPOM RI. (2021). Pedoman Keamanan Pangan untuk Pembuatan MPASI.\n2. WHO. (2020). Five Keys to Safer Food.', 'draft', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5448-7014-b94c-2afa0749bf9d', '1000 Hari Pertama Kehidupan: Periode Emas Cegah Stunting', '1000-hari-pertama-kehidupan-periode-emas-cegah-stunting', 'Pencegahan Stunting', 'Bidan Desa Aisyiyah Kaltim', '2026-07-08', 6, 'Fase krusial sejak janin dalam kandungan hingga anak berusia 2 tahun yang menentukan kesehatan masa depannya.', '# Periode Emas 1000 HPK\n\nStunting paling efektif dicegah pada periode 1000 Hari Pertama Kehidupan (HPK). Periode ini dimulai sejak masa kehamilan (270 hari) hingga anak berusia 2 tahun (730 hari).\n\nMengapa sangat penting?\n- **Perkembangan Otak**: 80% perkembangan otak terjadi di fase ini.\n- **Sistem Imun**: Pembentukan sistem kekebalan tubuh jangka panjang.\n- **Reversibilitas**: Setelah usia 2 tahun, dampak buruk stunting sangat sulit diperbaiki.', 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?q=80&w=600&auto=format&fit=crop', '1. Bappenas. (2021). Strategi Nasional Percepatan Pencegahan Stunting.\n2. Lancet Maternal and Child Nutrition Series. (2013-2020).', 'draft', 1, 1, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5449-71b7-be61-cd1f2c91d77c', 'Hubungan Antara Akses Air Bersih dan Sanitasi dengan Stunting', 'hubungan-antara-akses-air-bersih-dan-sanitasi-dengan-stunting', 'Pencegahan Stunting', 'Kader Penggerak SiCegah', '2026-07-03', 5, 'Faktor sensitif lingkungan yang sering terabaikan namun memiliki andil besar dalam pertumbuhan balita.', '# Sanitasi Layak untuk Tumbuh Kembang\n\nLingkungan yang kotor menyebabkan anak sering terkena penyakit infeksi seperti diare dan cacingan. Energi yang harusnya dipakai untuk tumbuh akhirnya habis digunakan tubuh untuk melawan penyakit.\n\nLangkah intervensi:\n1. Pastikan akses air bersih untuk minum dan memasak.\n2. Stop buang air besar sembarangan (ODF).\n3. Budayakan cuci tangan pakai sabun (CTPS) sebelum makan dan setelah dari toilet.', 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=600&auto=format&fit=crop', '1. UNICEF. (2020). Water, Sanitation, and Hygiene (WASH) Linkages to Stunting.\n2. Jurnal Kesehatan Masyarakat Indonesia. (2019). Analisis Dampak Sanitasi Terhadap Kejadian Stunting Balita.', 'scheduled', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5449-71b7-be61-cd1f2ce5a410', 'Peran Imunisasi Dasar Lengkap dalam Ekosistem Pencegahan Stunting', 'peran-imunisasi-dasar-lengkap-dalam-ekosistem-pencegahan-stunting', 'Pencegahan Stunting', 'Kader Penggerak SiCegah', '2026-06-28', 5, 'Melindungi balita dari penyakit infeksi menular yang dapat menurunkan status gizi anak secara drastis.', '# Imunisasi untuk Cegah Stunting\n\nImunisasi melatih tubuh anak mengenali dan melawan bakteri/virus berbahaya. Anak yang diimunisasi lengkap memiliki risiko lebih kecil mengalami sakit berat.\n\nPenyakit yang dapat dicegah:\n- TBC Paru (BCG)\n- Campak & Rubella (MR)\n- Diare berat akibat Rotavirus\n- Pneumonia (PCV)\n- Polio, Difteri, Pertusis, dan Tetanus.', 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?q=80&w=600&auto=format&fit=crop', '1. Kementerian Kesehatan RI. (2021). Buku Pedoman Penyelenggaraan Imunisasi.\n2. WHO. (2019). Immunization in Practice: A Practical Guide.', 'scheduled', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-544a-715d-9054-ac4876644f46', 'Gizi Seimbang Ibu Hamil Guna Mencegah Bayi Lahir Stunting', 'gizi-seimbang-ibu-hamil-guna-mencegah-bayi-lahir-stunting', 'Kesehatan Ibu', 'Kader Penggerak SiCegah', '2026-07-09', 5, 'Pencegahan stunting dimulai sejak masa kehamilan dengan menjaga asupan nutrisi makro dan mikro ibu.', '# Nutrisi Masa Kehamilan\n\nKondisi gizi ibu hamil menentukan berat dan panjang badan bayi saat lahir. Ibu hamil dengan KEK (Kekurangan Energi Kronis) berisiko melahirkan bayi BBLR (Berat Badan Lahir Rendah).\n\nAsupan penting bagi ibu hamil:\n- **Tablet Tambah Darah (TTD)**: Minimal 90 tablet selama hamil untuk cegah anemia.\n- **Asam Folat**: Mencegah kecacatan tabung saraf bayi.\n- **Protein Hewani**: Ditingkatkan porsinya dibanding sebelum hamil.', 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop', '1. WHO. (2016). WHO Recommendations on Antenatal Care for a Positive Pregnancy Experience.\n2. IDAI. (2021). Pentingnya Pencegahan Anemia untuk Mencegah Generasi Stunting.', 'scheduled', 1, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-544b-71fd-8718-1d313be222b6', 'Mencegah Anemia pada Ibu Hamil dengan Tablet Tambah Darah', 'mencegah-anemia-pada-ibu-hamil-dengan-tablet-tambah-darah', 'Kesehatan Ibu', 'Kader Penggerak SiCegah', '2026-07-01', 4, 'Anemia selama kehamilan meningkatkan risiko kelahiran prematur dan stunting pada anak kelak.', '# Bahaya Anemia pada Kehamilan\n\nAnemia terjadi ketika tubuh kekurangan sel darah merah yang membawa oksigen ke janin. Akibatnya, pertumbuhan janin di dalam rahim menjadi terhambat.\n\nLangkah praktis pencegahan:\n1. Konsumsi satu Tablet Tambah Darah (TTD) setiap hari.\n2. Makan makanan tinggi zat besi seperti hati ayam, daging merah, dan bayam.\n3. Hindari minum teh atau kopi bersamaan dengan makan karena dapat menghambat penyerapan zat besi.', 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop', '1. Depkes RI. (2020). Program Pencegahan dan Penanggulangan Anemia pada Ibu Hamil.\n2. UNICEF. (2022). Prevention of Nutritional Anemia in Pregnant Women.', 'scheduled', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-544b-71fd-8718-1d313c404b64', 'Kesehatan Mental Ibu Menyusui Memengaruhi Produksi ASI', 'kesehatan-mental-ibu-menyusui-memengaruhi-produksi-asi', 'Kesehatan Ibu', 'Kader Penggerak SiCegah', '2026-06-26', 5, 'Stres dan kecemasan dapat menghambat hormon oksitosin yang berperan penting dalam aliran air susu ibu.', '# Kesehatan Mental & Refleks Oksitosin\n\nProduksi ASI dipengaruhi oleh dua hormon utama: Prolaktin (membuat ASI) dan Oksitosin (mengalirkan ASI). Hormon oksitosin sangat dipengaruhi oleh suasana hati ibu.\n\nTips menjaga ketenangan ibu:\n- Dukungan suami dan keluarga dalam mengurus rumah tangga dan bayi.\n- Istirahat yang cukup di sela-sela waktu tidur bayi.\n- Cari komunitas pendukung menyusui untuk bertukar informasi.', 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=600&auto=format&fit=crop', '1. World Journal of Clinical Pediatrics. (2018). Maternal Stress and Its Impact on Lactation.\n2. IDAI. (2021). Peran Suami dalam Keberhasilan Ibu Menyusui (Fathering).', 'scheduled', 0, 0, NULL, NULL, 0, '019f5446-4395-7311-bccc-5e920263b11b', '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('01a02288-b812-71bc-809a-4103f2d711c5', 'Edukasi Gizi Anak & Pencegahan Stunting dalam Perspektif Islam', 'edukasi-gizi-anak-pencegahan-stunting-dalam-perspektif-islam', 'Gizi Anak', 'Muhammad Fauzan Nur Ilham S.Kom', '2026-08-19', 15, 'Pencegahan stunting dan pemenuhan gizi anak merupakan bentuk tanggung jawab moral, medis, dan agama yang perlu diwujudkan melalui pemenuhan asupan nutrisi halal dan thayyib, terutama dengan konsumsi protein hewani harian, kalsium, dan vitamin D untuk mendukung pertumbuhan fisik serta tulang yang optimal. Selain itu, hak ASI dan pengelolaannya perlu dijaga dengan memastikan keutuhan gizi ASI perah sebagai bentuk pengamalan perintah Al-Qur\'an dalam QS. Al-Baqarah: 233. Upaya tersebut juga perlu disertai deteksi dini stunting melalui pemantauan berat badan secara rutin setiap bulan di Posyandu untuk mencegah weight faltering dan menghindari terbentuknya generasi yang lemah sebagaimana diingatkan dalam QS. An-Nisa\': 9.', '## 1. Protein Hewani Harian untuk Pertumbuhan Optimal Anak\r\n* **Tinjauan Gizi:** \r\n  Konsumsi protein hewani (seperti telur, ikan, ayam, daging, dan susu) setiap hari sangat krusial untuk mendukung pertumbuhan fisik, perkembangan otak, serta mencegah terjadinya *stunting* pada anak.\r\n* **Kaitan Keislaman:**\r\n  * **Prinsip *Halalan Thayyiban*:** Allah SWT berfirman:\r\n    > *\"Dan makanlah makanan yang halal lagi baik (thayyib) dari apa yang Allah telah rezekikan kepadamu...\"* (QS. Al-Ma\'idah: 88)\r\n  * Makanan yang *thayyib* berarti tidak hanya halal secara hukum, tetapi juga bermutu tinggi, bersih, dan memberikan manfaat gizi yang optimal bagi tubuh anak.\r\n  * Memberi asupan protein hewani yang baik merupakan bentuk amanah orang tua dalam menjaga fitrah fisik dan kesehatan anak.\r\n\r\n---\r\n\r\n## 2. Kebutuhan Vitamin D dan Kalsium untuk Pertumbuhan Tulang Anak\r\n* **Tinjauan Gizi:** \r\n  Vitamin D dan kalsium bekerja secara sinergis untuk membangun kepadatan tulang dan gigi yang kuat selama masa pertumbuhan balita.\r\n* **Kaitan Keislaman:**\r\n  * **Pemanfaatan Sunnatullah (Sinar Matahari & Rezeki Alam):** Sinar matahari pagi sebagai sumber alami Vitamin D serta pangan kaya kalsium merupakan fasilitas rezeki dari Allah untuk dimanfaatkan secara bijak.\r\n  * **Tanggung Jawab Menjaga Fisik yang Kuat:** Rasulullah SAW bersabda:\r\n    > *\"Mukmin yang kuat lebih baik dan lebih dicintai Allah daripada mukmin yang lemah.\"* (HR. Muslim)\r\n  * Menjaga kekuatan struktur tulang anak sejak dini adalah bagian dari ikhtiar mencetak generasi muslim yang kuat secara fisik dan mental.\r\n\r\n---\r\n\r\n## 3. Cara Menyimpan ASI Perah agar Nutrisinya Tetap Terjaga\r\n* **Tinjauan Gizi:** \r\n  Panduan praktis bagi ibu bekerja untuk memerah, menyimpan, dan menyajikan ASI dengan standar kebersihan yang benar agar kandungan gizi dan zat kekebalan tubuh di dalamnya tidak rusak.\r\n* **Kaitan Keislaman:**\r\n  * **Anjuran Pemberian ASI dalam Al-Qur\'an:**\r\n    > *\"Para ibu hendaklah menyusui anak-anaknya selama dua tahun penuh, yaitu bagi yang ingin menyempurnakan penyusuan...\"* (QS. Al-Baqarah: 233)\r\n  * Menyusui dan mengupayakan pengelolaan ASI Perah terbaik merupakan bentuk ibadah, kasih sayang, serta pemenuhan hak anak yang sangat dimuliakan dalam ajaran Islam.\r\n\r\n---\r\n\r\n## 4. Pentingnya Memantau Berat Badan Balita Setiap Bulan di Posyandu (Pencegahan Stunting)\r\n* **Tinjauan Gizi:** \r\n  Kenaikan berat badan yang tidak adekuat (*faltering growth*) merupakan tanda peringatan dini (*early warning sign*) sebelum anak masuk ke fase *stunting*. Pemantauan rutin di Posyandu sangat penting untuk intervensi awal.\r\n* **Kaitan Keislaman & Pencegahan Stunting:**\r\n  * **Larangan Meninggalkan Generasi yang Lemah:** Allah SWT mengingatkan dalam Al-Qur\'an:\r\n    > *\"Dan hendaklah takut kepada Allah orang-orang yang seandainya meninggalkan di belakang mereka anak-anak yang lemah, yang mereka khawatir terhadap (kesejahteraan) mereka...\"* (QS. An-Nisa\': 9)\r\n  * **Ikhtiar Memantau Tumbuh Kembang:** Menimbang dan memantau tumbuh kembang balita setiap bulan di Posyandu adalah bentuk tanggung jawab (*mas\'uliyyah*) orang tua untuk memastikan anak tidak mengalami kegagalan tumbuh (*stunting*).\r\n  * **Menjaga Amanah Titipan Allah:** Anak adalah amanah. Mencegah *stunting* melalui deteksi dini merupakan bagian dari menjaga amanah tersebut agar anak tumbuh menjadi generasi yang sehat, cerdas, dan tangguh.', 'articles/9a9a799d-a2eb-4a2e-8e52-32aeee281ddd.webp', '### 1. Referensi Al-Qur\'an & Hadis (Perspektif Keislaman)\r\n* **QS. Al-Baqarah (2): 233** — Perintah menyempurnakan penyusuan ASI hingga 2 tahun.\r\n* **QS. An-Nisa\' (4): 9** — Peringatan agar tidak meninggalkan generasi (keturunan) yang lemah.\r\n* **QS. Al-Ma\'idah (5): 88** — Anjuran mengonsumsi makanan yang *halalan thayyiban* (halal dan bergizi/baik).\r\n* **HR. Muslim No. 2664** — Hadis tentang keutamaan mukmin yang kuat dibandingkan mukmin yang lemah.\r\n\r\n### 2. Referensi Kesehatan & Medis (Perspektif Gizi)\r\n* **Kementerian Kesehatan RI.** *Pedoman Pencegahan dan Penanganan Stunting di Indonesia.* Jakarta: Kemenkes RI.\r\n* **Kementerian Kesehatan RI.** *Standar Pemantauan Pertumbuhan Balita di Posyandu & Buku KIA.* Jakarta: Kemenkes RI.\r\n* **Ikatan Dokter Anak Indonesia (IDAI).** *Praktik Pemberian Makan pada Bayi dan Anak (PMBA) untuk Mencegah Stunting.* IDAI.\r\n* **World Health Organization (WHO).** *Guidance on Infant and Young Child Feeding (IYCF) & Stunting Prevention.* Geneva: WHO.', 'published', 1, 1, 'Edukasi Gizi Anak & Pencegahan Stunting dalam Islam | Kemenag Samarinda', 'Temukan panduan lengkap gizi balita, konsumsi protein hewani, serta peran ASI dan Posyandu sesuai ajaran Islam untuk cegah stunting sejak dini.', 70, '019f5446-56c8-738d-af64-7f35662d28b1', '2026-08-20 21:16:20', '2026-09-23 14:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` char(36) NOT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `age_months` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `status_growth` varchar(255) NOT NULL,
  `risk_level` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `asi_eksklusif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `kader_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `child_name`, `gender`, `age_months`, `birth_date`, `height`, `weight`, `status_growth`, `risk_level`, `city`, `asi_eksklusif`, `kader_id`, `created_at`, `updated_at`) VALUES
('019f5446-545d-71cd-a9ce-696abc9b6a57', 'Anak Bulah', 'P', 9, '2025-10-01', 75.10, 8.20, 'Normal', 'normal', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5460-703b-acd0-929541838761', 'Anak Ezra', 'L', 11, '2025-08-01', 72.50, 6.40, 'Risiko', 'sedang', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5462-72d9-b386-59c468c097d6', 'Anak Daphney', 'P', 13, '2025-06-01', 78.20, 6.20, 'Normal', 'rendah', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5464-717f-b417-0caeeadb2175', 'Anak Akeem', 'L', 50, '2022-05-01', 96.90, 20.00, 'Risiko', 'sedang', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5467-7248-9b3a-4e71f9f79b59', 'Anak Larry', 'L', 40, '2023-03-01', 87.70, 13.10, 'Stunting', 'tinggi', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5469-7248-a80e-61444f5d22b2', 'Anak Valerie', 'P', 51, '2022-04-01', 114.00, 16.00, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-546c-7043-ab76-7db7a27ef589', 'Anak Neoma', 'P', 55, '2021-12-01', 116.50, 20.10, 'Normal', 'normal', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5470-70e1-8ba1-e7fe2ea50545', 'Anak Connie', 'P', 5, '2026-02-01', 61.00, 7.90, 'Normal', 'rendah', 'Kutai Barat', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5473-7055-867f-d85a97880fe4', 'Anak Maye', 'P', 24, '2024-07-01', 92.40, 9.50, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5476-7283-8d17-f4bfb16c5499', 'Anak Kaylah', 'P', 17, '2025-02-01', 66.70, 13.00, 'Stunting', 'tinggi', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5479-71e0-a64c-a78ac565101c', 'Anak Adrianna', 'P', 55, '2021-12-01', 109.50, 20.10, 'Normal', 'rendah', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-547c-7356-bc12-623933060dc6', 'Anak Opal', 'P', 31, '2023-12-01', 99.20, 16.10, 'Normal', 'normal', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-547e-7160-b249-0e9d39125cfc', 'Anak Edythe', 'P', 23, '2024-08-01', 82.50, 14.30, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5481-72c0-9676-bd6716308c6f', 'Anak Rossie', 'P', 41, '2023-02-01', 106.50, 19.40, 'Normal', 'normal', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5484-719b-b9a3-4f589cde589f', 'Anak Erna', 'P', 43, '2022-12-01', 97.90, 18.90, 'Normal', 'rendah', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5487-72b1-a0a0-835115995767', 'Anak Van', 'L', 35, '2023-08-01', 96.40, 12.20, 'Normal', 'rendah', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5489-7029-81e4-6c4f810be2d2', 'Anak Nayeli', 'P', 58, '2021-09-01', 118.30, 21.90, 'Normal', 'normal', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-548c-702d-948c-863420436766', 'Anak Jalon', 'L', 19, '2024-12-01', 88.20, 9.10, 'Normal', 'rendah', 'Kutai Kartanegara', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-548f-724f-a7a5-69b22977e45d', 'Anak Fae', 'P', 4, '2026-03-01', 66.10, 9.40, 'Normal', 'normal', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5492-70f1-a1e0-6306fc8705f3', 'Anak Kristian', 'L', 48, '2022-07-01', 103.80, 17.60, 'Normal', 'rendah', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5494-7109-a436-d40a61d211b1', 'Anak Sally', 'P', 49, '2022-06-01', 102.80, 20.50, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5497-72f3-9e25-8e639a13002d', 'Anak Walker', 'L', 44, '2022-11-01', 101.30, 18.90, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-549a-713d-900d-05de4cf59a49', 'Anak Luis', 'L', 28, '2024-03-01', 97.10, 15.90, 'Normal', 'normal', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-549d-729a-99cc-132a26d9f302', 'Anak Fabiola', 'P', 19, '2024-12-01', 76.70, 12.40, 'Risiko', 'sedang', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54a0-71d7-8916-03d09b9ad20b', 'Anak Lottie', 'P', 7, '2025-12-01', 62.30, 9.60, 'Risiko', 'sedang', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54a3-70f3-afac-9fcd95468169', 'Anak Kieran', 'L', 17, '2025-02-01', 75.20, 7.70, 'Stunting', 'tinggi', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54a5-7185-91dd-7c360e3fca07', 'Anak Preston', 'L', 28, '2024-03-01', 91.10, 10.90, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54a8-7335-bc5a-bd70a42d7a6f', 'Anak Isobel', 'P', 28, '2024-03-01', 96.80, 15.40, 'Normal', 'normal', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54aa-73ca-a2c5-a5645f99e8fa', 'Anak Maribel', 'P', 26, '2024-05-01', 82.20, 12.90, 'Risiko', 'sedang', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54ac-71d4-9871-3f4115203c0f', 'Anak Mercedes', 'P', 3, '2026-04-01', 61.80, 3.50, 'Risiko', 'sedang', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54af-7205-8267-0260f473d30d', 'Anak Delphine', 'P', 19, '2024-12-01', 88.70, 8.40, 'Normal', 'normal', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54b1-7030-9e96-322ab59ee4bd', 'Anak Elenor', 'P', 16, '2025-03-01', 65.60, 12.80, 'Stunting', 'tinggi', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54b4-7320-b21e-46807e22010a', 'Anak Jacquelyn', 'P', 15, '2025-04-01', 82.50, 6.60, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54b6-70fd-8d5b-382bdd0249ea', 'Anak Deron', 'L', 53, '2022-02-01', 102.70, 14.60, 'Risiko', 'sedang', 'Mahakam Ulu', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54b8-7324-aec8-e56ca7800db7', 'Anak Vince', 'L', 53, '2022-02-01', 102.70, 17.60, 'Normal', 'rendah', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54bb-735f-9b2e-14fb4576582b', 'Anak Lenna', 'P', 9, '2025-10-01', 56.10, 11.20, 'Stunting', 'tinggi', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54bd-724d-9be3-7e1a4b2e22c7', 'Anak Reuben', 'L', 16, '2025-03-01', 68.20, 13.50, 'Stunting', 'tinggi', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54bf-73ee-b0be-12e4d9acbdf2', 'Anak Domenick', 'L', 47, '2022-08-01', 92.20, 15.40, 'Stunting', 'tinggi', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54c2-7080-8b1f-103314d928f5', 'Anak Vance', 'L', 34, '2023-09-01', 95.60, 16.00, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54c4-71cf-a1f8-2bd86cba3c2e', 'Anak Wyatt', 'L', 7, '2025-12-01', 57.20, 12.30, 'Stunting', 'tinggi', 'Mahakam Ulu', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54c7-7194-9159-cfa49d3efa5f', 'Anak Libby', 'P', 54, '2022-01-01', 113.90, 19.80, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54c9-719a-92ef-33899bed2082', 'Anak Imani', 'L', 43, '2022-12-01', 108.70, 15.70, 'Normal', 'normal', 'Kutai Kartanegara', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54cc-70e7-bfdc-1b649d11009e', 'Anak Yadira', 'P', 46, '2022-09-01', 109.90, 14.70, 'Normal', 'rendah', 'Kutai Barat', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54d1-72eb-ab4e-8dc6807a9284', 'Anak Demarcus', 'L', 53, '2022-02-01', 99.70, 16.60, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54da-7341-a253-af39a9aa0134', 'Anak Finn', 'L', 25, '2024-06-01', 89.70, 16.40, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54de-71f2-9e15-902b6236be1e', 'Anak Shirley', 'P', 22, '2024-09-01', 76.60, 14.10, 'Risiko', 'sedang', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54e1-727f-b579-bdb6904103ed', 'Anak Jeffrey', 'L', 20, '2024-11-01', 88.20, 8.30, 'Normal', 'rendah', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54e3-7191-90c8-d227d805d4fe', 'Anak Lorna', 'P', 11, '2025-08-01', 73.80, 12.70, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54e7-721d-9998-d1ac59361c40', 'Anak Agnes', 'P', 34, '2023-09-01', 81.50, 12.80, 'Stunting', 'tinggi', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54ea-7169-a3c3-8f90fe4987ab', 'Anak Emily', 'P', 33, '2023-10-01', 96.80, 14.50, 'Normal', 'rendah', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54ec-725c-93f4-09ed7ba8a899', 'Anak Sanford', 'L', 19, '2024-12-01', 87.20, 9.10, 'Normal', 'rendah', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54ef-7255-8ab9-77c5149e0c8c', 'Anak Alanis', 'P', 43, '2022-12-01', 94.90, 18.90, 'Normal', 'rendah', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54f2-71e9-9788-d273d5dd802e', 'Anak Tomas', 'L', 44, '2022-11-01', 108.30, 12.90, 'Normal', 'rendah', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54f5-73c6-98ac-d00c89b24b68', 'Anak Neva', 'P', 44, '2022-11-01', 100.50, 15.20, 'Normal', 'rendah', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54f7-7244-aaef-3ee3f47b1761', 'Anak Anibal', 'L', 26, '2024-05-01', 91.50, 16.50, 'Normal', 'rendah', 'Berau', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54fa-737d-92f7-f228de418e60', 'Anak Tina', 'P', 20, '2024-11-01', 87.70, 12.70, 'Normal', 'normal', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-54fd-7029-91f4-b76747d7300b', 'Anak Marion', 'P', 53, '2022-02-01', 94.30, 19.60, 'Stunting', 'tinggi', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5500-7255-bc7a-4eee510da695', 'Anak Melissa', 'P', 37, '2023-06-01', 94.70, 18.50, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5502-735b-b87c-9df5d312857a', 'Anak Sonny', 'L', 14, '2025-05-01', 72.00, 10.10, 'Risiko', 'sedang', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5505-71c5-bada-0aa616ea7ea3', 'Anak Jevon', 'L', 25, '2024-06-01', 87.70, 10.40, 'Risiko', 'sedang', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5507-73dc-a95f-64688ae292e0', 'Anak Odell', 'L', 48, '2022-07-01', 111.80, 17.60, 'Normal', 'normal', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-550a-7058-ba3d-5a9aba6cf6ba', 'Anak Lamont', 'L', 11, '2025-08-01', 69.50, 13.40, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-550c-73f0-b456-6a1cca9eeb01', 'Anak Mina', 'P', 56, '2021-11-01', 110.10, 23.40, 'Normal', 'rendah', 'Kutai Timur', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-550e-72ee-95c8-a6e302ddd44a', 'Anak Makenna', 'L', 50, '2022-05-01', 97.90, 14.00, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5511-7332-8157-cd701c2ddd2d', 'Anak Craig', 'L', 11, '2025-08-01', 63.50, 13.40, 'Stunting', 'tinggi', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5513-71ef-9532-87d4d8127150', 'Anak Ava', 'P', 49, '2022-06-01', 94.80, 21.50, 'Risiko', 'sedang', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5515-70d7-b8d0-5e6919ba9d2c', 'Anak Vincent', 'L', 3, '2026-04-01', 51.40, 6.40, 'Stunting Berat', 'sangat_tinggi', 'Balikpapan', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5518-723f-925d-b04af9d9dc8e', 'Anak Anika', 'P', 26, '2024-05-01', 94.20, 10.90, 'Normal', 'rendah', 'Bontang', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-551a-7142-b2b1-f91f4e506913', 'Anak Yvette', 'P', 30, '2024-01-01', 87.50, 13.80, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-551c-7227-b8fe-e1cbc8c4d800', 'Anak Autumn', 'P', 44, '2022-11-01', 101.50, 19.20, 'Normal', 'rendah', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-551f-72c2-aab2-9a6b8653d446', 'Anak Griffin', 'L', 58, '2021-09-01', 109.50, 22.60, 'Normal', 'rendah', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5521-73ea-a925-cc535ce6ee47', 'Anak David', 'L', 40, '2023-03-01', 84.70, 15.10, 'Stunting', 'tinggi', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5523-7059-8eaf-11d8a6b1480d', 'Anak Earnest', 'L', 23, '2024-08-01', 90.90, 15.00, 'Normal', 'normal', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5526-71cf-9152-ea51228a6d13', 'Anak Susie', 'P', 12, '2025-07-01', 76.00, 6.90, 'Normal', 'rendah', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5528-72c4-8776-3940a633d70a', 'Anak Tina', 'P', 53, '2022-02-01', 104.30, 22.60, 'Normal', 'rendah', 'Kutai Barat', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-552a-730d-98d8-0c8c55d97933', 'Anak Guadalupe', 'P', 23, '2024-08-01', 86.50, 10.30, 'Normal', 'rendah', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-552d-73f6-ac69-81f12950ea4b', 'Anak Trinity', 'P', 3, '2026-04-01', 64.80, 8.80, 'Normal', 'normal', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-552f-71d4-a29a-a288f068d9dd', 'Anak Gonzalo', 'L', 19, '2024-12-01', 88.20, 15.10, 'Normal', 'normal', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5531-72dc-99df-f7cc79e0f58d', 'Anak Camren', 'L', 26, '2024-05-01', 92.50, 11.50, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5534-730c-94cc-97c32f1b4fee', 'Anak Dereck', 'L', 54, '2022-01-01', 106.30, 14.80, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5536-734e-857d-226b152ff77f', 'Anak Maia', 'P', 9, '2025-10-01', 69.10, 10.20, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5539-71b8-8172-41db71fdec72', 'Anak Vada', 'P', 51, '2022-04-01', 109.00, 19.00, 'Normal', 'rendah', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-553c-72b9-b896-8720aabf5e83', 'Anak Loy', 'L', 5, '2026-02-01', 67.90, 8.50, 'Normal', 'rendah', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-553f-711e-8a9c-4cb4aa4bf4cc', 'Anak Candida', 'P', 25, '2024-06-01', 95.30, 8.70, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5541-72e7-a443-0c859ccb66c9', 'Anak Dewitt', 'L', 12, '2025-07-01', 72.70, 6.60, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5544-70d1-9685-cd05e395b142', 'Anak Lizzie', 'P', 13, '2025-06-01', 76.20, 13.20, 'Normal', 'rendah', 'Kutai Barat', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5547-700d-bd02-c247e44367ef', 'Anak Virgie', 'P', 42, '2023-01-01', 95.20, 16.70, 'Normal', 'rendah', 'Balikpapan', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-554a-71b7-883f-514bbca47655', 'Anak Jaylan', 'L', 32, '2023-11-01', 81.20, 12.70, 'Stunting', 'tinggi', 'Kutai Timur', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-554d-709f-98b7-aec8e902d870', 'Anak Marlen', 'P', 33, '2023-10-01', 91.80, 15.50, 'Normal', 'rendah', 'Kutai Timur', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5550-71d0-83cc-63f4cc41d5c9', 'Anak Jacinto', 'L', 3, '2026-04-01', 58.40, 3.50, 'Risiko', 'sedang', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5553-702e-ac26-4bda4d070eaf', 'Anak Carlo', 'L', 48, '2022-07-01', 91.80, 13.60, 'Stunting', 'tinggi', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5555-73a7-b1ab-7e472da82afe', 'Anak Nels', 'L', 50, '2022-05-01', 110.90, 18.00, 'Normal', 'rendah', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5558-700e-b969-adb29c59d91e', 'Anak Johann', 'L', 34, '2023-09-01', 102.60, 17.00, 'Normal', 'normal', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-555b-7133-ae09-d13f9b4bfda9', 'Anak Audra', 'P', 3, '2026-04-01', 46.80, 5.80, 'Stunting Berat', 'sangat_tinggi', 'Paser', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-555d-729b-ad31-4e36de11c640', 'Anak Misael', 'L', 35, '2023-08-01', 91.40, 15.20, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5560-7233-8b9a-91a5b2e5fc9b', 'Anak Timmy', 'L', 3, '2026-04-01', 52.40, 6.40, 'Stunting', 'tinggi', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5563-70de-9f20-75510db05837', 'Anak Lindsay', 'P', 57, '2021-10-01', 104.70, 20.60, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5565-73f4-8150-fac673620cc1', 'Anak Arvilla', 'P', 25, '2024-06-01', 83.30, 10.70, 'Risiko', 'sedang', 'Samarinda', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5567-700d-96ef-fa06d3a2885b', 'Anak Antoinette', 'P', 49, '2022-06-01', 109.80, 15.50, 'Normal', 'rendah', 'Paser', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-556a-72d4-b6dd-cd553e397e25', 'Anak Erin', 'L', 45, '2022-10-01', 100.90, 20.00, 'Normal', 'rendah', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-556c-71e3-bb70-bc16cd0082b5', 'Anak Frank', 'L', 40, '2023-03-01', 95.70, 17.10, 'Normal', 'rendah', 'Paser', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-556e-7024-98d8-ee9b5a4bae83', 'Anak Missouri', 'P', 32, '2023-11-01', 99.00, 16.30, 'Normal', 'normal', 'Paser', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5571-738c-a22f-aa04e1e2d5c4', 'Anak Mack', 'L', 32, '2023-11-01', 85.20, 15.70, 'Risiko', 'sedang', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5573-7104-bc5c-77925e793f14', 'Anak Adelia', 'P', 13, '2025-06-01', 82.20, 9.20, 'Normal', 'normal', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5575-70f5-92d7-fefab15ab0f8', 'Anak Rodrick', 'L', 34, '2023-09-01', 97.60, 11.00, 'Normal', 'rendah', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5578-736d-bc4d-38e57f700ada', 'Anak Ettie', 'P', 20, '2024-11-01', 80.70, 8.70, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-557a-723c-9e3d-d2d7e0418d5c', 'Anak Dorris', 'P', 45, '2022-10-01', 98.20, 13.50, 'Risiko', 'sedang', 'Samarinda', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-557c-70dd-8595-a3ea4fb9ece2', 'Anak Marcus', 'L', 44, '2022-11-01', 107.30, 16.90, 'Normal', 'rendah', 'Paser', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-557e-732b-8d89-04cbe00d7b07', 'Anak Delpha', 'P', 47, '2022-08-01', 109.50, 14.00, 'Normal', 'rendah', 'Kutai Barat', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5581-72d1-8c0f-e7c8c190423a', 'Anak Quinn', 'L', 5, '2026-02-01', 61.90, 4.50, 'Stunting', 'tinggi', 'Kutai Timur', 'Tidak', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5583-714b-bd77-3a7952d59aa0', 'Anak Desmond', 'L', 36, '2023-07-01', 92.10, 16.40, 'Normal', 'rendah', 'Kutai Kartanegara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5585-700c-a705-f56c56c5f130', 'Anak Gerald', 'L', 53, '2022-02-01', 93.70, 16.60, 'Stunting', 'tinggi', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5589-735a-b352-9ea8d372dda8', 'Anak Bell', 'L', 29, '2024-02-01', 92.90, 17.10, 'Normal', 'rendah', 'Bontang', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-558b-71a4-80af-7989187c3e0c', 'Anak Roxanne', 'P', 25, '2024-06-01', 82.30, 11.70, 'Risiko', 'sedang', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-558d-71cf-a0f7-2eb4e1f6e091', 'Anak Cora', 'P', 20, '2024-11-01', 80.70, 12.70, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5590-7001-a7a3-640eccf0febc', 'Anak Dakota', 'P', 42, '2023-01-01', 101.20, 16.70, 'Normal', 'rendah', 'Penajam Paser Utara', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5592-7268-b966-d0cab710d641', 'Anak Andrew', 'L', 32, '2023-11-01', 91.20, 16.70, 'Normal', 'rendah', 'Berau', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5595-7276-b48d-351af44b3076', 'Anak Alexander', 'L', 24, '2024-07-01', 95.80, 11.20, 'Normal', 'normal', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-5597-73a2-b54e-c40ad9b4edf4', 'Anak Minerva', 'P', 15, '2025-04-01', 72.50, 7.60, 'Risiko', 'sedang', 'Balikpapan', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-559a-718f-9aff-3bab13b953e1', 'Anak Chasity', 'P', 40, '2023-03-01', 104.80, 13.20, 'Normal', 'rendah', 'Mahakam Ulu', 'Ya', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5605-67d2-7185-bfef-4e881ba7ec98', 'Anak', 'P', 4, '2026-02-12', 50.00, 30.00, 'Stunting', 'tinggi', 'Samarinda', 'Ya', NULL, '2026-07-12 04:10:22', '2026-07-12 04:10:22'),
('019f585e-ff69-737f-95a1-3b4b5e45ad08', 'Aulia Rahma', 'P', 36, '2023-07-13', 50.00, 24.00, 'Stunting', 'tinggi', 'Berau', 'Ya', NULL, '2026-07-12 15:07:28', '2026-07-12 15:11:40'),
('019f6e1a-8b8e-71b2-8f1b-5f531b3ee73c', 'fghjk', 'P', 6, '2026-01-01', 80.00, 9.20, 'Normal', 'normal', 'Balikpapan', 'Ya', NULL, '2026-07-16 20:24:21', '2026-07-16 20:24:21'),
('019f8d11-6887-73e8-aa9e-0622a7a167c9', 'Anak', 'L', 12, '2025-07-09', 70.00, 7.50, 'Stunting', 'tinggi', 'Samarinda', 'Ya', NULL, '2026-07-22 20:42:36', '2026-07-22 20:42:36'),
('019f8d12-54d9-721f-8d56-e82b5b6aaebe', 'Anak', 'L', 12, '2025-07-09', 76.50, 9.50, 'Normal', 'rendah', 'Samarinda', 'Ya', NULL, '2026-07-22 20:43:36', '2026-07-22 20:43:36'),
('019f8d14-54a3-7365-8a4f-b0e71b751d93', 'Anak', 'L', 60, '2026-01-06', 101.00, 15.20, 'Stunting', 'tinggi', 'Bontang', 'Ya', NULL, '2026-07-22 20:45:47', '2026-07-22 20:45:47'),
('019fbb80-df4a-72ec-9771-93cee3136fe9', 'Aulia Rahma', 'L', 23, '2024-08-31', 80.00, 9.20, 'Stunting', 'tinggi', 'Samarinda', 'Ya', NULL, '2026-07-31 21:06:53', '2026-07-31 21:06:53'),
('019ff8ea-4db8-71a6-a998-37f0286e482d', 'ZAFRAN GHAZI ABDULLAH', 'L', 9, '2025-10-31', 70.00, 9.20, 'Risiko', 'sedang', 'Kutai Kartanegara', 'Ya', NULL, '2026-08-12 19:18:52', '2026-08-12 19:18:52'),
('01a01745-63b0-7304-9d94-157ee376ccfb', 'Aulia Rahma', 'L', 4, '2026-04-14', 80.00, 9.20, 'Normal', 'normal', 'Samarinda', 'Ya', NULL, '2026-08-18 16:46:58', '2026-08-18 16:46:58'),
('01a01746-4ba5-7186-8629-847353dcc263', 'Aulia Rahma', 'L', 18, '2025-02-12', 80.00, 9.20, 'Risiko', 'sedang', 'Samarinda', 'Ya', NULL, '2026-08-18 16:47:57', '2026-08-18 16:47:57'),
('01a03228-0ea7-7359-8f17-ef06a5e12782', 'ZAFRAN GHAZI ABDULLAH', 'L', 6, '2026-02-18', 80.00, 9.20, 'Normal', 'normal', 'Balikpapan', 'Ya', NULL, '2026-08-23 22:04:41', '2026-08-23 22:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_06_123613_create_articles_table', 1),
(5, '2026_07_06_123613_create_measurements_table', 1),
(6, '2026_07_09_063852_update_measurement_status_labels', 1),
(7, '2026_07_10_000000_add_risk_level_to_measurements_table', 1),
(8, '2026_07_10_000001_create_risk_recommendations_table', 1),
(9, '2026_07_25_000000_create_faqs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_recommendations`
--

CREATE TABLE `risk_recommendations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_key` varchar(255) NOT NULL,
  `status_label` varchar(255) NOT NULL,
  `factors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`factors`)),
  `recommendations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recommendations`)),
  `custom_note` text DEFAULT NULL,
  `score` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risk_recommendations`
--

INSERT INTO `risk_recommendations` (`id`, `status_key`, `status_label`, `factors`, `recommendations`, `custom_note`, `score`, `created_at`, `updated_at`) VALUES
(1, 'rendah', 'Risiko rendah', '[\"tinggi_rendah\",\"berat_pantau\",\"tinggi_ibu_rendah\"]', '[{\"tone\":\"emerald\",\"text\":\"Perkuat asupan protein hewani dan sayuran setiap hari.\"},{\"tone\":\"cyan\",\"text\":\"Pantau kenaikan berat dan tinggi badan minimal setiap bulan.\"}]', NULL, 25, '2026-07-22 20:36:51', '2026-07-22 20:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('05ByjZxBFNOoN1j8s1dMCFv4DIt6CjgR0Z50xfAp', NULL, '147.185.132.144', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'eyJfdG9rZW4iOiJDV3l2eU1Oa1hkZDhnWU92Y2JtQURxek1zUUpqZXlNRHp1UHVXVDZSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790199962),
('4oy9DxdX32ilGzrdbtaZ53pR4NvNpRdiDLj5uDAL', NULL, '178.73.250.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'eyJfdG9rZW4iOiJ2RG1WMFdJMDV1NlNuTzY1Sk54VERDUU5zWk1LNEZXWW05NXE5cGZiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZFwvZWR1a2FzaVwva2VidXR1aGFuLXZpdGFtaW4tZC1kYW4ta2Fsc2l1bS11bnR1ay1wZXJ0dW1idWhhbi10dWxhbmctYW5hayIsInJvdXRlIjoiYXJ0aWtlbC5kZXRhaWwifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1790199276),
('6FwDEz7OSxoPRFQDZhDWFupOgPQTIustibheHKxv', NULL, '194.163.134.215', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIwY1RhVmQxMk0yRmh2Tkh5bW5lb2NuYWdhd25XbnRxU2szdk5NVkFwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9tYWlsLnN0dW50aW5nY2FyZS5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790143626),
('9efaNj2G4InadnrQ3uiWRi86Cmx7B8xDoRHuUXtY', NULL, '113.11.183.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'eyJfdG9rZW4iOiIzUldGalhzYTVaOTM1dk9GVm5JNWZXM3gzSFU2MEZqM1Jza2VkVEJpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuc3R1bnRpbmdjYXJlLmlkXC9rYWxrdWxhdG9yIiwicm91dGUiOiJrYWxrdWxhdG9yIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790136460),
('bfh9TxW03aRcoM5Pl2Wh54heOS9iHySsPjRIi7pB', NULL, '40.77.167.1', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'eyJfdG9rZW4iOiIwdHpqbXJ4OG53WVBYUDh2dEFxbHB2S3JmRE8xUjlwTTBHVUkzbGQ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuc3R1bnRpbmdjYXJlLmlkIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790138269),
('Bqo4WSwADsujPJ3RNTFtmYcHmE5jrLjceNcQFEsJ', NULL, '193.183.77.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'eyJfdG9rZW4iOiJMWnVySjRvOUZSaWFMNk1JSkhaUFBnMUs2TzZhWDRNc3ltcFNYVFRMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZFwvZWR1a2FzaVwvcGVudGluZ255YS1tZW1hbnRhdS1iZXJhdC1iYWRhbi1iYWxpdGEtc2V0aWFwLWJ1bGFuLWRpLXBvc3lhbmR1Iiwicm91dGUiOiJhcnRpa2VsLmRldGFpbCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790199276),
('CICsUf871X38QxLSIcmh0kIEL6SLD5rO8N9rV2oj', NULL, '194.14.87.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'eyJfdG9rZW4iOiJ2bWN1aGNWNUwyNjN3MHJ3Y1Vya25oQmhZanlTSEY5UEJCS0lvaWRyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZFwvZWR1a2FzaVwvZWR1a2FzaS1naXppLWFuYWstcGVuY2VnYWhhbi1zdHVudGluZy1kYWxhbS1wZXJzcGVrdGlmLWlzbGFtIiwicm91dGUiOiJhcnRpa2VsLmRldGFpbCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790199276),
('Ida9vahxq6lVXxs8HvQC2AvNPolOSZG3gv69aQ6S', NULL, '173.239.217.221', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJoSm5SV2d6aUpKOUpmTVR2NjFLckZZZlFvVDE5TXh5cldpVzg2RmhCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790196391),
('KqZ7sKSE7lxZ5ghE6Ok5viYrVaZnHkgaB989xBJI', NULL, '36.70.153.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJVUW05NkhWaEVTV3pkUkRncXY2NUN6WGcydkpkTUZWV2tTdDhsT1FMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuc3R1bnRpbmdjYXJlLmlkIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790135242),
('pa1vGefojyvGvHy9xQ4MTFmfrA0sazAFuVm6l5A9', NULL, '198.235.24.186', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'eyJfdG9rZW4iOiI1NDA0eU5QZUpsNG1GbklaQ1hhRmx2YUlFRzcycTZWZnkxejk2SFkxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuc3R1bnRpbmdjYXJlLmlkIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790175601),
('qnOnXpQACfxBaWQNFWQrikxM60yWqsP3NN0huNyH', NULL, '103.253.27.209', 'python-requests/2.32.5', 'eyJfdG9rZW4iOiJIQmlsR0d2cnNMV21JYTVXWlpnOUxhSDRndkxlNFRnbGFmbVNleU90IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1790200496),
('QSqFT6FwJoIGOT3TluVu481gO5rbvrzW52Y5oCgR', NULL, '74.7.227.27', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)', 'eyJfdG9rZW4iOiJtYzVtTEFhVUx1bGJqWGd2bE1ia2ZGRE1idHpDMU1VcWRjSzcxMzc1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9zdHVudGluZ2NhcmUuaWQiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1790158042),
('uq0nkNgjsgiRqse9T0h6sBJNB9TOOqCscFQWwrep', NULL, '193.183.171.187', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'eyJfdG9rZW4iOiJIV3JUMGthcmFpM3Z5ZVhmdWI2aWhKSWtIQlVyVkh4MXBFSWlyc0NDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3N0dW50aW5nY2FyZS5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790199275),
('yLPZK1pYpE7qBwHu4XHNhFWUm1JjJVzYNL1E8aso', NULL, '198.235.24.164', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'eyJfdG9rZW4iOiJ0dDlSNTlNYjJuemRMTGhwb2czSGxlc0VVQW5BUHpyNEdGRjhEMndFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21haWwuc3R1bnRpbmdjYXJlLmlkIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790219621),
('ZuPlCC4d4zTToJtOzqCz6aOt54te3A3Zky0aLOSM', NULL, '157.55.39.204', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'eyJfdG9rZW4iOiJndE1qejBJdUJvc2l6aG1Uek5UYTB4Z1NRbnl2OWhDQWJtZ3htZkp6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuc3R1bnRpbmdjYXJlLmlkXC9rYWxrdWxhdG9yIiwicm91dGUiOiJrYWxrdWxhdG9yIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790176269);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `role` enum('admin_wilayah','koordinator_cabang','kader_lapangan','pengguna_umum') NOT NULL DEFAULT 'pengguna_umum',
  `city` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `role`, `city`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('019f5446-4395-7311-bccc-5e920263b11b', 'Admin SiCegah', 'admin@sicegah.id', '0811-1111-0000', 'admin_wilayah', 'Samarinda', 1, NULL, '$2y$12$Z4hL7A2arBr4zOuTb2xUquJ4QYyIbOui1sZejxJtQPAy5cAVVg8Ei', NULL, '2026-07-11 20:01:58', '2026-07-11 20:01:58'),
('019f5446-44c4-71b2-9e2b-783656513766', 'Khalida Aisyah', 'khalida@sicegah.id', '0812-3456-7890', 'koordinator_cabang', 'Balikpapan', 1, NULL, '$2y$12$6XeZ2zutOq8/395O4zSjGu/CgpVSZyZC6HZUmNFoQA4/dbRz4NYkW', NULL, '2026-07-11 20:01:59', '2026-07-11 20:01:59'),
('019f5446-45f1-709a-8777-93461158c2a6', 'Rina Nurul', 'rina@sicegah.id', '0821-1234-5678', 'kader_lapangan', 'Balikpapan', 1, NULL, '$2y$12$3t7H8S8NGWEWzj.BGqm8c.qOsdeoJq1LnNQDPHayRiWd/PTDbHB2.', NULL, '2026-07-11 20:01:59', '2026-07-11 20:01:59'),
('019f5446-471e-71d0-bfb8-7df185dd9157', 'Ahmad Umar', 'ahmad@example.com', '0851-9876-5432', 'pengguna_umum', 'Kutai Kartanegara', 0, NULL, '$2y$12$q.IMATh2AcxzC20uFkMSheFvqiknSniZCiSbWx528Wj0LNVjO4AJC', NULL, '2026-07-11 20:01:59', '2026-07-11 20:01:59'),
('019f5446-484c-71ed-9341-4b37bf429edf', 'Siti Aminah', 'siti.aminah@sicegah.id', '0813-9876-5432', 'kader_lapangan', 'Samarinda', 1, NULL, '$2y$12$u8SsrTxgMnl1EnT.XS32oe/OO1wRMmN5xv14U82fZwlbS9IwGSGG6', NULL, '2026-07-11 20:02:00', '2026-07-11 20:02:00'),
('019f5446-497b-71f0-8330-01397e3a3120', 'Budi Santoso', 'budi.santoso@sicegah.id', '0812-9988-7766', 'koordinator_cabang', 'Bontang', 1, NULL, '$2y$12$8bVlzA.86CxYkxJuxI914uqZfX8gv1Y1FebxmzlFjBG7Y5.zrTSy6', NULL, '2026-07-11 20:02:00', '2026-07-11 20:02:00'),
('019f5446-4aa9-7090-b898-c1d13c6de88f', 'Dewi Lestari', 'dewi.lestari@sicegah.id', '0852-1122-3344', 'kader_lapangan', 'Kutai Timur', 1, NULL, '$2y$12$xkydqI3Rzzuj4RdiR1dya.Ti.4hW54ifkFkNfr8q.UVtDM08i1RLq', NULL, '2026-07-11 20:02:00', '2026-07-11 20:02:00'),
('019f5446-4bd6-72f4-a644-240843920fa9', 'Eko Prasetyo', 'eko.prasetyo@example.com', '0877-5566-7788', 'pengguna_umum', 'Penajam Paser Utara', 1, NULL, '$2y$12$qEHpu6lE9W4BbgU8XNZ5DudC.01DNoot8Hp/L5gCCGRVrqRLU26Ke', NULL, '2026-07-11 20:02:00', '2026-07-11 20:02:00'),
('019f5446-4d03-7079-aaf4-15883516b73f', 'Fatmawati', 'fatmawati@sicegah.id', '0813-4455-6677', 'kader_lapangan', 'Paser', 1, NULL, '$2y$12$riw24YP.Oh/6XJfjK6ksUO4s.RIGDpoH9CtNasdOV2M.3VGMluVxy', NULL, '2026-07-11 20:02:01', '2026-07-11 20:02:01'),
('019f5446-4e34-70a0-a3c2-f9a5907c921b', 'Hendra Wijaya', 'hendra.wijaya@sicegah.id', '0812-7788-9900', 'koordinator_cabang', 'Berau', 1, NULL, '$2y$12$Sqk2JWYEtBV3MvkYQN7ndOScpAMyDWSISr.uFvugKFv4y.UBZq/Ni', NULL, '2026-07-11 20:02:01', '2026-07-11 20:02:01'),
('019f5446-4f64-715b-b924-fbc351ea270b', 'Ika Kartika', 'ika.kartika@sicegah.id', '0822-3344-5566', 'kader_lapangan', 'Kutai Barat', 1, NULL, '$2y$12$5LkdBsnUUbJdtB6bwRYrnOonsnyD5G99G9bpfd0BGaXVqag5zpJIm', NULL, '2026-07-11 20:02:01', '2026-07-11 20:02:01'),
('019f5446-5098-707c-8056-7f9a3f8c519e', 'Joko Widodo', 'joko.widodo@example.com', '0811-2233-4455', 'pengguna_umum', 'Mahakam Ulu', 1, NULL, '$2y$12$dsb14urYzax03DRWBcA1X.nNR5OAhxKpPBcfSog2RG/s8kJxQV4WO', NULL, '2026-07-11 20:02:02', '2026-07-11 20:02:02'),
('019f5446-51cf-71a5-bca9-9340a6c8700a', 'Lia Ananda', 'lia.ananda@sicegah.id', '0812-8877-6655', 'kader_lapangan', 'Samarinda', 1, NULL, '$2y$12$.CkWgTysUoYusL/HNEUF6umZVSVkvncSc.0axyT1vLXiNoGvw/F.S', NULL, '2026-07-11 20:02:02', '2026-07-11 20:02:02'),
('019f5446-5308-701a-8529-c6223708bc90', 'Muhammad Yusuf', 'muhammad.yusuf@sicegah.id', '0813-1122-3344', 'kader_lapangan', 'Balikpapan', 1, NULL, '$2y$12$/0TrcEjlisFF.X/MNhY53.O1ABjI6s25bYfZY4xdfkzfBz.jOT2vO', NULL, '2026-07-11 20:02:02', '2026-07-11 20:02:02'),
('019f5446-5439-70d5-ab30-4afadf014894', 'Novianti', 'novianti@example.com', '0853-4455-6677', 'pengguna_umum', 'Bontang', 1, NULL, '$2y$12$OlKApbAmdkxjqQN9V2TuW.X3FFdH4JVJVCA14uyFRBsBrkNnsVa8O', NULL, '2026-07-11 20:02:03', '2026-07-11 20:02:03'),
('019f5446-56c8-738d-af64-7f35662d28b1', 'Admin StuntingCare', 'admin@stuntingcare.id', NULL, 'admin_wilayah', NULL, 1, NULL, '$2y$12$OMtV2rCjoBhioY/X339zSec7Vbktr6a1Mp1S/jTBmRNXkE4yxU4CS', 'm7LnbrQiORperbBaDc6C2ojnjzAWLKyApWmRgBLMHwvL2Tm8FDcgL6opNJkO', '2026-07-11 20:02:03', '2026-07-11 22:34:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measurements_kader_id_foreign` (`kader_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `risk_recommendations`
--
ALTER TABLE `risk_recommendations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `risk_recommendations_status_key_unique` (`status_key`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `risk_recommendations`
--
ALTER TABLE `risk_recommendations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_kader_id_foreign` FOREIGN KEY (`kader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
