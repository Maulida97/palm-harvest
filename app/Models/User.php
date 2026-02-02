<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_photo',
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
        ];
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is an officer.
     */
    public function isOfficer(): bool
    {
        return $this->role === 'officer';
    }

    /**
     * Get harvests recorded by this officer.
     */
    public function harvests(): HasMany
    {
        return $this->hasMany(Harvest::class, 'officer_id');
    }

    /**
     * Get harvests verified by this admin.
     */
    public function verifiedHarvests(): HasMany
    {
        return $this->hasMany(Harvest::class, 'verified_by');
    }

    /**
     * Get today's harvest total for this officer.
     */
    public function getTodayHarvestTotalAttribute(): float
    {
        return $this->harvests()
            ->whereDate('harvest_date', today())
            ->sum('weight_kg');
    }

    /**
     * Get this month's harvest total for this officer.
     */
    public function getMonthHarvestTotalAttribute(): float
    {
        return $this->harvests()
            ->whereMonth('harvest_date', now()->month)
            ->whereYear('harvest_date', now()->year)
            ->sum('weight_kg');
    }
}
