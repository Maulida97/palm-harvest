<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BapMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'qc_name',
        'jenis_material',
        'panjang',
        'lebar',
        'tinggi',
        'keterangan',
        'inspection_date',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'panjang' => 'decimal:2',
        'lebar' => 'decimal:2',
        'tinggi' => 'decimal:2',
    ];

    public function photos()
    {
        return $this->hasMany(BapMaterialPhoto::class);
    }

    public function dokumentasiPhotos()
    {
        return $this->hasMany(BapMaterialPhoto::class)->where('type', 'dokumentasi');
    }

    public function suratJalanPhotos()
    {
        return $this->hasMany(BapMaterialPhoto::class)->where('type', 'surat_jalan');
    }
}
