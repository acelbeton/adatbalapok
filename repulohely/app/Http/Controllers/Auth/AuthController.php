<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:felhasznalok,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password|min:6',
            'name' => 'required|max:40',
        ]);

        $hashedPassword = Hash::make($validatedData['password']);

        DB::insert('INSERT INTO Felhasznalok (email, password, name, privilege) VALUES (?, ?, ?, ?)', [
            $validatedData['email'],
            $hashedPassword,
            $validatedData['name'],
            'user',
        ]);

        return redirect(route('login'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            return redirect()->intended('/')->with('userId', $userId);
        }

        return back()->withErrors([
            'email' => 'A megadott hitelesítő adatok nem egyeznek rekordjainkkal.',
        ]);
    }

    public function showLoginForm()
    {
        return view('login');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
