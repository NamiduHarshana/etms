<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Task Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F1FAEE;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .content-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .nav-tabs .nav-link.active {
            background-color: #E63946;
            color: white;
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

        .navbar {
            background-color: #1E1E2F !important;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .content-container {
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Task Management</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-container">
        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center" id="mainTabs">
            <li class="nav-item">
                <a class="nav-link active" data-tab="welcomeTab" href="#">Welcome</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-tab="loginTab" href="#">Login</a>
            </li>
        </ul>

        <!-- Welcome Section -->
        <div id="welcomeTab" class="tab-content active">
            <h2 class="text-center mt-3">Welcome</h2>
            <p class="text-center">Please log in to continue:</p>
            <div class="d-grid">
                <button class="btn btn-primary switch-tab" data-tab="loginTab">Go to Login</button>
            </div>
        </div>

        <!-- Login Section -->
        <div id="loginTab" class="tab-content">
            <h2 class="text-center mt-3">Login</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery for Tab Navigation -->
    <script>
        $(document).ready(function() {
            $(".nav-link").click(function(event) {
                event.preventDefault();
                let tabId = $(this).data("tab");

                $(".tab-content").removeClass("active");
                $("#" + tabId).addClass("active");

                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });

            $(".switch-tab").click(function() {
                let tabId = $(this).data("tab");
                $(".nav-link[data-tab='" + tabId + "']").click();
            });
        });
    </script>
</body>

</html>
