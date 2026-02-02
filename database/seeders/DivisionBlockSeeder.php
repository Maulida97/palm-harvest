<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Divisi 1
        $divisi1 = Division::firstOrCreate(
            ['code' => 'DIV-1'],
            ['name' => 'Divisi 1', 'status' => 'active']
        );

        // Data blok Divisi 1
        $blocks1 = [
            ['code' => 'F4-3', 'name' => 'F4-3', 'area_hectares' => 13.52, 'tree_count' => 1806],
            ['code' => 'F4-4', 'name' => 'F4-4', 'area_hectares' => 16.93, 'tree_count' => 2298],
            ['code' => 'F4-5', 'name' => 'F4-5', 'area_hectares' => 23.41, 'tree_count' => 3301],
            ['code' => 'F5-2', 'name' => 'F5-2', 'area_hectares' => 24.84, 'tree_count' => 3128],
            ['code' => 'F5-3', 'name' => 'F5-3', 'area_hectares' => 26.97, 'tree_count' => 3546],
            ['code' => 'F5-4', 'name' => 'F5-4', 'area_hectares' => 27.34, 'tree_count' => 3544],
            ['code' => 'F5-5', 'name' => 'F5-5', 'area_hectares' => 28.98, 'tree_count' => 3685],
            ['code' => 'F6-2', 'name' => 'F6-2', 'area_hectares' => 28.88, 'tree_count' => 3651],
            ['code' => 'F6-3', 'name' => 'F6-3', 'area_hectares' => 25.21, 'tree_count' => 3076],
            ['code' => 'F6-4', 'name' => 'F6-4', 'area_hectares' => 26.61, 'tree_count' => 3766],
            ['code' => 'F6-1A', 'name' => 'F6-1A', 'area_hectares' => 17.89, 'tree_count' => 2520],
            ['code' => 'ZF4-6', 'name' => 'ZF4-6', 'area_hectares' => 22.87, 'tree_count' => 3045],
            ['code' => 'F5-1A', 'name' => 'F5-1A', 'area_hectares' => 10.89, 'tree_count' => 1170],
            ['code' => 'ZF4-7', 'name' => 'ZF4-7', 'area_hectares' => 25.51, 'tree_count' => 3636],
            ['code' => 'ZF4-8', 'name' => 'ZF4-8', 'area_hectares' => 31.47, 'tree_count' => 4907],
            ['code' => 'ZF5-7', 'name' => 'ZF5-7', 'area_hectares' => 28.49, 'tree_count' => 3726],
            ['code' => 'ZF5-6', 'name' => 'ZF5-6', 'area_hectares' => 28.29, 'tree_count' => 4115],
            ['code' => 'ZF5-8', 'name' => 'ZF5-8', 'area_hectares' => 29.01, 'tree_count' => 3753],
            ['code' => 'ZG5-1A', 'name' => 'ZG5-1A', 'area_hectares' => 13.32, 'tree_count' => 1800],
            ['code' => 'ZG5-2A', 'name' => 'ZG5-2A', 'area_hectares' => 9.63, 'tree_count' => 1282],
            ['code' => 'ZG4-1', 'name' => 'ZG4-1', 'area_hectares' => 21.18, 'tree_count' => 3210],
            ['code' => 'ZG4-2', 'name' => 'ZG4-2', 'area_hectares' => 19.52, 'tree_count' => 2519],
            ['code' => 'YF5-1', 'name' => 'YF5-1', 'area_hectares' => 4.13, 'tree_count' => 600],
            ['code' => 'F6-1B', 'name' => 'F6-1B', 'area_hectares' => 3.15, 'tree_count' => 395],
            ['code' => 'ZG5-1B', 'name' => 'ZG5-1B', 'area_hectares' => 13.85, 'tree_count' => 1907],
            ['code' => 'ZG5-2B', 'name' => 'ZG5-2B', 'area_hectares' => 25.42, 'tree_count' => 3659],
        ];

        foreach ($blocks1 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi1->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 2
        $divisi2 = Division::firstOrCreate(
            ['code' => 'DIV-2'],
            ['name' => 'Divisi 2', 'status' => 'active']
        );

        // Data blok Divisi 2
        $blocks2 = [
            ['code' => 'E7-4', 'name' => 'E7-4', 'area_hectares' => 27.53, 'tree_count' => 3686],
            ['code' => 'E7-5', 'name' => 'E7-5', 'area_hectares' => 31.64, 'tree_count' => 4267],
            ['code' => 'E7-6', 'name' => 'E7-6', 'area_hectares' => 30.37, 'tree_count' => 3816],
            ['code' => 'E7-7', 'name' => 'E7-7', 'area_hectares' => 30.87, 'tree_count' => 4427],
            ['code' => 'E7-8', 'name' => 'E7-8', 'area_hectares' => 32.65, 'tree_count' => 4297],
            ['code' => 'E7-3', 'name' => 'E7-3', 'area_hectares' => 35.85, 'tree_count' => 4385],
            ['code' => 'E7-1', 'name' => 'E7-1', 'area_hectares' => 32.82, 'tree_count' => 3081],
            ['code' => 'E7-2', 'name' => 'E7-2', 'area_hectares' => 34.95, 'tree_count' => 4207],
            ['code' => 'E6-1', 'name' => 'E6-1', 'area_hectares' => 33.25, 'tree_count' => 3975],
            ['code' => 'E6-2', 'name' => 'E6-2', 'area_hectares' => 29.56, 'tree_count' => 3690],
            ['code' => 'E6-3', 'name' => 'E6-3', 'area_hectares' => 40.07, 'tree_count' => 4920],
            ['code' => 'E6-4', 'name' => 'E6-4', 'area_hectares' => 14.99, 'tree_count' => 1926],
            ['code' => 'E6-5', 'name' => 'E6-5', 'area_hectares' => 20.07, 'tree_count' => 2213],
            ['code' => 'E6-6', 'name' => 'E6-6', 'area_hectares' => 28.71, 'tree_count' => 1835],
            ['code' => 'E6-7', 'name' => 'E6-7', 'area_hectares' => 21.23, 'tree_count' => 1597],
            ['code' => 'E6-8A', 'name' => 'E6-8A', 'area_hectares' => 25.34, 'tree_count' => 2096],
            ['code' => 'E6-8B', 'name' => 'E6-8B', 'area_hectares' => 6.28, 'tree_count' => 788],
            ['code' => 'E8-2', 'name' => 'E8-2', 'area_hectares' => 10.66, 'tree_count' => 1278],
            ['code' => 'E8-4', 'name' => 'E8-4', 'area_hectares' => 21.96, 'tree_count' => 2491],
            ['code' => 'E8-5', 'name' => 'E8-5', 'area_hectares' => 24.23, 'tree_count' => 2539],
            ['code' => 'E8-6', 'name' => 'E8-6', 'area_hectares' => 21.88, 'tree_count' => 2480],
            ['code' => 'E8-7', 'name' => 'E8-7', 'area_hectares' => 20.54, 'tree_count' => 1877],
            ['code' => 'E8-8', 'name' => 'E8-8', 'area_hectares' => 20.41, 'tree_count' => 1829],
            ['code' => 'E8-1', 'name' => 'E8-1', 'area_hectares' => 29.05, 'tree_count' => 3350],
            ['code' => 'E8-3', 'name' => 'E8-3', 'area_hectares' => 26.40, 'tree_count' => 1455],
            ['code' => 'YE9-2', 'name' => 'YE9-2', 'area_hectares' => 16.94, 'tree_count' => 2041],
            ['code' => 'YE9-3', 'name' => 'YE9-3', 'area_hectares' => 11.08, 'tree_count' => 1585],
            ['code' => 'YE9-4', 'name' => 'YE9-4', 'area_hectares' => 8.57, 'tree_count' => 1237],
            ['code' => 'YE9-5', 'name' => 'YE9-5', 'area_hectares' => 10.40, 'tree_count' => 1137],
        ];

        foreach ($blocks2 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi2->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 3
        $divisi3 = Division::firstOrCreate(
            ['code' => 'DIV-3'],
            ['name' => 'Divisi 3', 'status' => 'active']
        );

        // Data blok Divisi 3
        $blocks3 = [
            ['code' => 'D11-1', 'name' => 'D11-1', 'area_hectares' => 29.19, 'tree_count' => 3837],
            ['code' => 'D11-2', 'name' => 'D11-2', 'area_hectares' => 31.79, 'tree_count' => 4204],
            ['code' => 'D12-1', 'name' => 'D12-1', 'area_hectares' => 30.04, 'tree_count' => 4160],
            ['code' => 'D12-2', 'name' => 'D12-2', 'area_hectares' => 35.82, 'tree_count' => 4657],
            ['code' => 'D12-3', 'name' => 'D12-3', 'area_hectares' => 32.28, 'tree_count' => 4378],
            ['code' => 'D12-4', 'name' => 'D12-4', 'area_hectares' => 30.14, 'tree_count' => 3993],
            ['code' => 'D12-5', 'name' => 'D12-5', 'area_hectares' => 32.05, 'tree_count' => 4166],
            ['code' => 'D12-6', 'name' => 'D12-6', 'area_hectares' => 31.52, 'tree_count' => 4224],
            ['code' => 'D11-3', 'name' => 'D11-3', 'area_hectares' => 32.34, 'tree_count' => 4183],
            ['code' => 'D11-4', 'name' => 'D11-4', 'area_hectares' => 30.24, 'tree_count' => 3818],
            ['code' => 'D12-7', 'name' => 'D12-7', 'area_hectares' => 30.86, 'tree_count' => 3554],
            ['code' => 'D12-8', 'name' => 'D12-8', 'area_hectares' => 32.59, 'tree_count' => 4083],
            ['code' => 'D10-1', 'name' => 'D10-1', 'area_hectares' => 17.22, 'tree_count' => 1620],
            ['code' => 'D10-4', 'name' => 'D10-4', 'area_hectares' => 18.91, 'tree_count' => 2455],
            ['code' => 'D10-5', 'name' => 'D10-5', 'area_hectares' => 27.52, 'tree_count' => 1555],
            ['code' => 'D10-6', 'name' => 'D10-6', 'area_hectares' => 13.06, 'tree_count' => 1217],
            ['code' => 'D10-7', 'name' => 'D10-7', 'area_hectares' => 8.40, 'tree_count' => 750],
            ['code' => 'D11-5', 'name' => 'D11-5', 'area_hectares' => 32.59, 'tree_count' => 4452],
            ['code' => 'D11-6', 'name' => 'D11-6', 'area_hectares' => 31.60, 'tree_count' => 4306],
            ['code' => 'D11-7', 'name' => 'D11-7', 'area_hectares' => 31.59, 'tree_count' => 4030],
            ['code' => 'D11-8', 'name' => 'D11-8', 'area_hectares' => 32.14, 'tree_count' => 4081],
            ['code' => 'YD10-2', 'name' => 'YD10-2', 'area_hectares' => 19.74, 'tree_count' => 2187],
            ['code' => 'YD10-3', 'name' => 'YD10-3', 'area_hectares' => 14.75, 'tree_count' => 1688],
            ['code' => 'YD10-7', 'name' => 'YD10-7', 'area_hectares' => 3.77, 'tree_count' => 465],
        ];

        foreach ($blocks3 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi3->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 4
        $divisi4 = Division::firstOrCreate(
            ['code' => 'DIV-4'],
            ['name' => 'Divisi 4', 'status' => 'active']
        );

        // Data blok Divisi 4
        $blocks4 = [
            ['code' => 'C10-1', 'name' => 'C10-1', 'area_hectares' => 34.06, 'tree_count' => 4849],
            ['code' => 'C10-2', 'name' => 'C10-2', 'area_hectares' => 26.11, 'tree_count' => 3302],
            ['code' => 'C6-1', 'name' => 'C6-1', 'area_hectares' => 32.39, 'tree_count' => 4383],
            ['code' => 'C7-1', 'name' => 'C7-1', 'area_hectares' => 31.50, 'tree_count' => 4215],
            ['code' => 'C7-2', 'name' => 'C7-2', 'area_hectares' => 3.41, 'tree_count' => 432],
            ['code' => 'C8-1', 'name' => 'C8-1', 'area_hectares' => 32.15, 'tree_count' => 4588],
            ['code' => 'C8-2', 'name' => 'C8-2', 'area_hectares' => 14.56, 'tree_count' => 1893],
            ['code' => 'C9-1', 'name' => 'C9-1', 'area_hectares' => 32.02, 'tree_count' => 4460],
            ['code' => 'C9-2', 'name' => 'C9-2', 'area_hectares' => 23.97, 'tree_count' => 3052],
            ['code' => 'ZB10-2', 'name' => 'ZB10-2', 'area_hectares' => 35.26, 'tree_count' => 5013],
            ['code' => 'ZB6-2', 'name' => 'ZB6-2', 'area_hectares' => 39.47, 'tree_count' => 5460],
            ['code' => 'ZB9-2', 'name' => 'ZB9-2', 'area_hectares' => 32.26, 'tree_count' => 4645],
            ['code' => 'C5-1', 'name' => 'C5-1', 'area_hectares' => 38.61, 'tree_count' => 5605],
            ['code' => 'ZB3-2', 'name' => 'ZB3-2', 'area_hectares' => 12.15, 'tree_count' => 1788],
            ['code' => 'ZB4-2', 'name' => 'ZB4-2', 'area_hectares' => 33.23, 'tree_count' => 4913],
            ['code' => 'ZB5-2', 'name' => 'ZB5-2', 'area_hectares' => 38.51, 'tree_count' => 5558],
            ['code' => 'ZB7-1', 'name' => 'ZB7-1', 'area_hectares' => 16.25, 'tree_count' => 2270],
            ['code' => 'ZB7-2', 'name' => 'ZB7-2', 'area_hectares' => 27.59, 'tree_count' => 4027],
            ['code' => 'ZB8-2', 'name' => 'ZB8-2', 'area_hectares' => 31.08, 'tree_count' => 4460],
            ['code' => 'C4-1', 'name' => 'C4-1', 'area_hectares' => 17.13, 'tree_count' => 2192],
            ['code' => 'C10-8', 'name' => 'C10-8', 'area_hectares' => 18.81, 'tree_count' => 2462],
            ['code' => 'YC3-1', 'name' => 'YC3-1', 'area_hectares' => 27.27, 'tree_count' => 3171],
            ['code' => 'YC5-2', 'name' => 'YC5-2', 'area_hectares' => 9.32, 'tree_count' => 1060],
            ['code' => 'YC6-2', 'name' => 'YC6-2', 'area_hectares' => 14.55, 'tree_count' => 2020],
            ['code' => 'YC8-2', 'name' => 'YC8-2', 'area_hectares' => 7.61, 'tree_count' => 809],
            ['code' => 'YC9-2', 'name' => 'YC9-2', 'area_hectares' => 2.12, 'tree_count' => 278],
            ['code' => 'YC7-2', 'name' => 'YC7-2', 'area_hectares' => 13.08, 'tree_count' => 1367],
        ];

        foreach ($blocks4 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi4->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 5
        $divisi5 = Division::firstOrCreate(
            ['code' => 'DIV-5'],
            ['name' => 'Divisi 5', 'status' => 'active']
        );

        // Data blok Divisi 5
        $blocks5 = [
            ['code' => 'C11-1', 'name' => 'C11-1', 'area_hectares' => 32.20, 'tree_count' => 4221],
            ['code' => 'C11-2', 'name' => 'C11-2', 'area_hectares' => 31.09, 'tree_count' => 4059],
            ['code' => 'C11-3', 'name' => 'C11-3', 'area_hectares' => 32.81, 'tree_count' => 4232],
            ['code' => 'C11-4', 'name' => 'C11-4', 'area_hectares' => 31.89, 'tree_count' => 4132],
            ['code' => 'C11-5', 'name' => 'C11-5', 'area_hectares' => 31.25, 'tree_count' => 4049],
            ['code' => 'C11-6', 'name' => 'C11-6', 'area_hectares' => 33.93, 'tree_count' => 4317],
            ['code' => 'C11-7', 'name' => 'C11-7', 'area_hectares' => 33.73, 'tree_count' => 4392],
            ['code' => 'C12-3', 'name' => 'C12-3', 'area_hectares' => 33.70, 'tree_count' => 4323],
            ['code' => 'C12-4', 'name' => 'C12-4', 'area_hectares' => 30.09, 'tree_count' => 3731],
            ['code' => 'C12-5', 'name' => 'C12-5', 'area_hectares' => 30.60, 'tree_count' => 3954],
            ['code' => 'C12-6', 'name' => 'C12-6', 'area_hectares' => 34.02, 'tree_count' => 4517],
            ['code' => 'C11-8', 'name' => 'C11-8', 'area_hectares' => 29.22, 'tree_count' => 3857],
            ['code' => 'C12-1', 'name' => 'C12-1', 'area_hectares' => 32.95, 'tree_count' => 4278],
            ['code' => 'C12-2', 'name' => 'C12-2', 'area_hectares' => 28.50, 'tree_count' => 3603],
            ['code' => 'C12-7', 'name' => 'C12-7', 'area_hectares' => 31.84, 'tree_count' => 4038],
            ['code' => 'C12-8', 'name' => 'C12-8', 'area_hectares' => 31.33, 'tree_count' => 4551],
            ['code' => 'C13-1', 'name' => 'C13-1', 'area_hectares' => 33.51, 'tree_count' => 4618],
            ['code' => 'C13-2', 'name' => 'C13-2', 'area_hectares' => 28.31, 'tree_count' => 3667],
            ['code' => 'C13-5', 'name' => 'C13-5', 'area_hectares' => 30.85, 'tree_count' => 4019],
            ['code' => 'C13-6', 'name' => 'C13-6', 'area_hectares' => 35.74, 'tree_count' => 4550],
            ['code' => 'C13-7', 'name' => 'C13-7', 'area_hectares' => 32.04, 'tree_count' => 3923],
            ['code' => 'C13-8', 'name' => 'C13-8', 'area_hectares' => 32.55, 'tree_count' => 4046],
        ];

        foreach ($blocks5 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi5->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 6
        $divisi6 = Division::firstOrCreate(
            ['code' => 'DIV-6'],
            ['name' => 'Divisi 6', 'status' => 'active']
        );

        // Data blok Divisi 6
        $blocks6 = [
            ['code' => 'ZB11-5', 'name' => 'ZB11-5', 'area_hectares' => 32.81, 'tree_count' => 4552],
            ['code' => 'ZB11-6', 'name' => 'ZB11-6', 'area_hectares' => 33.02, 'tree_count' => 4689],
            ['code' => 'ZB11-7', 'name' => 'ZB11-7', 'area_hectares' => 32.72, 'tree_count' => 4571],
            ['code' => 'ZB11-8', 'name' => 'ZB11-8', 'area_hectares' => 32.76, 'tree_count' => 4690],
            ['code' => 'ZB12-7', 'name' => 'ZB12-7', 'area_hectares' => 31.60, 'tree_count' => 4533],
            ['code' => 'ZB12-8', 'name' => 'ZB12-8', 'area_hectares' => 32.66, 'tree_count' => 4625],
            ['code' => 'A13-3', 'name' => 'A13-3', 'area_hectares' => 22.67, 'tree_count' => 3063],
            ['code' => 'A13-4', 'name' => 'A13-4', 'area_hectares' => 19.97, 'tree_count' => 2685],
            ['code' => 'A13-5', 'name' => 'A13-5', 'area_hectares' => 21.87, 'tree_count' => 2940],
            ['code' => 'B12-2', 'name' => 'B12-2', 'area_hectares' => 25.33, 'tree_count' => 3432],
            ['code' => 'B12-3', 'name' => 'B12-3', 'area_hectares' => 18.49, 'tree_count' => 2476],
            ['code' => 'B12-4', 'name' => 'B12-4', 'area_hectares' => 18.36, 'tree_count' => 2399],
            ['code' => 'B12-5', 'name' => 'B12-5', 'area_hectares' => 17.15, 'tree_count' => 2412],
            ['code' => 'B13-1', 'name' => 'B13-1', 'area_hectares' => 22.67, 'tree_count' => 2992],
            ['code' => 'B13-2', 'name' => 'B13-2', 'area_hectares' => 25.96, 'tree_count' => 3438],
            ['code' => 'B13-3', 'name' => 'B13-3', 'area_hectares' => 36.27, 'tree_count' => 4863],
            ['code' => 'B13-4', 'name' => 'B13-4', 'area_hectares' => 34.11, 'tree_count' => 4795],
            ['code' => 'B13-5', 'name' => 'B13-5', 'area_hectares' => 32.78, 'tree_count' => 4600],
            ['code' => 'ZB12-2', 'name' => 'ZB12-2', 'area_hectares' => 15.06, 'tree_count' => 1954],
            ['code' => 'ZB12-3', 'name' => 'ZB12-3', 'area_hectares' => 16.43, 'tree_count' => 2159],
            ['code' => 'ZB12-4', 'name' => 'ZB12-4', 'area_hectares' => 14.68, 'tree_count' => 1822],
            ['code' => 'ZB12-5', 'name' => 'ZB12-5', 'area_hectares' => 14.65, 'tree_count' => 2019],
            ['code' => 'ZB12-6', 'name' => 'ZB12-6', 'area_hectares' => 31.23, 'tree_count' => 4477],
            ['code' => 'ZB13-6', 'name' => 'ZB13-6', 'area_hectares' => 31.21, 'tree_count' => 4197],
            ['code' => 'ZB13-7', 'name' => 'ZB13-7', 'area_hectares' => 31.94, 'tree_count' => 4384],
            ['code' => 'ZB13-8', 'name' => 'ZB13-8', 'area_hectares' => 33.82, 'tree_count' => 4185],
        ];

        foreach ($blocks6 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi6->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 7
        $divisi7 = Division::firstOrCreate(
            ['code' => 'DIV-7'],
            ['name' => 'Divisi 7', 'status' => 'active']
        );

        // Data blok Divisi 7
        $blocks7 = [
            ['code' => 'A14-3', 'name' => 'A14-3', 'area_hectares' => 33.47, 'tree_count' => 4552],
            ['code' => 'A14-4', 'name' => 'A14-4', 'area_hectares' => 28.24, 'tree_count' => 3765],
            ['code' => 'B14-2', 'name' => 'B14-2', 'area_hectares' => 37.06, 'tree_count' => 4542],
            ['code' => 'A14-5', 'name' => 'A14-5', 'area_hectares' => 31.44, 'tree_count' => 3921],
            ['code' => 'B14-1', 'name' => 'B14-1', 'area_hectares' => 32.58, 'tree_count' => 4153],
            ['code' => 'B14-4', 'name' => 'B14-4', 'area_hectares' => 34.85, 'tree_count' => 4663],
            ['code' => 'B15-1', 'name' => 'B15-1', 'area_hectares' => 30.95, 'tree_count' => 3640],
            ['code' => 'B15-2', 'name' => 'B15-2', 'area_hectares' => 36.45, 'tree_count' => 4478],
            ['code' => 'B15-3', 'name' => 'B15-3', 'area_hectares' => 33.96, 'tree_count' => 4465],
            ['code' => 'B15-4', 'name' => 'B15-4', 'area_hectares' => 34.30, 'tree_count' => 4560],
            ['code' => 'B14-3', 'name' => 'B14-3', 'area_hectares' => 38.36, 'tree_count' => 5146],
            ['code' => 'B16-1', 'name' => 'B16-1', 'area_hectares' => 23.77, 'tree_count' => 3352],
            ['code' => 'B16-2', 'name' => 'B16-2', 'area_hectares' => 21.98, 'tree_count' => 3119],
            ['code' => 'B16-3', 'name' => 'B16-3', 'area_hectares' => 32.33, 'tree_count' => 4580],
            ['code' => 'B16-4', 'name' => 'B16-4', 'area_hectares' => 27.64, 'tree_count' => 3935],
            ['code' => 'B17-2', 'name' => 'B17-2', 'area_hectares' => 19.66, 'tree_count' => 2561],
            ['code' => 'B17-3', 'name' => 'B17-3', 'area_hectares' => 18.77, 'tree_count' => 2564],
            ['code' => 'B17-4', 'name' => 'B17-4', 'area_hectares' => 19.16, 'tree_count' => 2703],
            ['code' => 'A15-1B', 'name' => 'A15-1B', 'area_hectares' => 6.91, 'tree_count' => 981],
            ['code' => 'A17-1', 'name' => 'A17-1', 'area_hectares' => 11.03, 'tree_count' => 1494],
            ['code' => 'A17-2', 'name' => 'A17-2', 'area_hectares' => 23.84, 'tree_count' => 3148],
            ['code' => 'A17-3', 'name' => 'A17-3', 'area_hectares' => 17.61, 'tree_count' => 2478],
            ['code' => 'A17-4', 'name' => 'A17-4', 'area_hectares' => 19.06, 'tree_count' => 2744],
            ['code' => 'A17-5', 'name' => 'A17-5', 'area_hectares' => 20.47, 'tree_count' => 2898],
            ['code' => 'B17-1', 'name' => 'B17-1', 'area_hectares' => 20.57, 'tree_count' => 2950],
            ['code' => 'A16-1', 'name' => 'A16-1', 'area_hectares' => 10.88, 'tree_count' => 1476],
            ['code' => 'A16-2', 'name' => 'A16-2', 'area_hectares' => 31.07, 'tree_count' => 4284],
            ['code' => 'A16-3', 'name' => 'A16-3', 'area_hectares' => 10.58, 'tree_count' => 1314],
            ['code' => 'A15-1A', 'name' => 'A15-1A', 'area_hectares' => 19.53, 'tree_count' => 3053],
        ];

        foreach ($blocks7 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi7->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 8
        $divisi8 = Division::firstOrCreate(
            ['code' => 'DIV-8'],
            ['name' => 'Divisi 8', 'status' => 'active']
        );

        // Data blok Divisi 8
        $blocks8 = [
            ['code' => 'B14-5', 'name' => 'B14-5', 'area_hectares' => 33.48, 'tree_count' => 4586],
            ['code' => 'C14-1', 'name' => 'C14-1', 'area_hectares' => 33.74, 'tree_count' => 4884],
            ['code' => 'C14-3', 'name' => 'C14-3', 'area_hectares' => 34.83, 'tree_count' => 4561],
            ['code' => 'C14-4', 'name' => 'C14-4', 'area_hectares' => 32.49, 'tree_count' => 4292],
            ['code' => 'B15-5', 'name' => 'B15-5', 'area_hectares' => 32.49, 'tree_count' => 4497],
            ['code' => 'B15-6', 'name' => 'B15-6', 'area_hectares' => 30.27, 'tree_count' => 4198],
            ['code' => 'B15-7', 'name' => 'B15-7', 'area_hectares' => 31.91, 'tree_count' => 4453],
            ['code' => 'B16-5', 'name' => 'B16-5', 'area_hectares' => 28.04, 'tree_count' => 3705],
            ['code' => 'B16-6', 'name' => 'B16-6', 'area_hectares' => 25.46, 'tree_count' => 3617],
            ['code' => 'B16-7', 'name' => 'B16-7', 'area_hectares' => 28.26, 'tree_count' => 3974],
            ['code' => 'B16-8', 'name' => 'B16-8', 'area_hectares' => 28.20, 'tree_count' => 4055],
            ['code' => 'B17-5', 'name' => 'B17-5', 'area_hectares' => 13.95, 'tree_count' => 1564],
            ['code' => 'B17-6', 'name' => 'B17-6', 'area_hectares' => 15.43, 'tree_count' => 1159],
            ['code' => 'B17-7', 'name' => 'B17-7', 'area_hectares' => 14.83, 'tree_count' => 1591],
            ['code' => 'B17-8', 'name' => 'B17-8', 'area_hectares' => 11.52, 'tree_count' => 1477],
            ['code' => 'B17-9', 'name' => 'B17-9', 'area_hectares' => 11.52, 'tree_count' => 1477],
            ['code' => 'C14-2A', 'name' => 'C14-2A', 'area_hectares' => 23.96, 'tree_count' => 2320],
            ['code' => 'C15-2', 'name' => 'C15-2', 'area_hectares' => 30.04, 'tree_count' => 4177],
            ['code' => 'C15-3', 'name' => 'C15-3', 'area_hectares' => 35.28, 'tree_count' => 4997],
            ['code' => 'C16-1', 'name' => 'C16-1', 'area_hectares' => 28.86, 'tree_count' => 4160],
            ['code' => 'C16-3', 'name' => 'C16-3', 'area_hectares' => 28.92, 'tree_count' => 3769],
            ['code' => 'C16-4', 'name' => 'C16-4', 'area_hectares' => 17.13, 'tree_count' => 2184],
            ['code' => 'C17-1', 'name' => 'C17-1', 'area_hectares' => 9.79, 'tree_count' => 1278],
            ['code' => 'C17-2', 'name' => 'C17-2', 'area_hectares' => 5.22, 'tree_count' => 667],
            ['code' => 'C17-3', 'name' => 'C17-3', 'area_hectares' => 2.69, 'tree_count' => 338],
            ['code' => 'ZB14-7', 'name' => 'ZB14-7', 'area_hectares' => 32.67, 'tree_count' => 4092],
            ['code' => 'ZB14-6', 'name' => 'ZB14-6', 'area_hectares' => 11.75, 'tree_count' => 1482],
            ['code' => 'C15-4', 'name' => 'C15-4', 'area_hectares' => 32.91, 'tree_count' => 4737],
            ['code' => 'B15-8A', 'name' => 'B15-8A', 'area_hectares' => 19.80, 'tree_count' => 2897],
            ['code' => 'B15-8B', 'name' => 'B15-8B', 'area_hectares' => 12.97, 'tree_count' => 1910],
            ['code' => 'C15-1A', 'name' => 'C15-1A', 'area_hectares' => 25.36, 'tree_count' => 3596],
            ['code' => 'C16-2', 'name' => 'C16-2', 'area_hectares' => 25.78, 'tree_count' => 3654],
            ['code' => 'C15-1B', 'name' => 'C15-1B', 'area_hectares' => 9.74, 'tree_count' => 1397],
            ['code' => 'ZB14-8A', 'name' => 'ZB14-8A', 'area_hectares' => 26.06, 'tree_count' => 3727],
            ['code' => 'ZB14-6B', 'name' => 'ZB14-6B', 'area_hectares' => 20.20, 'tree_count' => 2548],
            ['code' => 'ZB14-8B', 'name' => 'ZB14-8B', 'area_hectares' => 7.92, 'tree_count' => 1133],
            ['code' => 'C14-2B', 'name' => 'C14-2B', 'area_hectares' => 5.31, 'tree_count' => 725],
            ['code' => 'YC16-4', 'name' => 'YC16-4', 'area_hectares' => 4.52, 'tree_count' => 317],
        ];

        foreach ($blocks8 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi8->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 9
        $divisi9 = Division::firstOrCreate(
            ['code' => 'DIV-9'],
            ['name' => 'Divisi 9', 'status' => 'active']
        );

        // Data blok Divisi 9
        $blocks9 = [
            ['code' => 'C14-5', 'name' => 'C14-5', 'area_hectares' => 32.10, 'tree_count' => 4525],
            ['code' => 'C14-6', 'name' => 'C14-6', 'area_hectares' => 36.50, 'tree_count' => 4314],
            ['code' => 'C14-7A', 'name' => 'C14-7A', 'area_hectares' => 16.00, 'tree_count' => 2212],
            ['code' => 'C15-5', 'name' => 'C15-5', 'area_hectares' => 33.23, 'tree_count' => 4343],
            ['code' => 'C14-8', 'name' => 'C14-8', 'area_hectares' => 31.83, 'tree_count' => 4491],
            ['code' => 'C15-6', 'name' => 'C15-6', 'area_hectares' => 35.04, 'tree_count' => 3606],
            ['code' => 'D13-1', 'name' => 'D13-1', 'area_hectares' => 28.55, 'tree_count' => 3899],
            ['code' => 'D13-2', 'name' => 'D13-2', 'area_hectares' => 36.57, 'tree_count' => 4383],
            ['code' => 'D13-3', 'name' => 'D13-3', 'area_hectares' => 32.64, 'tree_count' => 4249],
            ['code' => 'D13-4', 'name' => 'D13-4', 'area_hectares' => 31.40, 'tree_count' => 3739],
            ['code' => 'D13-5', 'name' => 'D13-5', 'area_hectares' => 33.32, 'tree_count' => 3622],
            ['code' => 'D14-1', 'name' => 'D14-1', 'area_hectares' => 28.85, 'tree_count' => 3317],
            ['code' => 'D14-4', 'name' => 'D14-4', 'area_hectares' => 11.44, 'tree_count' => 1482],
            ['code' => 'C15-7', 'name' => 'C15-7', 'area_hectares' => 15.98, 'tree_count' => 2079],
            ['code' => 'C15-8', 'name' => 'C15-8', 'area_hectares' => 10.17, 'tree_count' => 1401],
            ['code' => 'C16-5', 'name' => 'C16-5', 'area_hectares' => 10.41, 'tree_count' => 1309],
            ['code' => 'C14-7B', 'name' => 'C14-7B', 'area_hectares' => 15.99, 'tree_count' => 2149],
            ['code' => 'D13-6', 'name' => 'D13-6', 'area_hectares' => 32.40, 'tree_count' => 3174],
            ['code' => 'D13-7', 'name' => 'D13-7', 'area_hectares' => 30.89, 'tree_count' => 3659],
            ['code' => 'D13-8', 'name' => 'D13-8', 'area_hectares' => 31.21, 'tree_count' => 2473],
            ['code' => 'D14-2', 'name' => 'D14-2', 'area_hectares' => 28.79, 'tree_count' => 2696],
            ['code' => 'D14-3', 'name' => 'D14-3', 'area_hectares' => 17.08, 'tree_count' => 1698],
            ['code' => 'C16-8', 'name' => 'C16-8', 'area_hectares' => 16.18, 'tree_count' => 2008],
            ['code' => 'YD15-4', 'name' => 'YD15-4', 'area_hectares' => 9.06, 'tree_count' => 1046],
            ['code' => 'YD15-5', 'name' => 'YD15-5', 'area_hectares' => 16.56, 'tree_count' => 2176],
        ];

        foreach ($blocks9 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi9->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }

        // Create Divisi 10
        $divisi10 = Division::firstOrCreate(
            ['code' => 'DIV-10'],
            ['name' => 'Divisi 10', 'status' => 'active']
        );

        // Data blok Divisi 10
        $blocks10 = [
            ['code' => 'F7-1', 'name' => 'F7-1', 'area_hectares' => 28.90, 'tree_count' => 3566],
            ['code' => 'F7-2', 'name' => 'F7-2', 'area_hectares' => 35.43, 'tree_count' => 4733],
            ['code' => 'F8-1', 'name' => 'F8-1', 'area_hectares' => 16.94, 'tree_count' => 1709],
            ['code' => 'F8-2', 'name' => 'F8-2', 'area_hectares' => 18.20, 'tree_count' => 2203],
            ['code' => 'F8-3', 'name' => 'F8-3', 'area_hectares' => 13.56, 'tree_count' => 1093],
            ['code' => 'F8-4', 'name' => 'F8-4', 'area_hectares' => 9.53, 'tree_count' => 1051],
            ['code' => 'F8-5', 'name' => 'F8-5', 'area_hectares' => 8.49, 'tree_count' => 944],
            ['code' => 'F8-6', 'name' => 'F8-6', 'area_hectares' => 4.94, 'tree_count' => 666],
            ['code' => 'F8-7', 'name' => 'F8-7', 'area_hectares' => 3.44, 'tree_count' => 423],
            ['code' => 'YF9-1', 'name' => 'YF9-1', 'area_hectares' => 8.45, 'tree_count' => 1032],
            ['code' => 'YF9-5', 'name' => 'YF9-5', 'area_hectares' => 14.27, 'tree_count' => 1573],
            ['code' => 'YG9-1', 'name' => 'YG9-1', 'area_hectares' => 22.71, 'tree_count' => 2700],
            ['code' => 'YG9-2', 'name' => 'YG9-2', 'area_hectares' => 13.21, 'tree_count' => 1498],
            ['code' => 'YG9-3', 'name' => 'YG9-3', 'area_hectares' => 13.43, 'tree_count' => 1119],
        ];

        foreach ($blocks10 as $blockData) {
            Block::updateOrCreate(
                ['code' => $blockData['code']],
                [
                    'division_id' => $divisi10->id,
                    'name' => $blockData['name'],
                    'area_hectares' => $blockData['area_hectares'],
                    'tree_count' => $blockData['tree_count'],
                    'status' => 'active',
                ]
            );
        }
    }
}
