<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch overall task statistics
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $pendingTasks = Task::where('status', 'pending')->count();

        // Fetch top 5 employees with the most completed tasks
        $topEmployees = Employee::whereHas('tasks', function ($query) {
            $query->where('status', 'completed');
        }) // Filter only employees with at least one completed task
        ->withCount(['tasks' => function ($query) {
            $query->where('status', 'completed');
        }]) // Count only completed tasks
        ->orderBy('tasks_count', 'desc')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact('totalTasks', 'completedTasks', 'pendingTasks', 'topEmployees'));
    }
}
 
    
