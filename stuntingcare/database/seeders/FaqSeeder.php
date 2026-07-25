<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => "Bagaimana cara sistem menghitung usia anak secara otomatis?",
                'answer'   => "Sistem mengkalkulasi usia secara otomatis berdasarkan input 'Tanggal Lahir' yang dimasukkan, dihitung hingga tanggal hari ini atau tanggal pengukuran (real-time) dalam satuan bulan yang presisi sesuai standar Kemenkes.",
                'status'   => 'Aktif',
            ],
            [
                'question' => "Apakah hasil kalkulator adalah diagnosis medis?",
                'answer'   => "Tidak. Kalkulator hanya membantu skrining awal dan edukasi. Diagnosis tetap memerlukan pemeriksaan medis oleh tenaga kesehatan profesional.",
                'status'   => 'Aktif',
            ],
            [
                'question' => "Kapan balita harus segera dirujuk ke Puskesmas?",
                'answer'   => "Bila pertumbuhan anak tampak tidak sesuai, nafsu makan menurun, infeksi sering berulang, atau hasil skrining menunjukkan risiko sedang hingga tinggi.",
                'status'   => 'Aktif',
            ],
            [
                'question' => "Apa penyebab utama stunting pada balita?",
                'answer'   => "Penyebab utama meliputi kekurangan gizi kronis, infeksi berulang, sanitasi yang kurang baik, pola asuh, dan akses kesehatan yang terbatas.",
                'status'   => 'Aktif',
            ],
            [
                'question' => "Mengapa 1000 hari pertama kehidupan (HPK) sangat krusial?",
                'answer'   => "Periode 1000 HPK (sejak pembuahan dalam kandungan hingga usia 2 tahun) merupakan masa keemasan pertumbuhan otak dan fisik anak serta pencegahan utama stunting.",
                'status'   => 'Draf',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
