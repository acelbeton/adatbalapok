<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- Include JavaScript files -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif; /* Specify your preferred font family */
        }

        .bg-container {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Adjust the height as needed */
            background: rgba(255, 255, 255, 0.68);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(7px);
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-right: 20px;
        }

        .nav-link {
            font-size: 18px;
            color: black;
            text-decoration: none;
            padding: 15px 20px;
        }
        input{
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<div class="bg-container">
    <img src="{{ asset('img/bg.png') }}" class="bg-image">
    <header>
        <div class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/airlines') }}">Airlines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/airplanes') }}">Airplanes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/airports') }}">Airports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/bookings') }}">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/insurant-packages') }}">Insurance Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/insurants') }}">Insurances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/plane-routes') }}">Plane Routes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tickets') }}">Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/seats') }}">Seats</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </header>
</div>
</body>
</html>
