<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternalMemo extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'no_item',
        'berlaku',
        'tidak_berlaku',
        'tanggal_revisi',
        'file_path',
        'created_by',
    ];

    protected $casts = [
        'berlaku' => 'date',
        'tidak_berlaku' => 'date',
        'tanggal_revisi' => 'date',
    ];

    /**
     * Get the user who created the memo.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for Agronomi type.
     */
    public function scopeAgronomi($query)
    {
        return $query->where('type', 'agronomi');
    }

    /**
     * Scope for Pabrik type.
     */
    public function scopePabrik($query)
    {
        return $query->where('type', 'pabrik');
    }

    /**
     * Check if memo is still active (berlaku).
     */
    public function isActive(): bool
    {
        $today = now()->startOfDay();
        return $today->gte($this->berlaku) && 
               ($this->tidak_berlaku === null || $today->lte($this->tidak_berlaku));
    }
}
