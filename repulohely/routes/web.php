<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirportController;
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

// AirlineContoroller

// List all airlines
Route::get('/airlines', [AirlineController::class, 'index']);

// Display a specific airline
Route::get('/airlines/{id}', [AirlineController::class, 'show']);

// Create a new airline
Route::post('/airlines', [AirlineController::class, 'store'])->name("airlines.store");

// Update an existing airline
Route::put('/airlines/{id}', [AirlineController::class, 'update'])->name("airlines.update.post");
Route::get('/airlines/{id}', [AirlineController::class, 'update'])->name("airlines.update.get");

// Delete an existing airline
Route::delete('/airlines/{id}', [AirlineController::class, 'destroy'])->name("airlines.destroy");;

Route::get('/airlines/{id}/edit', [AirlineController::class, 'edit'])->name('airlines.edit');



// Airplanes


Route::get('/airplanes', [AirplaneController::class, 'index'])->name('airplanes.index');
Route::get('/airplanes/create', [AirplaneController::class, 'create'])->name('airplanes.create');
Route::post('/airplanes', [AirplaneController::class, 'store'])->name('airplanes.store');
Route::get('/airplanes/{id}', [AirplaneController::class, 'show'])->name('airplanes.show');
Route::get('/airplanes/{id}/edit', [AirplaneController::class, 'edit'])->name('airplanes.edit');
Route::put('/airplanes/{id}', [AirplaneController::class, 'update'])->name('airplanes.update');
Route::delete('/airplanes/{id}', [AirplaneController::class, 'destroy'])->name('airplanes.destroy');


Route::get('/airplanes/{id}/edit', [AirplaneController::class, 'edit'])->name('airplanes.edit');


//Airport

Route::get('/airports', [AirportController::class, 'index'])->name('airports.index');
Route::get('/airports/{id}', [AirportController::class, 'show'])->name('airports.show');
Route::post('/airports', [AirportController::class, 'store'])->name('airports.store');
Route::put('/airports/{id}', [AirportController::class, 'update'])->name('airports.update');
Route::delete('/airports/{id}', [AirportController::class, 'destroy'])->name('airports.delete');

Route::get('/airports/{id}/edit', [AirportController::class, 'edit'])->name('airports.edit');
