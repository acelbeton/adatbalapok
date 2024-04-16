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
        .bg {
            width: 100%;
            height: 400px;
            position: relative;
            top: 0;
            left: 0;
            z-index: -1;
            background: url("{{ asset('/img/bg.png') }}") center center/cover no-repeat;*/
        }
        h1,h2{
            text-align: center;
            border-bottom: solid 2px #000;
            padding-bottom: 15px;
        }

        table{
            text-align: center;
            margin: 0 auto;
        }
        td{
            padding-left: 20px;
            padding-right: 20px;
        }
        form{
            text-align: center;
            padding-bottom: 100px;
        }
        label{
            padding-right: 30px;
            width: 300px;
        }
        input{
            width: 200px;
        }
        .container{
            width: 95%;
            margin: 0  auto;
        }
        input[type="text"], input[type="number"], input[type="email"], input[type="password"]{
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 20px;
            border-radius: 25px;
            padding-bottom: 5px;
            padding-top: 5px;
        }
        button[type="submit"]{
            border-radius: 25px;
            padding: 10px 20px;
            color: white;
            background: green;
        }
        button.btn-danger{
            color: white;
            background: darkred;
            border: 2px solid red;
            padding: 10px 20px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 25px;
        }
        td a{
            text-decoration: none;
            background: green;
            padding: 10px 20px;
            font-size: 12px;
            border-radius: 25px;
            color: white;
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container">
    @yield('content')
</div>
</body>
</html>
