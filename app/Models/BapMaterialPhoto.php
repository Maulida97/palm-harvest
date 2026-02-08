<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BapMaterialPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'bap_material_id',
        'type',
        'photo_path',
    ];

    public function bapMaterial()
    {
        return $this->belongsTo(BapMaterial::class);
    }
}
