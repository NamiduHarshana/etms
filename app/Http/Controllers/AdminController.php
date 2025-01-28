<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch tasks for the admin dashboard
        $tasks = Task::with('employee')->get(); // Fetch all tasks with associated employee
    
        // Task statistics
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $completedTasks = Task::where('status', 'completed')->count();
    
        // Top 5 employees with the most completed tasks
        $topEmployees = Employee::withCount(['tasks' => function ($query) {
            $query->where('status', 'completed');
        }])
        ->orderBy('tasks_count', 'desc')
        ->take(5)
        ->get()
        ->map(function ($employee) {
            $employee->completed_tasks = $employee->tasks_count;
            return $employee;
        });
    
        // Pass data to the view
        return view('admin.dashboard', compact('tasks', 'totalTasks', 'pendingTasks', 'completedTasks', 'topEmployees'));
    }
}
    