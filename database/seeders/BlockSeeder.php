<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = [
            ['code' => 'A-01', 'name' => 'Blok Utara 1', 'area_hectares' => 25.5, 'status' => 'active'],
            ['code' => 'A-02', 'name' => 'Blok Utara 2', 'area_hectares' => 30.0, 'status' => 'active'],
            ['code' => 'A-03', 'name' => 'Blok Utara 3', 'area_hectares' => 28.5, 'status' => 'active'],
            ['code' => 'B-01', 'name' => 'Blok Selatan 1', 'area_hectares' => 22.0, 'status' => 'active'],
            ['code' => 'B-02', 'name' => 'Blok Selatan 2', 'area_hectares' => 35.0, 'status' => 'active'],
            ['code' => 'B-03', 'name' => 'Blok Selatan 3', 'area_hectares' => 20.0, 'status' => 'active'],
            ['code' => 'C-01', 'name' => 'Blok Timur 1', 'area_hectares' => 40.0, 'status' => 'active'],
            ['code' => 'C-02', 'name' => 'Blok Timur 2', 'area_hectares' => 32.0, 'status' => 'active'],
            ['code' => 'D-01', 'name' => 'Blok Barat 1', 'area_hectares' => 18.0, 'status' => 'inactive'],
            ['code' => 'D-02', 'name' => 'Blok Barat 2', 'area_hectares' => 15.0, 'status' => 'inactive'],
            ['code' => 'E-01', 'name' => 'Blok Tengah 1', 'area_hectares' => 50.0, 'status' => 'active'],
            ['code' => 'E-02', 'name' => 'Blok Tengah 2', 'area_hectares' => 45.0, 'status' => 'active'],
        ];

        foreach ($blocks as $block) {
            Block::create($block);
        }
    }
}
