<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'child_name',
        'gender',
        'age_months',
        'birth_date',
        'height',
        'weight',
        'status_growth',
        'city',
        'kader_id',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'age_months' => 'integer',
        ];
    }

    /**
     * Relationships
     */
    public function kader()
    {
        return $this->belongsTo(User::class, 'kader_id');
    }

    /**
     * Scopes
     */
    public function scopeByCity($query, string $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status_growth', $status);
    }

    public function scopeStunted($query)
    {
        return $query->whereIn('status_growth', ['Pendek', 'Sangat Pendek']);
    }
}
