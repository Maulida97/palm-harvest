<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'code',
        'name',
        'area_hectares',
        'tree_count',
        'status',
        'description',
    ];

    /**
     * Get the division that owns this block.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get all harvests for this block.
     */
    public function harvests(): HasMany
    {
        return $this->hasMany(Harvest::class);
    }

    /**
     * Check if block is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get total harvest weight for this block.
     */
    public function getTotalHarvestAttribute(): float
    {
        return $this->harvests()->sum('weight_kg');
    }

    /**
     * Get today's harvest weight for this block.
     */
    public function getTodayHarvestAttribute(): float
    {
        return $this->harvests()
            ->whereDate('harvest_date', today())
            ->sum('weight_kg');
    }
}
