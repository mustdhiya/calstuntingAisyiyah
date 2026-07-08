<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display the article list.
     */
    public function index(Request $request)
    {
        $query = Article::with('author')->latest('published_date');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('admin.artikel-list', compact('articles'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('admin.artikel-edit', ['article' => null]);
    }

    /**
     * Store a new article.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug',
            'category'         => 'required|string',
            'author_name'      => 'required|string|max:255',
            'published_date'   => 'nullable|date',
            'read_time'        => 'nullable|integer|min:1',
            'summary'          => 'nullable|string',
            'content'          => 'required|string',
            'image'            => 'nullable|image|max:2048',
            'references'       => 'nullable|string',
            'show_on_homepage' => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // Kondisi baru: Jika toggle "Terbitkan artikel" aktif (dicentang) -> published. Jika tidak -> scheduled.
        $data['status']           = $request->boolean('is_published') ? 'published' : 'scheduled';
        $data['show_on_homepage'] = $request->boolean('show_on_homepage');
        $data['is_featured']      = $request->boolean('is_featured');
        $data['user_id']          = auth()->id();
        $data['slug']             = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create($data);

        return redirect()->route('admin.artikel.edit', $article)->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Show the edit form for the given article.
     */
    public function edit(Article $article)
    {
        return view('admin.artikel-edit', compact('article'));
    }

    /**
     * Update the given article.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug,' . $article->id,
            'category'         => 'required|string',
            'author_name'      => 'required|string|max:255',
            'published_date'   => 'nullable|date',
            'read_time'        => 'nullable|integer|min:1',
            'summary'          => 'nullable|string',
            'content'          => 'required|string',
            'image'            => 'nullable|image|max:2048',
            'references'       => 'nullable|string',
            'show_on_homepage' => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // Kondisi edit: Jika toggle "Terbitkan artikel" aktif (dicentang) -> published. Jika tidak -> draft.
        $data['status']           = $request->boolean('is_published') ? 'published' : 'draft';
        $data['show_on_homepage'] = $request->boolean('show_on_homepage');
        $data['is_featured']      = $request->boolean('is_featured');
        $data['slug']             = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.artikel.edit', $article)->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Archive (soft-unpublish) the given article.
     */
    public function archive(Article $article)
    {
        // Mengubah status ke draft saat diarsipkan
        $article->update(['status' => 'draft']);
        return redirect()->route('admin.artikel.list')->with('success', 'Artikel berhasil diarsipkan.');
    }

    /**
     * Delete the given article.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.artikel.list')->with('success', 'Artikel berhasil dihapus.');
    }
}
