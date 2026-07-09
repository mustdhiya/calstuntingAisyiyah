<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Normal', 'Normal', 'Risiko', 'Stunting', 'Stunting Berat'];
        $genders  = ['L', 'P'];
        $cities   = ['Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara', 'Kutai Timur', 'Berau', 'Paser', 'Penajam Paser Utara', 'Kutai Barat', 'Mahakam Ulu'];

        // Hapus data lama agar bersih
        Measurement::truncate();

        for ($i = 0; $i < 120; $i++) {
            $ageMonths = rand(3, 59);
            $gender    = $genders[array_rand($genders)];
            $status    = $statuses[array_rand($statuses)];
            $city      = $cities[array_rand($cities)];

            Measurement::create([
                'child_name'   => 'Anak ' . fake()->firstName($gender === 'L' ? 'male' : 'female'),
                'gender'       => $gender,
                'age_months'   => $ageMonths,
                'birth_date'   => now()->subMonths($ageMonths)->startOfMonth()->toDateString(),
                'height'       => round(rand(55, 115) + rand(0, 9) / 10, 1),
                'weight'       => round(rand(5, 22) + rand(0, 9) / 10, 1),
                'status_growth'=> $status,
                'city'         => $city,
                'asi_eksklusif'=> rand(0, 4) > 0 ? 'Ya' : 'Tidak', // 80% Ya, 20% Tidak
            ]);
        }
    }
}