<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harvest extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'officer_id',
        'weight_kg',
        'harvest_date',
        'verification_status',
        'verified_by',
        'verified_at',
        'notes',
        'image',
        'no_spk',
    ];

    protected $casts = [
        'harvest_date' => 'date',
        'verified_at' => 'datetime',
        'weight_kg' => 'decimal:2',
    ];

    /**
     * Get the block for this harvest.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Get the officer who recorded this harvest.
     */
    public function officer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    /**
     * Get the admin who verified this harvest.
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if harvest is pending verification.
     */
    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    /**
     * Check if harvest is verified.
     */
    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    /**
     * Check if harvest is rejected.
     */
    public function isRejected(): bool
    {
        return $this->verification_status === 'rejected';
    }

    /**
     * Scope for pending harvests.
     */
    public function scopePending($query)
    {
        return $query->where('verification_status', 'pending');
    }

    /**
     * Scope for verified harvests.
     */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    /**
     * Scope for today's harvests.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('harvest_date', today());
    }

    /**
     * Scope for this month's harvests.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('harvest_date', now()->month)
            ->whereYear('harvest_date', now()->year);
    }
}
