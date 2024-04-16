@extends('include.app')

@section('content')
    <div>
        <div>
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
                    <input type="email" id="email" name="email">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Jelszó:</label>
                    <input type="password" id="password" name="password">
                </div>
                <div>
                    <input type="checkbox"  name="remember" >
                    <label for="remember">Emlékezz rám</label>
                </div>
                <button type="submit">Bejelentkezés</button>
            </form>
        </div>
    </div>
@endsection
