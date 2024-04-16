<style>
    body{
        margin: 0
    }
    .navbar {
        margin: 0;
        border: 0;
        width: 100%;
        height: 100px;
        background: rgba(255, 255, 255, 0.68);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(7px);
        z-index: 100;
    }
    .navbar-toggler {
        display: none;
    }
    .navbar-nav {
        display: flex;
        list-style: none;
        padding-left: 0;
        margin: 0;
        align-items: center;
    }
    .nav-item {
        margin-right: 20px;
        padding-top: 30px;
        text-align: center;
    }
    .nav-link {
        font-size: 24px;
        color: black;
        text-decoration: none;
        padding: 0.5rem 0;
    }
</style>
<header class="z-99 navbar navbar-expand-lg extend-style">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
    </div>
</header>
