<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InsurantController;
use App\Http\Controllers\InsurantPackageController;
use App\Http\Controllers\PlaneRouteController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;



Route::get('/register', function () {
    return view('register');
})->name('register.view');

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/login', function () {
    return view('login');
})->name('login.view');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);


Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

// Bejelentkezési kérés kezelése

// AirlineContoroller

// List all airlines
Route::middleware(['isadmin'])->group(function () {
Route::get('/airlines', [AirlineController::class, 'index'])->name("airlines.index");

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
Route::delete('/airports/{id}', [AirportController::class, 'destroy'])->name('airports.destroy');

Route::get('/airports/{id}/edit', [AirportController::class, 'edit'])->name('airports.edit');

// Insurant

Route::get('/insurants', [InsurantController::class, 'index'])->name('insurants.index');
Route::get('/insurants/{name}', [InsurantController::class, 'show'])->name('insurants.show');
Route::post('/insurants', [InsurantController::class, 'store'])->name('insurants.store');
Route::put('/insurants/{name}', [InsurantController::class, 'update'])->name('insurants.update');
Route::delete('/insurants/{name}', [InsurantController::class, 'destroy'])->name('insurants.destroy');

Route::get('/insurants/{name}/edit', [InsurantController::class, 'edit'])->name('insurants.edit');

// InsurantPackage

Route::get('/insurant-packages', [InsurantPackageController::class, 'index'])->name('insurant-packages.index');
Route::get('/insurant-packages/{name}/{insurance_company_name}', [InsurantPackageController::class, 'show'])->name('insurant-packages.show');
Route::post('/insurant-packages', [InsurantPackageController::class, 'store'])->name('insurant-packages.store');
Route::put('/insurant-packages/{name}/{insurance_company_name}', [InsurantPackageController::class, 'update'])->name('insurant-packages.update');
Route::delete('/insurant-packages/{name}/{insurance_company_name}', [InsurantPackageController::class, 'destroy'])->name('insurant-packages.destroy');

//Route::get('/insurant-packages/{name}/{insurance_company_name}/edit', [InsurantPackageController::class, 'edit'])->name('insurant-packages.edit');
Route::get('/insurant-packages/{name}/{insurance_company_name}/edit', [InsurantPackageController::class, 'edit'])->name('insurant-packages.edit');

// Booking

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/{user_id}/{flight_id}/{plane_id}/{departure_time}', [BookingController::class, 'show'])->name('bookings.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::put('/bookings/{user_id}/{flight_id}/{plane_id}/{departure_time}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{user_id}/{flight_id}/{plane_id}/{departure_time}', [BookingController::class, 'destroy'])->name('bookings.destroy');

Route::get('/bookings/{user_id}/{flight_id}/{plane_id}/{departure_time}/edit', [BookingController::class, 'edit'])->name('bookings.edit');

// PlaneRoute

Route::get('/plane-routes', [PlaneRouteController::class, 'index'])->name('plane-routes.index');
Route::get('/plane-routes/{id}', [PlaneRouteController::class, 'show'])->name('plane-routes.show');
Route::post('/plane-routes', [PlaneRouteController::class, 'store'])->name('plane-routes.store');
Route::put('/plane-routes/{id}', [PlaneRouteController::class, 'update'])->name('plane-routes.update');
Route::delete('/plane-routes/{id}', [PlaneRouteController::class, 'destroy'])->name('plane-routes.destroy');

Route::get('/plane-routes/{id}/edit', [PlaneRouteController::class, 'edit'])->name('plane-routes.edit');

// Tickets

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');


// Seats

Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');
Route::get('/seats/{seat_number}', [SeatController::class, 'show'])->name('seats.show');
Route::post('/seats', [SeatController::class, 'store'])->name('seats.store');
Route::put('/seats/{seat_number}', [SeatController::class, 'update'])->name('seats.update');
Route::delete('/seats/{seat_number}', [SeatController::class, 'destroy'])->name('seats.destroy');
Route::get('/seats/{seat_number}/edit', [SeatController::class, 'edit'])->name('seats.edit');
});

Route::get('/', [App\Http\Controllers\DatabaseConnectionController::class, 'index'])->name('home');



