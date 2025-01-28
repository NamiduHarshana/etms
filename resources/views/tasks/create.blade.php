<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #F1FAEE;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1E1E2F;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 22px;
            border-radius: 12px 12px 0 0;
        }

        .btn-primary {
            background-color: #457B9D;
            border: none;
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #1D3557;
        }

        .form-control {
            border-radius: 8px;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            color: #E63946;
            text-decoration: none;
            font-weight: bold;
        }

        .back-btn:hover {
            color: #1D3557;
        }

        #char-count {
            font-size: 14px;
            color: #E63946;
            text-align: right;
        }

        .navbar {
            background-color: #1E1E2F;
            padding: 10px 15px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #E63946;
        }

        .navbar-brand:hover {
            color: #E63946;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Manage
                Tasks</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">Create New Task</div>
            <div class="card-body">

                <a href="{{ route('tasks.index') }}" class="back-btn">⬅ Back to Task List</a>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                        <div id="char-count">0 / 200</div>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Assign to Employee</label>
                        <select id="employee_id" name="employee_id" class="form-select" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Character Counter for Description
            $('#description').on('input', function() {
                let length = $(this).val().length;
                $('#char-count').text(length + ' / 200');
            });
        });
    </script>

</body>

</html>
