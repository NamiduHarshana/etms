<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('employee')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'employee_id' => 'required|exists:employees,id',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
{
    $employees = Employee::all(); // Fetch all employees for reassigning tasks
    return view('tasks.edit', compact('task', 'employees')); // Render a form with task data
}

public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'due_date' => 'required|date',
        'status' => 'required|in:pending,completed',
        'employee_id' => 'required|exists:employees,id',
    ]);

    $task->update($request->all()); // Update the task with the form data
    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
