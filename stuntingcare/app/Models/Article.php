<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'author_name',
        'published_date',
        'read_time',
        'summary',
        'content',
        'image',
        'references',
        'status',
        'show_on_homepage',
        'is_featured',
        'meta_title',
        'meta_description',
        'views',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
            'status'           => 'string',
            'show_on_homepage' => 'boolean',
            'is_featured' => 'boolean',
            'views' => 'integer',
        ];
    }

    /**
     * Auto-generate slug from title if not provided.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Relationships
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scopes
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOnHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessor untuk mendapatkan URL lengkap gambar artikel.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://', 'data:'])) {
            return $this->image;
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
}
