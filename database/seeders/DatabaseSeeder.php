<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure the user is created only if it does not exist
        User::updateOrCreate(
            ['email' => 'test@example.com'], // Check for existing email
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'), // Add a hashed password
            ]
        );

        // Seed Employees and Tasks
        $this->call([
            EmployeeSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
