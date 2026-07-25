<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Faq;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display the public home page with latest articles and FAQs.
     */
    public function index()
    {
        $latestArticles = Article::published()
            ->latest('published_date')
            ->limit(3)
            ->get();

        $faqs = Faq::active()
            ->latest()
            ->limit(4)
            ->get();

        return view('public.index', compact('latestArticles', 'faqs'));
    }

    /**
     * Display the public FAQ page with all active FAQs.
     */
    public function faq()
    {
        $faqs = Faq::active()
            ->latest()
            ->get();

        return view('public.faq', compact('faqs'));
    }
}
