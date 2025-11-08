<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Test User
        User::create([
            'name' => 'Test User',
            'email' => 'test@ott.com',
            'phone' => '+1234567890',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ott.com',
            'phone' => '+1234567891',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        $this->command->info('Test users created successfully!');
        $this->command->info('Email: test@ott.com | Password: password123');
        $this->command->info('Email: admin@ott.com | Password: admin123');

        // Seed Content
        $this->call(ContentSeeder::class);
    }
}
