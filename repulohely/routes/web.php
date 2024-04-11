<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
})->name('register.view');

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/login', function () {
    return view('login');
})->name('login.view');

// Bejelentkezési kérés kezelése
Route::post('/login', [AuthController::class, 'login'])->name('login');

