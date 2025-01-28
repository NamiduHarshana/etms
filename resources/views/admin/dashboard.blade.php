<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F1FAEE;
            color: #343a40;
        }

        nav {
            background-color: #1E1E2F;
            padding: 10px 15px;
            color: white;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bg-primary {
            background-color: #459d89 !important;
        }

        .bg-warning {
            background-color: #d36770 !important;
        }

        .bg-success {
            background-color: #457B9D !important;
        }

        .table {
            background-color: white;
            border-radius: 10px;
        }

        .table th {
            background-color: #1E1E2F;
            color: white;
            border: none;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f4f4f9;
        }

        .table-striped tbody tr:hover {
            background-color: #eaeaea;
        }

        canvas {
            max-height: 400px;
        }

        .btn-danger {
            background-color: #1E1E2F;
            border: none;
        }

        .btn-danger:hover {
            background-color: #1D3557;
        }

        .btn-primary {
            background-color: #457B9D;
            border-color: #457B9D;
        }

        .btn-primary:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }

        .btn-success {
            background-color: #457B9D;
            border-color: #457B9D;
        }

        .btn-success:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #E63946;
        }

        .navbar-brand:hover {
            color: #E63946;
        }

        .card-title {
            font-weight: bold;
            color: #457B9D;
        }

        .text-white {
            color: #ffffff !important;
        }

        .navbar .nav-link {
            color: white !important;
        }

        .navbar .nav-link:hover {
            color: #f8f9fa !important;
        }

        .navbar-toggler-icon {
            filter: invert(1);

        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Admin Dashboard</a>

            <!-- Navbar Toggler (Properly Positioned & White Color) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content (Aligned Correctly) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ route('tasks.index') }}" class="nav-link">Manage Tasks</a></li>
                    <li class="nav-item"><a href="{{ route('employees.index') }}" class="nav-link">Manage Employees</a>
                    </li>
                </ul>

                <!-- Logout Button (Properly Aligned to Right) -->
                <form method="POST" action="{{ route('logout') }}" class="d-flex logout-btn">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Statistics -->
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h3>{{ $totalTasks }}</h3>
                        <p>Total Tasks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <h3>{{ $pendingTasks }}</h3>
                        <p>Pending Tasks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <h3>{{ $completedTasks }}</h3>
                        <p>Completed Tasks</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Status Chart -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Task Status Distribution</h5>
                <canvas id="taskChart"></canvas>
            </div>
        </div>

        <!-- Top Employees Table -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Top 5 Employees with Most Completed Tasks</h5>
                @if ($topEmployees->isNotEmpty())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Completed Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topEmployees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->tasks_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">No employees have completed tasks.</p>
                @endif
            </div>
        </div>

        <!-- Include Bootstrap Bundle JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Bar Chart for Task Status Distribution
            const ctx = document.getElementById('taskChart').getContext('2d');
            const taskChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pending', 'Completed'],
                    datasets: [{
                        label: 'Tasks',
                        data: [{{ $pendingTasks }}, {{ $completedTasks }}],
                        backgroundColor: ['rgba(230, 57, 70, 0.8)', 'rgba(69, 123, 157, 0.8)'],
                        borderColor: ['rgba(230, 57, 70, 1)', 'rgba(69, 123, 157, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

</body>

</html>


</body>

</html>
