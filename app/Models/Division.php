<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    /**
     * Get all blocks for this division
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }

    /**
     * Scope for active divisions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get total area of all blocks in this division
     */
    public function getTotalAreaAttribute(): float
    {
        return $this->blocks()->sum('area_hectares') ?? 0;
    }

    /**
     * Get total tree count of all blocks in this division
     */
    public function getTotalTreesAttribute(): int
    {
        return $this->blocks()->sum('tree_count') ?? 0;
    }
}
