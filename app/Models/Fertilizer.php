<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Fertilizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_kg',
        'status',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
    ];

    /**
     * Scope: only active fertilizers.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}
