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
        // ── Bersihkan Data Lama Sebelum Seeding ──
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Measurement::truncate();
        Article::truncate();
        User::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // ── Seed 15 Users ──
        $usersData = [
            [
                'name'         => 'Admin SiCegah',
                'email'        => 'admin@sicegah.id',
                'phone_number' => '0811-1111-0000',
                'role'         => 'admin_wilayah',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Khalida Aisyah',
                'email'        => 'khalida@sicegah.id',
                'phone_number' => '0812-3456-7890',
                'role'         => 'koordinator_cabang',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Rina Nurul',
                'email'        => 'rina@sicegah.id',
                'phone_number' => '0821-1234-5678',
                'role'         => 'kader_lapangan',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Ahmad Umar',
                'email'        => 'ahmad@example.com',
                'phone_number' => '0851-9876-5432',
                'role'         => 'pengguna_umum',
                'city'         => 'Kutai Kartanegara',
                'is_active'    => false,
            ],
            [
                'name'         => 'Siti Aminah',
                'email'        => 'siti.aminah@sicegah.id',
                'phone_number' => '0813-9876-5432',
                'role'         => 'kader_lapangan',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Budi Santoso',
                'email'        => 'budi.santoso@sicegah.id',
                'phone_number' => '0812-9988-7766',
                'role'         => 'koordinator_cabang',
                'city'         => 'Bontang',
                'is_active'    => true,
            ],
            [
                'name'         => 'Dewi Lestari',
                'email'        => 'dewi.lestari@sicegah.id',
                'phone_number' => '0852-1122-3344',
                'role'         => 'kader_lapangan',
                'city'         => 'Kutai Timur',
                'is_active'    => true,
            ],
            [
                'name'         => 'Eko Prasetyo',
                'email'        => 'eko.prasetyo@example.com',
                'phone_number' => '0877-5566-7788',
                'role'         => 'pengguna_umum',
                'city'         => 'Penajam Paser Utara',
                'is_active'    => true,
            ],
            [
                'name'         => 'Fatmawati',
                'email'        => 'fatmawati@sicegah.id',
                'phone_number' => '0813-4455-6677',
                'role'         => 'kader_lapangan',
                'city'         => 'Paser',
                'is_active'    => true,
            ],
            [
                'name'         => 'Hendra Wijaya',
                'email'        => 'hendra.wijaya@sicegah.id',
                'phone_number' => '0812-7788-9900',
                'role'         => 'koordinator_cabang',
                'city'         => 'Berau',
                'is_active'    => true,
            ],
            [
                'name'         => 'Ika Kartika',
                'email'        => 'ika.kartika@sicegah.id',
                'phone_number' => '0822-3344-5566',
                'role'         => 'kader_lapangan',
                'city'         => 'Kutai Barat',
                'is_active'    => true,
            ],
            [
                'name'         => 'Joko Widodo',
                'email'        => 'joko.widodo@example.com',
                'phone_number' => '0811-2233-4455',
                'role'         => 'pengguna_umum',
                'city'         => 'Mahakam Ulu',
                'is_active'    => true,
            ],
            [
                'name'         => 'Lia Ananda',
                'email'        => 'lia.ananda@sicegah.id',
                'phone_number' => '0812-8877-6655',
                'role'         => 'kader_lapangan',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Muhammad Yusuf',
                'email'        => 'muhammad.yusuf@sicegah.id',
                'phone_number' => '0813-1122-3344',
                'role'         => 'kader_lapangan',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Novianti',
                'email'        => 'novianti@example.com',
                'phone_number' => '0853-4455-6677',
                'role'         => 'pengguna_umum',
                'city'         => 'Bontang',
                'is_active'    => true,
            ],
        ];

        $seededUsers = collect();
        foreach ($usersData as $userData) {
            $user = User::create(array_merge($userData, [
                'password' => Hash::make('password'),
            ]));
            $seededUsers->push($user);
        }

        // Get specific users for relationships
        $admin = $seededUsers->where('role', 'admin_wilayah')->first();
        $kaderUsers = $seededUsers->where('role', 'kader_lapangan')->all();


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

                $randomKader = $kaderUsers[array_rand($kaderUsers)];

                Measurement::create([
                    'child_name'   => 'Anak ' . fake()->firstName(),
                    'gender'       => $gender,
                    'age_months'   => $ageMonths,
                    'birth_date'   => now()->subMonths($ageMonths),
                    'height'       => round(rand(60, 110) + rand(0, 9) / 10, 1),
                    'weight'       => round(rand(6, 20) + rand(0, 9) / 10, 1),
                    'status_growth'=> $status,
                    'city'         => $city,
                    'kader_id'     => $randomKader->id,
                ]);
            }
        }
    }
}
