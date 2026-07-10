<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiskRecommendation;

class RiskRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'status_key' => 'normal',
                'status_label' => 'Normal',
                'factors' => [],
                'recommendations' => [
                    [
                        'tone' => 'emerald',
                        'text' => 'Pertahankan pola makan seimbang dan jadwal pemantauan rutin di Posyandu.'
                    ],
                    [
                        'tone' => 'cyan',
                        'text' => 'Pastikan imunisasi lengkap dan pemantauan perkembangan dilakukan sesuai jadwal.'
                    ]
                ],
                'custom_note' => null
            ],
            [
                'status_key' => 'rendah',
                'status_label' => 'Risiko rendah',
                'factors' => ['tinggi_rendah', 'berat_pantau'],
                'recommendations' => [
                    [
                        'tone' => 'emerald',
                        'text' => 'Perkuat asupan protein hewani dan sayuran setiap hari.'
                    ],
                    [
                        'tone' => 'cyan',
                        'text' => 'Pantau kenaikan berat dan tinggi badan minimal setiap bulan.'
                    ]
                ],
                'custom_note' => null
            ],
            [
                'status_key' => 'sedang',
                'status_label' => 'Risiko sedang',
                'factors' => ['tinggi_rendah', 'berat_pantau', 'tinggi_ibu_rendah'],
                'recommendations' => [
                    [
                        'tone' => 'emerald',
                        'text' => 'Tinjau kembali pola makan harian, terutama frekuensi dan kualitas sumber protein hewani.'
                    ],
                    [
                        'tone' => 'cyan',
                        'text' => 'Lakukan pemantauan tinggi badan dan berat badan secara rutin di Posyandu atau Puskesmas.'
                    ],
                    [
                        'tone' => 'amber',
                        'text' => 'Segera konsultasikan ke tenaga kesehatan bila ada infeksi berulang atau nafsu makan menurun.'
                    ]
                ],
                'custom_note' => null
            ],
            [
                'status_key' => 'tinggi',
                'status_label' => 'Risiko tinggi',
                'factors' => ['tinggi_rendah', 'berat_pantau', 'tinggi_ibu_rendah'],
                'recommendations' => [
                    [
                        'tone' => 'amber',
                        'text' => 'Segera rujuk ke fasilitas kesehatan untuk evaluasi pertumbuhan lebih lanjut.'
                    ],
                    [
                        'tone' => 'rose',
                        'text' => 'Pertimbangkan pemeriksaan tambahan bila ada tanda-tanda kelemahan umum atau infeksi kronis.'
                    ]
                ],
                'custom_note' => null
            ],
            [
                'status_key' => 'sangat_tinggi',
                'status_label' => 'Stunting / risiko sangat tinggi',
                'factors' => ['tinggi_rendah', 'berat_pantau', 'tinggi_ibu_rendah'],
                'recommendations' => [
                    [
                        'tone' => 'rose',
                        'text' => 'Perlu evaluasi komprehensif oleh tenaga kesehatan, termasuk pemeriksaan status gizi dan penyakit penyerta.'
                    ],
                    [
                        'tone' => 'amber',
                        'text' => 'Pendampingan intensif kepada keluarga untuk perbaikan pola makan dan lingkungan rumah.'
                    ]
                ],
                'custom_note' => null
            ]
        ];

        foreach ($data as $item) {
            RiskRecommendation::updateOrCreate(
                ['status_key' => $item['status_key']],
                $item
            );
        }
    }
}
