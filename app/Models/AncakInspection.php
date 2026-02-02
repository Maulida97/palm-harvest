<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AncakInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'qc_name',
        'division_id',
        'block_id',
        'inspection_date',
        'planting_year',
        'seed_type',
        'sph',
        'foreman_name',
        'clerk_name',
        'findings',
        'response',
        'target_completion',
        'evidence_path',
        'status',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'target_completion' => 'date',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function rows(): HasMany
    {
        return $this->hasMany(AncakInspectionRow::class)->orderBy('row_number');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
