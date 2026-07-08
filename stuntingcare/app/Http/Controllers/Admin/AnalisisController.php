<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
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

        // ----- Summary stats -----
        $totalAll      = Measurement::count();
        $totalNormal   = Measurement::where('status_growth', 'Normal')->count();
        $totalPendek   = Measurement::where('status_growth', 'Pendek')->count();
        $totalSgtPendek= Measurement::where('status_growth', 'Sangat Pendek')->count();
        $totalStunting = $totalPendek + $totalSgtPendek; // Risiko + Stunting Berat

        // ----- Chart: Pie komposisi status -----
        $chartStatus = [
            'Normal'         => $totalNormal,
            'Pendek'         => $totalPendek,
            'Sangat Pendek'  => $totalSgtPendek,
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
                'Normal'        => Measurement::where('status_growth', 'Normal')->whereBetween('age_months', [$min, $max])->count(),
                'Pendek'        => Measurement::where('status_growth', 'Pendek')->whereBetween('age_months', [$min, $max])->count(),
                'Sangat Pendek' => Measurement::where('status_growth', 'Sangat Pendek')->whereBetween('age_months', [$min, $max])->count(),
            ];
        }

        // ----- Per kota (peta) -----
        $perKota = Measurement::selectRaw('city, status_growth, count(*) as total')
            ->groupBy('city', 'status_growth')
            ->get()
            ->groupBy('city')
            ->map(function ($rows) {
                $stunting = 0;
                $normal   = 0;
                foreach ($rows as $row) {
                    if (in_array($row->status_growth, ['Pendek', 'Sangat Pendek'])) {
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
            'totalStunting',
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
}
