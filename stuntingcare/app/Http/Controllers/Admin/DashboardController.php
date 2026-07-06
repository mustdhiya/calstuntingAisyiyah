<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Measurement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMeasurements = Measurement::count();
        $totalNormal       = Measurement::byStatus('Normal')->count();
        $totalPendek       = Measurement::byStatus('Pendek')->count();
        $totalSangatPendek = Measurement::byStatus('Sangat Pendek')->count();
        $totalStunted      = Measurement::stunted()->count();

        $totalArticles   = Article::count();
        $publishedArticles = Article::published()->count();

        $totalUsers  = User::count();
        $totalKader  = User::where('role', 'kader_lapangan')->count();
        $newUsers30d = User::where('created_at', '>=', now()->subDays(30))->count();

        // Data per kab/kota for the map (risiko tinggi = stunted)
        $kaltimData = Measurement::stunted()
            ->whereNotNull('city')
            ->selectRaw('city, COUNT(*) as total')
            ->groupBy('city')
            ->pluck('total', 'city');

        // Recent measurements for the activity feed
        $recentMeasurements = Measurement::with('kader')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMeasurements',
            'totalNormal',
            'totalPendek',
            'totalSangatPendek',
            'totalStunted',
            'totalArticles',
            'publishedArticles',
            'totalUsers',
            'totalKader',
            'newUsers30d',
            'kaltimData',
            'recentMeasurements',
        ));
    }
}
