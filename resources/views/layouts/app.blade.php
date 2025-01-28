<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        /* Basic Navbar Styles */
        nav {
            background-color: #1E1E2F;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

        nav a:hover {
            color: #E63946;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #F1FAEE;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        .btn-primary {
            background-color: #457B9D;
            border-color: #457B9D;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }

        .btn-success {
            background-color: #457B9D;
            border-color: #457B9D;
            color: white;
        }

        .btn-success:hover {
            background-color: #1D3557;
            border-color: #1D3557;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
        </form>
    </nav>

    <!-- Content Section -->
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
