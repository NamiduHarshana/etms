<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #F1FAEE;
            color: #343a40;
        }

        .navbar {
            background-color: #1E1E2F;
        }

        .navbar-brand {
            color: #E63946;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #f8f9fa;
        }

        .navbar .nav-link {
            color: white !important;
        }

        .navbar .nav-link:hover {
            color: #f8f9fa !important;
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

        .btn-dark {
            background-color: #1E1E2F;
            border-color: #1E1E2F;
        }

        .btn-dark:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 2px solid #E63946;
            object-fit: cover;
        }

        .status-pending {
            color: red;
            font-weight: bold;
        }

        .status-completed {
            color: green;
            font-weight: bold;
        }

        .completed-tasks-card {
            background-color: #457B9D !important;
            color: white !important;
        }

        .pending-tasks-card {
            background-color: #E63946 !important;
            color: white !important;
        }

        .table th {
            background-color: #1E1E2F;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Employee Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ route('employee.dashboard') }}" class="nav-link"></a></li>
                </ul>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-dark">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">

        <!-- Employee Profile Section -->
        <div class="profile-card mb-4">
            <div>
                <h5>{{ auth()->user()->name }}</h5>
                <p class="mb-0">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <!-- Task Summary -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card completed-tasks-card text-center">
                    <div class="card-body">
                        <h3>{{ $completedTasks }}</h3>
                        <p>Completed Tasks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card pending-tasks-card text-center">
                    <div class="card-body">
                        <h3>{{ $pendingTasks }}</h3>
                        <p>Pending Tasks</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task List -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your Assigned Tasks</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td class="{{ $task->status === 'completed' ? 'status-completed' : 'status-pending' }}">
                                    {{ ucfirst($task->status) }}
                                </td>
                                <td>
                                    <form action="{{ route('employee.task.update', $task->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select">
                                            <option value="pending"
                                                {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed"
                                                {{ $task->status === 'completed' ? 'selected' : '' }}>Completed
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
