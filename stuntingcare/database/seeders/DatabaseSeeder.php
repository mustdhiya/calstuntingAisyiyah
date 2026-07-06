<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin Wilayah ──
        $admin = User::create([
            'name'         => 'Admin SiCegah',
            'email'        => 'admin@sicegah.id',
            'phone_number' => '0811-1111-0000',
            'role'         => 'admin_wilayah',
            'city'         => 'Samarinda',
            'is_active'    => true,
            'password'     => Hash::make('password'),
        ]);

        // ── Koordinator Cabang ──
        $koordinator = User::create([
            'name'         => 'Khalida Aisyah',
            'email'        => 'khalida@sicegah.id',
            'phone_number' => '0812-3456-7890',
            'role'         => 'koordinator_cabang',
            'city'         => 'Balikpapan',
            'is_active'    => true,
            'password'     => Hash::make('password'),
        ]);

        // ── Kader Lapangan ──
        $kader = User::create([
            'name'         => 'Rina Nurul',
            'email'        => 'rina@sicegah.id',
            'phone_number' => '0821-1234-5678',
            'role'         => 'kader_lapangan',
            'city'         => 'Balikpapan',
            'is_active'    => true,
            'password'     => Hash::make('password'),
        ]);

        // ── Pengguna Umum ──
        User::create([
            'name'         => 'Ahmad Umar',
            'email'        => 'ahmad@example.com',
            'phone_number' => '0851-9876-5432',
            'role'         => 'pengguna_umum',
            'city'         => 'Kutai Kartanegara',
            'is_active'    => false,
            'password'     => Hash::make('password'),
        ]);

        // ── Articles ──
        $articles = [
            [
                'title'          => 'Protein hewani harian untuk pertumbuhan optimal anak',
                'category'       => 'Gizi Anak',
                'summary'        => 'Pentingnya protein hewani setiap hari untuk mendukung tumbuh kembang anak dan pencegahan stunting.',
                'content'        => "# Protein Hewani\n\nProtein hewani dibutuhkan untuk membantu pembentukan jaringan tubuh dan mendukung pertumbuhan anak.\n\n- Telur\n- Ikan\n- Daging ayam\n- Hati\n- Susu",
                'is_published'   => true,
                'show_on_homepage' => true,
                'is_featured'    => false,
                'read_time'      => 6,
                'published_date' => now()->subDays(5),
            ],
            [
                'title'          => 'Panduan MPASI bergizi untuk usia 6–24 bulan',
                'category'       => 'MPASI',
                'summary'        => 'Contoh menu MPASI seimbang dengan sumber protein hewani, nabati, dan sayur.',
                'content'        => "# Panduan MPASI\n\nMakanan pendamping ASI perlu diberikan dengan komposisi gizi yang seimbang.\n\n- Bubur sayur dengan ayam\n- Puree labu dengan ikan\n- Tim tahu dengan brokoli",
                'is_published'   => false,
                'show_on_homepage' => false,
                'is_featured'    => false,
                'read_time'      => 8,
                'published_date' => now()->subDays(10),
            ],
            [
                'title'          => 'ASI Eksklusif: Manfaat dan Cara Pemberian yang Benar',
                'category'       => 'ASI Eksklusif',
                'summary'        => 'Panduan pemberian ASI eksklusif selama 6 bulan pertama kehidupan anak.',
                'content'        => "# ASI Eksklusif\n\nASI eksklusif selama 6 bulan pertama adalah investasi terbaik untuk kesehatan anak jangka panjang.",
                'is_published'   => true,
                'show_on_homepage' => true,
                'is_featured'    => true,
                'read_time'      => 5,
                'published_date' => now()->subDays(2),
            ],
        ];

        foreach ($articles as $a) {
            Article::create(array_merge($a, [
                'author_name' => 'Tim Edukasi SiCegah',
                'slug'        => Str::slug($a['title']),
                'user_id'     => $admin->id,
            ]));
        }

        // ── Measurements (stunting data per kota Kaltim) ──
        $cities = [
            'Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara',
            'Kutai Timur', 'Kutai Barat', 'Berau', 'Paser',
            'Penajam Paser Utara', 'Mahakam Ulu',
        ];

        $statuses = ['Normal', 'Normal', 'Normal', 'Pendek', 'Sangat Pendek'];
        $genders  = ['L', 'P'];

        foreach ($cities as $city) {
            $count = rand(8, 25);
            for ($i = 0; $i < $count; $i++) {
                $ageMonths = rand(6, 60);
                $gender    = $genders[array_rand($genders)];
                $status    = $statuses[array_rand($statuses)];

                Measurement::create([
                    'child_name'   => 'Anak ' . fake()->firstName(),
                    'gender'       => $gender,
                    'age_months'   => $ageMonths,
                    'birth_date'   => now()->subMonths($ageMonths),
                    'height'       => round(rand(60, 110) + rand(0, 9) / 10, 1),
                    'weight'       => round(rand(6, 20) + rand(0, 9) / 10, 1),
                    'status_growth'=> $status,
                    'city'         => $city,
                    'kader_id'     => $kader->id,
                ]);
            }
        }
    }
}
