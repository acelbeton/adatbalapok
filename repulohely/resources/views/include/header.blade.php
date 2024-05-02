<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Inter, Arial, sans-serif;
            font-weight: 400;
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
            position: relative; /* Changed from absolute to ensure stacking context */
            width: 100%;
            height: 100px; /* Adjust the height as needed */
            background: rgba(255, 255, 255, 0.68);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(7px);
            z-index: 1000; /* Increased z-index */
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .navbar-nav {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            justify-content: space-evenly;
        }

        .nav-item {
            position: relative;
            margin-right: 20px;
            display: block;
        }

        .nav-link {
            font-size: 16px;
            color: black;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: 600;
            display: block;
        }

        .nav-link:hover, .dropdown:hover .dropbtn {
            color: coral;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            border-radius: 8px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1001; /* Ensure it is above navbar */
            overflow-y: auto; /* Allows scrolling */
            max-height: 400px; /* Maximum height before scrolling */
            scrollbar-width: thin; /* 'auto' or 'thin' */
            scrollbar-color: #b3b3b3 #f0f0f0; /* thumb and track color */
        }

        .dropdown-content::-webkit-scrollbar {
            width: 8px; /* Scrollbar width */
        }

        .dropdown-content::-webkit-scrollbar-track {
            background: #f0f0f0; /* Track color */
            border-radius: 10px;
        }

        .dropdown-content::-webkit-scrollbar-thumb {
            background-color: #b3b3b3; /* Thumb color */
            border-radius: 10px;
            border: 2px solid #f0f0f0; /* Creates padding around the thumb */
        }

        .dropdown-content::-webkit-scrollbar-thumb:hover {
            background-color: #999999; /* Thumb hover color */
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
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
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listings.child-friendly') }}">Child Friendly Flights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('airport.departures') }}">Airport flights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('airlines.popular') }}">Airline Popularity</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('average.flight') }}">Average flight length</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('insurants.listings') }}">Insurance calc</a>
                </li>
                @auth
                @if (auth()->check() && auth()->user()->privilege === 'admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropbtn">Admin Panel</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/airlines') }}">Airlines</a>
                        <a href="{{ url('/airplanes') }}">Airplanes</a>
                        <a href="{{ url('/airports') }}">Airports</a>
                        <a href="{{ url('/bookings') }}">Bookings</a>
                        <a href="{{ url('/insurant-packages') }}">Insurance Packages</a>
                        <a href="{{ url('/insurants') }}">Insurances</a>
                        <a href="{{ url('/plane-routes') }}">Plane Routes</a>
                        <a href="{{ url('/tickets') }}">Tickets</a>
                        <a href="{{ url('/seats') }}">Seats</a>
                        <a href="{{ url('/users') }}">Users</a>
                        <a href="{{ url('/insurance-bought') }}">Bought insurance count</a>
                    </div>
                </li>
                @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.details') }}">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Log out</a>
                    </li>
                @elseguest
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
