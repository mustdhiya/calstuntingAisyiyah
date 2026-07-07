<?php

namespace Database\Seeders;

use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $kaderUsers = User::where('role', 'kader_lapangan')->get();
        if ($kaderUsers->isEmpty()) {
            $kaderUsers = User::all();
        }

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

                $randomKader = $kaderUsers->random();

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