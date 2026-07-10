<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_key',
        'status_label',
        'factors',
        'recommendations',
        'custom_note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'factors' => 'array',
            'recommendations' => 'array',
        ];
    }
}
