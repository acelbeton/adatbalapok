<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Include JavaScript files -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
