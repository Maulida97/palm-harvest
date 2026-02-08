<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AncakInspectionRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'ancak_inspection_id',
        'row_number',
        'harvester_name',
        'ancak_location',
        'bunch_count',
        'bt_pkk',
        'tph_number',
        'tph_status',
        'apd_status',
        'fine_amount',
        'fine_category_id',
        'fine_count',
        'fine_pemanen',
        'fine_kerani_panen',
        'fine_mandor_panen',
        'fine_mandor_1',
        'fine_asisten',
    ];

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(AncakInspection::class, 'ancak_inspection_id');
    }
}
