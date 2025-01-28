<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'password' => Hash::make('John123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'smith@example.com',
                'phone' => '0987654321',
                'password' => Hash::make('Smith123'),
            ],
            [
                'name' => 'Sam Wilson',
                'email' => 'sam@example.com',
                'phone' => '1122334455',
                'password' => Hash::make('Sam123'),
            ],
        ];

        // Insert each employee into the database
        foreach ($employees as $employee) {
            Employee::updateOrCreate(
                ['email' => $employee['email']], // Check for existing email
                ['name' => $employee['name'], 'phone' => $employee['phone'], 'password' => $employee['password']]
            );
        }
    }
}