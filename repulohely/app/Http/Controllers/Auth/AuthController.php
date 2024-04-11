<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validálás
        $validatedData = $request->validate([
            'email' => 'required|email|unique:felhasznalok,email',
            'password' => 'required|min:6|confirmed',
            'name' => 'required|max:40',
        ]);

        // Jelszó titkosítása
        $hashedPassword = Hash::make($validatedData['password']);

        // Adatfelvitel, a 'privilege' mező értékét direkt 'user'-re állítjuk
        DB::insert('INSERT INTO Felhasznalok (email, password, name, privilege) VALUES (?, ?, ?, ?)', [
            $validatedData['email'],
            $hashedPassword,
            $validatedData['name'],
            'user',
        ]);

        // Visszajelzés a felhasználónak
        return response()->json(['message' => 'Sikeres regisztráció'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Ide irányítsd át a felhasználót sikeres bejelentkezés után
        }

        return back()->withErrors([
            'email' => 'A megadott hitelesítő adatok nem egyeznek rekordjainkkal.',
        ]);
    }
}
