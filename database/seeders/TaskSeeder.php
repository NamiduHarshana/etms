<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'Description 1',
                'due_date' => now()->addDays(5),
                'status' => 'pending',
                'employee_id' => 1, // Assigned to employee with ID 1
            ],
            [
                'title' => 'Task 2',
                'description' => 'Description 2',
                'due_date' => now()->addDays(7),
                'status' => 'completed',
                'employee_id' => 2, // Assigned to employee with ID 2
            ],
            [
                'title' => 'Task 3',
                'description' => 'Description 3',
                'due_date' => now()->addDays(3),
                'status' => 'pending',
                'employee_id' => 3, // Assigned to employee with ID 3
            ],
            [
                'title' => 'Task 4',
                'description' => 'Description 4',
                'due_date' => now()->addDays(10),
                'status' => 'completed',
                'employee_id' => 1, // Assigned to employee with ID 1
            ],
            [
                'title' => 'Task 5',
                'description' => 'Description 5',
                'due_date' => now()->addDays(15),
                'status' => 'pending',
                'employee_id' => 2, // Assigned to employee with ID 2
            ],
        ];

        // Insert each task into the database
        foreach ($tasks as $task) {
            Task::updateOrCreate(
                ['title' => $task['title'], 'employee_id' => $task['employee_id']], // Match both title & employee_id
                ['description' => $task['description'], 'due_date' => $task['due_date'], 'status' => $task['status']]
            );
        }
    }
}
