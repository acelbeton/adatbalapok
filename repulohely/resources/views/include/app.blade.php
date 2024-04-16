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
</head>
<body>
@include('include.header')
@include('include.bg')
<div class="container">
    @yield('content')
</div>
</body>
</html>
