<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Normal', 'Normal', 'Normal', 'Pendek', 'Sangat Pendek'];
        $genders  = ['L', 'P'];

        for ($i = 0; $i < 15; $i++) {
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
                'asi_eksklusif'=> rand(0, 1) ? 'Ya' : 'Tidak',
            ]);
        }
    }
}