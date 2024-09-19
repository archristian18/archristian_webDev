<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* CSS styles for alignment */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .navbar a {
            text-decoration: none;
            margin-right: 15px;
        }
        .navbar form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation Links -->
        <nav class="navbar">
            <div class="nav-links">
                @if (Auth::check())
                    <a href="{{ route('contacts.index') }}">Contacts</a>
                @endif
            </div>
            <div class="auth-links">
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </nav>

        @yield('content')
    </div>
</body>
</html>
