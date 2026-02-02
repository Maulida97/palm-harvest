<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Harvest;
use App\Models\User;
use Illuminate\Database\Seeder;

class HarvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officers = User::where('role', 'officer')->get();
        $blocks = Block::where('status', 'active')->get();
        $admin = User::where('role', 'admin')->first();

        // Generate harvest data for the last 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            // Generate 3-6 entries per day
            $entriesPerDay = rand(3, 6);
            
            for ($j = 0; $j < $entriesPerDay; $j++) {
                $officer = $officers->random();
                $block = $blocks->random();
                $weight = rand(500, 2000) + (rand(0, 99) / 100);
                
                $isVerified = $i > 1 || rand(0, 1); // Most older entries are verified
                
                Harvest::create([
                    'block_id' => $block->id,
                    'officer_id' => $officer->id,
                    'weight_kg' => $weight,
                    'harvest_date' => $date,
                    'verification_status' => $isVerified ? 'verified' : 'pending',
                    'verified_by' => $isVerified ? $admin->id : null,
                    'verified_at' => $isVerified ? $date->addHours(rand(1, 8)) : null,
                    'notes' => rand(0, 3) === 0 ? 'Kondisi cuaca cerah, hasil panen optimal.' : null,
                ]);
            }
        }
    }
}
