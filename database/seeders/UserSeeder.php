<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@dealership.com'],
            [
                'name'              => 'Admin User',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'staff@dealership.com'],
            [
                'name'              => 'Jane Smith',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 8 additional random users
        User::factory()->count(8)->create();
    }
}
