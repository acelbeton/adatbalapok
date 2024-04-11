<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
<h2>Bejelentkezés</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">E-mail cím:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Emlékezz rám</label>
    </div>
    <button type="submit">Bejelentkezés</button>
</form>
</body>
</html>
