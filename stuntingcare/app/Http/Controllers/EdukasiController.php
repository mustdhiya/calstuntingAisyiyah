<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')->latest('published_date');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('summary', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(9)->withQueryString();

        return view('public.edukasi', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $article->increment('views');

        $relatedArticles = Article::where('category', $article->category)
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_date')
            ->limit(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $extra = Article::where('status', 'published')
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id')->toArray())
                ->latest('published_date')
                ->limit(3 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->concat($extra);
        }

        return view('public.artikel-detail', compact('article', 'relatedArticles'));
    }
}