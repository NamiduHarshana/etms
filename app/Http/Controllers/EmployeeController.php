<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|unique:employees,phone',
            'password' => 'required|min:8',
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }


    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|unique:employees,phone,' . $employee->id,
        ]);

        $employee->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    /**
     * Employee Dashboard - Shows assigned tasks and summary.
     */
    public function dashboard()
    {
        $employee = Auth::user();
        $tasks = Task::where('employee_id', $employee->id)->get();

        // Calculate summary
        $completedTasks = $tasks->where('status', 'completed')->count();
        $pendingTasks = $tasks->where('status', 'pending')->count();

        return view('employees.dashboard', compact('tasks', 'completedTasks', 'pendingTasks'));
    }

    /**
     * Update task status to pending/completed.
     */
    public function updateTaskStatus(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        // Ensure the logged-in employee is updating only their own tasks
        if ($task->employee_id !== Auth::id()) {
            return redirect()->back()->withErrors('Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->route('employee.dashboard')->with('success', 'Task status updated.');
    }
}
