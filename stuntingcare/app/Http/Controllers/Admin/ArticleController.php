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

        // Mengambil kategori bawaan dikombinasikan dengan kategori dinamis dari database
        $defaultCategories = ['Gizi Anak', 'ASI Eksklusif', 'MPASI', 'Pencegahan Stunting', 'Kesehatan Ibu', 'FAQ'];
        $dbCategories = Article::select('category')->distinct()->pluck('category')->toArray();
        $categories = array_unique(array_merge($defaultCategories, $dbCategories));

        return view('admin.artikel-list', compact('articles', 'categories'));
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
            $data['image'] = $this->processAndStoreImage($request->file('image'));
        }

        $article = Article::create($data);

        return redirect()->route('admin.artikel.edit', $article)->with('success', 'Artikel berhasil ditambahkan.');
    }

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
            $data['image'] = $this->processAndStoreImage($request->file('image'));
        }

        $article->update($data);

        return redirect()->route('admin.artikel.edit', $article)->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Preview the given article using the custom admin layout.
     */
    public function preview(Article $article)
    {
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

        return view('admin.artikel-preview', compact('article', 'relatedArticles'));
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

    /**
     * Process, resize, and compress the uploaded image to WebP format.
     */
    private function processAndStoreImage($file)
    {
        $filename = 'articles/' . Str::uuid() . '.webp';

        // Pengaman: Jika ekstensi PHP GD tidak aktif di sistem lokal, langsung simpan file mentah asli
        if (!function_exists('imagecreatefromstring') || !function_exists('imagewebp')) {
            return $file->store('articles', 'public');
        }

        $mime = $file->getMimeType();
        
        // Buat resource gambar berdasarkan MIME type
        if (str_contains($mime, 'jpeg') || str_contains($mime, 'jpg')) {
            $image = @imagecreatefromjpeg($file->getRealPath());
        } elseif (str_contains($mime, 'png')) {
            $image = @imagecreatefrompng($file->getRealPath());
        } elseif (str_contains($mime, 'webp')) {
            $image = @imagecreatefromwebp($file->getRealPath());
        } else {
            $image = false;
        }

        // Jika gagal membaca gambar, simpan file mentah asli
        if (!$image) {
            return $file->store('articles', 'public');
        }

        // Hitung dimensi baru (lebar maksimal 800px, tinggi proporsional)
        $width = imagesx($image);
        $height = imagesy($image);
        $maxSize = 800;

        if ($width > $maxSize) {
            $newWidth = $maxSize;
            $newHeight = floor($height * ($maxSize / $width));
            
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Pertahankan transparansi PNG / WebP
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resizedImage;
        }

        // Tangkap output biner WebP via output buffering (aman lintas sistem operasi)
        ob_start();
        imagewebp($image, null, 75);
        $webpData = ob_get_clean();
        imagedestroy($image);

        // Tulis data WebP ke storage disk publik Laravel
        \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $webpData);

        return $filename;
    }
}
