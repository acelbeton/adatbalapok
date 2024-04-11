<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>
<body>
<h2>Regisztráció</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">Név:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">E-mail cím:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Jelszó megerősítése:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit">Regisztrálás</button>
</form>
</body>
</html>
