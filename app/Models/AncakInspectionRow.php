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
        'apd_status',
        'fine_amount',
    ];

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(AncakInspection::class, 'ancak_inspection_id');
    }
}
