<style>
    .navbar {
        background-color: #f8f9fa;
        padding: 0.5rem 1rem;
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
    }
    .nav-link {
        text-decoration: none;
        color: inherit;
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
