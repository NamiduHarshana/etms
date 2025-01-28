<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F1FAEE;
            color: #343a40;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #1E1E2F;
        }

        .btn-primary {
            background-color: #457B9D;
            border-color: #457B9D;
        }

        .btn-primary:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #E63946;
            box-shadow: 0 0 0 0.2rem rgba(230, 57, 70, 0.25);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #E63946;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            color: #1D3557;
            text-decoration: underline;
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
                Employees</a>
        </div>
    </nav>

    <div class="container">
        <h1>Edit Employee</h1>
        <a href="{{ route('employees.index') }}" class="back-link">Back to Employee List</a>
        <form method="POST" action="{{ route('employees.update', $employee->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="{{ $employee->password }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Update Employee</button>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

