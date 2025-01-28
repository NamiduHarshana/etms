<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form for both Admin and Employee.
     */
    public function showLoginForm()
    {
        return view('welcome_login'); // Renders the login form located in resources/views/auth/login.blade.php
    }

    /**
     * Handle the login process for Admin and Employee.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,employee',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        if ($role === 'admin' && Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'employee' && Auth::guard('employee')->attempt($credentials)) {
            return redirect()->route('employee.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or role.']);
    }

    /**
     * Logout the authenticated user based on their role.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('success', 'Admin logged out successfully.');
        }

        if (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
            return redirect()->route('login')->with('success', 'Employee logged out successfully.');
        }

        return redirect()->route('login')->with('error', 'No user was logged in.');
    }
}
