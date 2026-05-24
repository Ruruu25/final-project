<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // You can set 'role' => 'customer', if your user system uses a role column
        ]);

        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
        ]);

        // Seed categories & products
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}