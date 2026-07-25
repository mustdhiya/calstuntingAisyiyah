<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Measurement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMeasurements = Measurement::count();
        $totalNormal       = Measurement::byStatus('Normal')->count();
        $totalRisiko       = Measurement::byStatus('Risiko')->count();
        $totalStunting     = Measurement::byStatus('Stunting')->count();
        $totalBerat        = Measurement::byStatus('Stunting Berat')->count();
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

        // Recent measurements
        $recentMeasurements = Measurement::latest()->limit(5)->get()->map(function ($item) {
            return [
                'type' => 'measurement',
                'title_prefix' => 'Skrining kalkulator',
                'bold_text' => $item->child_name,
                'description' => 'Status: ' . $item->status_growth . ' (' . ($item->city ?? '-') . ')',
                'icon' => 'calculate',
                'icon_color' => 'bg-indigo-50 text-indigo-600',
                'time' => $item->created_at
            ];
        });

        // Recent articles
        $recentArticles = Article::latest()->limit(5)->get()->map(function ($item) {
            return [
                'type' => 'article',
                'title_prefix' => 'Artikel baru',
                'bold_text' => $item->title,
                'description' => 'Dibuat oleh ' . ($item->author_name ?? 'Admin'),
                'icon' => 'article',
                'icon_color' => 'bg-emerald-50 text-emerald-600',
                'time' => $item->created_at
            ];
        });

        // Recent users (kader_lapangan / koordinator_cabang)
        $recentUsers = User::whereIn('role', ['kader_lapangan', 'koordinator_cabang'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $roleName = $item->role === 'kader_lapangan' ? 'Kader' : 'Koordinator';
                return [
                    'type' => 'user',
                    'title_prefix' => $roleName . ' baru bergabung',
                    'bold_text' => $item->name,
                    'description' => 'Wilayah: ' . ($item->city ?? '-'),
                    'icon' => 'group',
                    'icon_color' => 'bg-sky-50 text-sky-600',
                    'time' => $item->created_at
                ];
            });

        // Recent FAQs
        $recentFaqs = Faq::latest()->limit(5)->get()->map(function ($item) {
            return [
                'type' => 'faq',
                'title_prefix' => 'FAQ baru',
                'bold_text' => $item->question,
                'description' => 'Status: ' . $item->status,
                'icon' => 'help_outline',
                'icon_color' => 'bg-blue-50 text-blue-600',
                'time' => $item->created_at
            ];
        });

        // Gabungkan semua aktivitas dan urutkan berdasarkan created_at descending, ambil 5 teratas
        $recentActivities = collect()
            ->merge($recentMeasurements)
            ->merge($recentArticles)
            ->merge($recentUsers)
            ->merge($recentFaqs)
            ->sortByDesc('time')
            ->take(5);

        return view('admin.dashboard', compact(
            'totalMeasurements',
            'totalNormal',
            'totalRisiko',
            'totalStunting',
            'totalBerat',
            'totalStunted',
            'totalArticles',
            'publishedArticles',
            'totalUsers',
            'totalKader',
            'newUsers30d',
            'kaltimData',
            'recentActivities',
        ));
    }
}
