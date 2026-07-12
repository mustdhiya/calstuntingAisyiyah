<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\KalkulatorController;
use App\Models\Measurement;
use App\Models\RiskRecommendation;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index(Request $request)
    {
        // ----- Filters -----
        $search    = $request->input('search');
        $status    = $request->input('status');
        $ageMin    = $request->input('age_min');
        $ageMax    = $request->input('age_max');

        $query = Measurement::latest();

        if ($search) {
            $query->where('child_name', 'like', "%{$search}%");
        }
        if ($status) {
            $query->where('status_growth', $status);
        }
        if ($ageMin !== null && $ageMin !== '') {
            $query->where('age_months', '>=', (int) $ageMin);
        }
        if ($ageMax !== null && $ageMax !== '') {
            $query->where('age_months', '<=', (int) $ageMax);
        }

        $measurements = $query->paginate(10)->withQueryString();

        // ----- Summary stats (30 hari terakhir) -----
        $thirtyDaysAgo = now()->subDays(30);
        $totalAll      = Measurement::where('created_at', '>=', $thirtyDaysAgo)->count();
        $totalNormal   = Measurement::where('status_growth', 'Normal')->where('created_at', '>=', $thirtyDaysAgo)->count();
        $totalRisiko   = Measurement::where('status_growth', 'Risiko')->where('created_at', '>=', $thirtyDaysAgo)->count();
        $totalStunting = Measurement::where('status_growth', 'Stunting')->where('created_at', '>=', $thirtyDaysAgo)->count();
        $totalBerat    = Measurement::where('status_growth', 'Stunting Berat')->where('created_at', '>=', $thirtyDaysAgo)->count();

        // ----- Chart: Pie komposisi status -----
        $chartStatus = [
            'Normal'         => $totalNormal,
            'Risiko'         => $totalRisiko,
            'Stunting'       => $totalStunting,
            'Stunting Berat' => $totalBerat,
        ];

        // ----- Chart: Bar distribusi usia per status -----
        $ageGroups = [
            '0-6'   => [0, 6],
            '7-12'  => [7, 12],
            '13-24' => [13, 24],
            '25-36' => [25, 36],
            '37-60' => [37, 60],
        ];

        $chartAge = [];
        foreach ($ageGroups as $label => [$min, $max]) {
            $chartAge[$label] = [
                'Normal'         => Measurement::where('status_growth', 'Normal')->where('created_at', '>=', $thirtyDaysAgo)->whereBetween('age_months', [$min, $max])->count(),
                'Risiko'         => Measurement::where('status_growth', 'Risiko')->where('created_at', '>=', $thirtyDaysAgo)->whereBetween('age_months', [$min, $max])->count(),
                'Stunting'       => Measurement::where('status_growth', 'Stunting')->where('created_at', '>=', $thirtyDaysAgo)->whereBetween('age_months', [$min, $max])->count(),
                'Stunting Berat' => Measurement::where('status_growth', 'Stunting Berat')->where('created_at', '>=', $thirtyDaysAgo)->whereBetween('age_months', [$min, $max])->count(),
            ];
        }

        // ----- Per kota (peta) -----
        $perKota = Measurement::where('created_at', '>=', $thirtyDaysAgo)
            ->selectRaw('city, status_growth, count(*) as total')
            ->groupBy('city', 'status_growth')
            ->get()
            ->groupBy('city')
            ->map(function ($rows) {
                $stunting = 0;
                $normal   = 0;
                foreach ($rows as $row) {
                    if (in_array($row->status_growth, ['Stunting', 'Stunting Berat'])) {
                        $stunting += $row->total;
                    } else {
                        $normal += $row->total;
                    }
                }
                return ['stunting' => $stunting, 'normal' => $normal, 'total' => $stunting + $normal];
            });

        // Hanya nilai stunting untuk peta heatmap
        $mapData = $perKota->map(fn($v) => $v['stunting'])->toArray();

        return view('admin.analisis', compact(
            'measurements',
            'totalAll',
            'totalNormal',
            'totalRisiko',
            'totalStunting',
            'totalBerat',
            'chartStatus',
            'chartAge',
            'mapData',
            'perKota',
            'search',
            'status',
            'ageMin',
            'ageMax'
        ));
    }

    public function peta()
{
    $thirtyDaysAgo = now()->subDays(30);

    $perKota = Measurement::where('created_at', '>=', $thirtyDaysAgo)
        ->selectRaw('city, status_growth, count(*) as total')
        ->groupBy('city', 'status_growth')
        ->get()
        ->groupBy('city')
        ->map(function ($rows, $city) {
            $normal = 0;
            $risiko = 0;
            $stunting = 0;
            $berat = 0;

            foreach ($rows as $row) {
                if ($row->status_growth === 'Normal') {
                    $normal += $row->total;
                } elseif ($row->status_growth === 'Risiko') {
                    $risiko += $row->total;
                } elseif ($row->status_growth === 'Stunting') {
                    $stunting += $row->total;
                } elseif ($row->status_growth === 'Stunting Berat') {
                    $berat += $row->total;
                }
            }

            $total = $normal + $risiko + $stunting + $berat;
            $nilaiRisiko = $risiko + $stunting + $berat;

            return [
                'nama' => $city,
                'normal' => $normal,
                'risiko' => $risiko,
                'stunting' => $stunting,
                'berat' => $berat,
                'nilai' => $nilaiRisiko,
                'total' => $total,
                'persentase' => $total > 0 ? round(($nilaiRisiko / $total) * 100, 1) : 0,
            ];
        })
        ->values();

    return view('admin.analisis-peta', [
        'mapWilayah' => $perKota,
        'geoJsonUrl' => asset('static/maps/kalimantan-timur-kabkota.geojson'),
    ]);
}

    public function exportCsv(Request $request)
    {
        $records = Measurement::latest()->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="analisis-stunting-' . now()->format('Ymd') . '.csv"',
        ];

        $callback = function () use ($records) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
            fputcsv($handle, ['No', 'Nama Anak', 'Gender', 'Usia (bln)', 'Tinggi (cm)', 'Berat (kg)', 'Status', 'Kota', 'Tanggal']);
            foreach ($records as $i => $m) {
                fputcsv($handle, [
                    $i + 1,
                    $m->child_name,
                    $m->gender === 'L' ? 'Laki-laki' : 'Perempuan',
                    $m->age_months,
                    $m->height,
                    $m->weight,
                    $m->status_growth,
                    $m->city,
                    $m->created_at->format('d/m/Y'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function detailHasil(Measurement $measurement)
    {
        $kalkulator = new \App\Http\Controllers\KalkulatorController();
        $result = $kalkulator->getResultData(
            $measurement->gender,
            $measurement->age_months,
            $measurement->height,
            $measurement->weight,
            $measurement->child_name,
            $measurement->city ?? 'samarinda',
            $measurement->birth_date,
            null // Ubah menjadi null agar dinamis mengikuti parameter DB terbaru
        );
        $result['isAdminView'] = true;

        return view('public.hasil-kalkulator', compact('result'));
    }

    public function hasilAnalisisRisikoForm()
    {
        $dbRecommendations = RiskRecommendation::all()->keyBy('status_key');
        return view('admin.hasil-analisis-risiko', compact('dbRecommendations'));
    }

    public function saveRecommendations(Request $request)
    {
        $status = $request->input('status');
        $factors = json_decode($request->input('factors_json', '[]'), true);
        $recommendations = json_decode($request->input('recommendations_json', '[]'), true);
        $customNote = $request->input('custom_note');
        $score = $request->input('score') !== null ? (int) $request->input('score') : null;

        $statusLabelMap = [
            'normal'        => 'Normal',
            'rendah'        => 'Risiko rendah',
            'sedang'        => 'Risiko sedang',
            'tinggi'        => 'Risiko tinggi',
            'sangat_tinggi' => 'Stunting / risiko sangat tinggi',
        ];

        RiskRecommendation::updateOrCreate(
            ['status_key' => $status],
            [
                'status_label'    => $statusLabelMap[$status] ?? ucfirst($status),
                'factors'         => $factors,
                'recommendations' => $recommendations,
                'custom_note'     => $customNote,
                'score'           => $score,
            ]
        );

        // Sinkronisasi massal: hitung ulang risk_level & status_growth semua anak
        $this->syncAllMeasurements();

        return redirect()->back()->with('success', 'Konfigurasi parameter hasil analisis risiko berhasil disimpan ke database!');
    }

    /**
     * Sinkronisasi massal: hitung ulang risk_level dan status_growth
     * seluruh data anak berdasarkan parameter threshold terbaru dari database.
     */
    private function syncAllMeasurements(): void
    {
        $kalkulator = new KalkulatorController();

        $statusGrowthMap = [
            'normal'        => 'Normal',
            'rendah'        => 'Normal',
            'sedang'        => 'Risiko',
            'tinggi'        => 'Stunting',
            'sangat_tinggi' => 'Stunting Berat',
        ];

        $measurements = Measurement::all();

        foreach ($measurements as $m) {
            try {
                // Hitung ulang Z-score
                $zscore_tbu = $kalkulator->calcZscoreTBU($m->gender, (int) $m->age_months, (float) $m->height);
                $zscore_bbu = $kalkulator->calcZscoreBBU($m->gender, (int) $m->age_months, (float) $m->weight);

                // Hitung skor risiko (0-100)
                $risk_score = $kalkulator->calcRiskScore($zscore_tbu, $zscore_bbu, []);

                // Tentukan risk_level dinamis berdasarkan threshold DB terbaru
                $risk_level = $kalkulator->classifyRisk($risk_score);

                // Petakan ke status_growth (4 status admin)
                $status_growth = $statusGrowthMap[$risk_level['code']] ?? 'Normal';

                // Update baris data anak
                $m->update([
                    'risk_level'    => $risk_level['code'],
                    'status_growth' => $status_growth,
                ]);
            } catch (\Throwable $e) {
                // Lewati anak yang datanya bermasalah (misal usia atau tinggi tidak valid)
                continue;
            }
        }
    }
}
