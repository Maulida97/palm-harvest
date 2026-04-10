<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizerSpotcheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'qc_name',
        'division_id',
        'block_id',
        'inspection_date',
        'fertilizer_id',
        'worker_name',
        'unapplied_kg',
        'penalty_amount',
        'findings',
        'evidence_path',
        'status',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'unapplied_kg' => 'decimal:2',
        'penalty_amount' => 'decimal:2',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function fertilizer()
    {
        return $this->belongsTo(Fertilizer::class);
    }
}
