<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'status',
    ];

    /**
     * Scope query to only include active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Aktif');
    }
}
