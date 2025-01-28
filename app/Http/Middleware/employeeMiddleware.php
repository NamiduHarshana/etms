<?php

// app/Http/Middleware/EmployeeMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('employee')->check()) {
            return redirect('/employee/login');
        }
        return $next($request);
    }
}

