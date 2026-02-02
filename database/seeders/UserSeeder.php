<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@palmharvest.co',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Create Officers
        $officers = [
            ['name' => 'Budi Santoso', 'email' => 'budi@palmharvest.co', 'phone' => '081234567891'],
            ['name' => 'Siti Aminah', 'email' => 'siti@palmharvest.co', 'phone' => '081234567892'],
            ['name' => 'Joko Widodo', 'email' => 'joko@palmharvest.co', 'phone' => '081234567893'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@palmharvest.co', 'phone' => '081234567894'],
        ];

        foreach ($officers as $officer) {
            User::create([
                'name' => $officer['name'],
                'email' => $officer['email'],
                'password' => Hash::make('password'),
                'role' => 'officer',
                'phone' => $officer['phone'],
            ]);
        }
    }
}
