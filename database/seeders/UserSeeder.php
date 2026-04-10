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
        User::updateOrCreate(
            ['email' => 'admin@palmharvest.co'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567890',
            ]
        );

        // Create Officers
        $officers = [
            ['name' => 'Siti Aminah', 'username' => 'siti', 'email' => 'siti@palmharvest.co'],
            ['name' => 'Joko Widodo', 'username' => 'joko', 'email' => 'joko@palmharvest.co'],
            ['name' => 'Dewi Lestari', 'username' => 'dewi', 'email' => 'dewi@palmharvest.co'],
        ];

        foreach ($officers as $officer) {
            User::updateOrCreate(
                ['email' => $officer['email']],
                [
                    'name' => $officer['name'],
                    'username' => $officer['username'],
                    'password' => Hash::make('password'),
                    'role' => 'officer',
                ]
            );
        }
    }
}
