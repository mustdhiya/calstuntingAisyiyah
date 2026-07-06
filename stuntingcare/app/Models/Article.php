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
        'is_published',
        'show_on_homepage',
        'is_featured',
        'meta_title',
        'meta_description',
        'views',
        'shares',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
            'is_published' => 'boolean',
            'show_on_homepage' => 'boolean',
            'is_featured' => 'boolean',
            'views' => 'integer',
            'shares' => 'integer',
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
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOnHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }
}
