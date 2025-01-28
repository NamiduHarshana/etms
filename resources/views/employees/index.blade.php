@extends('layouts.app')

@section('title', 'Manage Employees')

@section('content') <!-- Ensure content is inside the layout -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <title>Manage Employees</title>

                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

                <!-- Custom CSS -->
                <style>
                    body {
                        background-color: #F1FAEE;
                        font-family: 'Arial', sans-serif;
                    }

                    .container {
                        margin-top: 50px;
                    }

                    .card-header {
                        background-color: #1E1E2F color: white;
                        font-weight: bold;
                        text-align: center;
                        font-size: 22px;
                    }

                    .btn-primary {
                        background-color: #457B9D;
                        border: none;
                    }

                    .btn-primary:hover {
                        background-color: #1D3557;
                    }

                    .btn-warning {
                        background-color: #E63946;
                        border: none;
                    }

                    .btn-warning:hover {
                        background-color: #1D3557;
                    }

                    .btn-danger {
                        background-color: #1E1E2F;
                        border: none;
                    }

                    .btn-danger:hover {
                        background-color: #1D3557;
                    }

                    table {
                        text-align: center;
                    }

                    .delete-btn {
                        color: white;
                        font-weight: bold;
                        background-color: #1E1E2F;
                        border: none;
                    }

                    .delete-btn:hover {
                        background-color: #1D3557;
                    }

                    .table thead {
                        background-color: #E63946;
                        color: white;
                    }

                    .table-striped tbody tr:nth-of-type(odd) {
                        background-color: #F1FAEE;
                    }

                    .table-striped tbody tr:hover {
                        background-color: #eaeaea;
                    }
                </style>
                </head>

                <body>

                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                Manage Employees
                            </div>
                            <div class="card-body">

                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success text-center">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="text-end mb-3">
                                    <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Add New Employee</a>
                                </div>

                                <table class="table table-bordered table-hover table-striped bg-white shadow-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>
                                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                        data-id="{{ $employee->id }}">Delete</button>

                                                    <form id="delete-form-{{ $employee->id }}"
                                                        action="{{ route('employees.destroy', $employee->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap & jQuery Scripts -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                    <script>
                        $(document).ready(function() {
                            $(".delete-btn").click(function() {
                                let employeeId = $(this).data('id');
                                if (confirm("Are you sure you want to delete this employee?")) {
                                    $("#delete-form-" + employeeId).submit();
                                }
                            });
                        });
                    </script>

                </body>

                </html>
