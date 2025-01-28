<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;

// Welcome route
Route::get('/', function () {
    return view('welcome_login'); // Loads the welcome.blade.php
})->name('home');

// Unified login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Dashboard and CRUD routes
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Employee CRUD
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees.index');
        Route::get('/employees/create', 'create')->name('employees.create');
        Route::post('/employees/store', 'store')->name('employees.store'); // Fix Here
        Route::get('/employees/{employee}/edit', 'edit')->name('employees.edit');
        Route::put('/employees/{employee}', 'update')->name('employees.update');
        Route::delete('/employees/{employee}', 'destroy')->name('employees.destroy');
    });

    // Task CRUD
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::post('/tasks', 'store')->name('tasks.store');
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
        Route::put('/tasks/{task}', 'update')->name('tasks.update');
        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    });
});

// Employee Dashboard and Task Update route
Route::middleware(['auth:employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::post('/task/{id}/update', [EmployeeController::class, 'updateTaskStatus'])->name('employee.task.update');
});
