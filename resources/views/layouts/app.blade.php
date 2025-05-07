<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Simple Blog')</title>
    @vite('resources/css/app.css') {{-- Link Tailwind via Vite --}}
    <style>
        /* General Body Styling */
        body {
            background-color: #f7fafc;
            font-family: 'Arial', sans-serif;
            color: #2d3748;
        }

        /* Navigation Bar */
        nav {
            background-color: #1e3a8a; /* Deep Blue */
            padding: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        nav a:hover {
            color: #ffdd57; /* Bright Yellow */
        }

        .nav-logo {
            font-size: 1.5rem;
            letter-spacing: 1px;
        }
        .nav-logo {
            background-color: #ffdd57; /* Yellow */
            color: #1e3a8a; /* Deep Blue */
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-create-btn {
            background-color: #ffdd57; /* Yellow */
            color: #1e3a8a; /* Deep Blue */
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-create-btn:hover {
            background-color: #1e3a8a;
            color: white;
        }

        /* Main Content Area */
        main {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin-top: 8px;
            list-style-type: none;
            padding-left: 0;
        }

        .alert ul li {
            font-size: 0.9rem;
        }

        footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 0.875rem;
        }

        footer a {
            color: #ffdd57;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navigation Section -->
    <nav>
        <div class="container">
            <a href="{{ route('posts.index') }}" class="nav-logo">Simple Blog</a>
            <a href="{{ route('posts.create') }}" class="nav-create-btn">Create Post</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main>
        {{-- Session messages for success/error --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Oops! Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content') {{-- Page specific content will go here --}}
    </main>

    <!-- Footer Section -->
    <footer>
        My Simple Blog &copy; {{ date('Y') }}
        <br />
        <a href="{{ route('posts.index') }}">Back to All Posts</a>
    </footer>

    @vite('resources/js/app.js') {{-- Include JS if needed --}}
</body>
</html>
