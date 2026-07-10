<?php

namespace Database\Seeders;

use App\Models\Measurement;
use App\Http\Controllers\KalkulatorController;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $genders  = ['L', 'P'];
        $cities   = ['Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara', 'Kutai Timur', 'Berau', 'Paser', 'Penajam Paser Utara', 'Kutai Barat', 'Mahakam Ulu'];

        // Hapus data lama agar bersih
        Measurement::truncate();

        $kalkulator = new KalkulatorController();

        for ($i = 0; $i < 120; $i++) {
            $ageMonths = rand(3, 59);
            $gender    = $genders[array_rand($genders)];
            $city      = $cities[array_rand($cities)];

            // Generate tinggi & berat yang berdistribusi wajar
            // Agar bervariasi statusnya, buat beberapa anak dengan tinggi badan sengaja dipendekkan (stunting)
            $isStunted = rand(0, 4) === 0; // 20% peluang stunting

            // Ambil nilai median tinggi badan WHO untuk usia ini sebagai acuan
            $idealTb = $kalkulator->getResultData($gender, $ageMonths, 80, 10)['ideal_tb'];
            $medianTb = $idealTb['median'];

            if ($isStunted) {
                // Di bawah -2 SD (stunting)
                $tb = $medianTb - rand(8, 15);
            } else {
                // Rentang normal (-1.5 SD s.d +1.5 SD)
                $tb = $medianTb + rand(-6, 8);
            }

            // Ideal berat badan
            $idealBb = $kalkulator->getResultData($gender, $ageMonths, $tb, 10)['ideal_bb'];
            $medianBb = $idealBb['median'];
            $bb = $medianBb + rand(-3, 4);

            // Batasi minimal tinggi dan berat
            $tb = max(45, round($tb, 1));
            $bb = max(3.5, round($bb, 1));

            // Hitung status pertumbuhan riil berdasarkan WHO
            $result = $kalkulator->getResultData($gender, $ageMonths, $tb, $bb, 'Anak', $city);

            $statusGrowthMap = [
                'normal'        => 'Normal',
                'rendah'        => 'Normal',
                'sedang'        => 'Risiko',
                'tinggi'        => 'Stunting',
                'sangat_tinggi' => 'Stunting Berat',
            ];
            $statusGrowth = $statusGrowthMap[$result['risk_level']['code']] ?? 'Normal';

            Measurement::create([
                'child_name'   => 'Anak ' . fake()->firstName($gender === 'L' ? 'male' : 'female'),
                'gender'       => $gender,
                'age_months'   => $ageMonths,
                'birth_date'   => now()->subMonths($ageMonths)->startOfMonth()->toDateString(),
                'height'       => $tb,
                'weight'       => $bb,
                'status_growth'=> $statusGrowth,
                'risk_level'   => $result['risk_level']['code'],
                'city'         => $city,
                'asi_eksklusif'=> rand(0, 4) > 0 ? 'Ya' : 'Tidak',
            ]);
        }
    }
}
