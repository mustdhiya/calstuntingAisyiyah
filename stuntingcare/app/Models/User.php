<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'role',
        'city',
        'is_active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relationships
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'kader_id');
    }

    /**
     * Role helpers
     */
    public function isAdminWilayah(): bool
    {
        return $this->role === 'admin_wilayah';
    }

    public function isKoordinatorCabang(): bool
    {
        return $this->role === 'koordinator_cabang';
    }

    public function isKaderLapangan(): bool
    {
        return $this->role === 'kader_lapangan';
    }

    public function isPenggunaUmum(): bool
    {
        return $this->role === 'pengguna_umum';
    }
}
