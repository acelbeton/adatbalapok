<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $foglalasok = DB::select('SELECT * FROM Foglalasok');
        return view('bookings.index', ['bookings' => $foglalasok]);
    }

    public function show($user_id, $flight_id, $plane_id, $departure_time)
    {
        $foglalas = DB::select('SELECT * FROM Foglalasok WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD\')', [
            $user_id,
            $flight_id,
            $plane_id,
            $departure_time,
        ]);

        if (empty($foglalas)) {
            return response()->json(['message' => 'Foglalás nem található'], 404);
        }

        return response()->json($foglalas[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:Felhasznalok,id',
            'flight_id' => 'required|integer|exists:Jaratok,id',
            'plane_id' => 'required|integer|exists:Repulok,id',
            'departure_time' => 'required|date',
            'seat_number' => 'required|integer',
            'insurance_package' => 'nullable|max:40',
            'insurance_company' => 'nullable|max:40',
            'class' => 'required|max:40',
        ]);

        DB::insert('INSERT INTO Foglalasok (user_id, flight_id, plane_id, departure_time, seat_number, insurance_package, insurance_company, class) VALUES (?, ?, ?, TO_DATE(?, \'YYYY-MM-DD\'), ?, ?, ?, ?)', [
            $validated['user_id'],
            $validated['flight_id'],
            $validated['plane_id'],
            $validated['departure_time'],
            $validated['seat_number'],
            $validated['insurance_package'],
            $validated['insurance_company'],
            $validated['class'],
        ]);

        return redirect()->route('bookings.index');
    }

    public function update(Request $request, $user_id, $flight_id, $plane_id, $departure_time)
    {
        $validated = $request->validate([
            'seat_number' => 'sometimes|integer',
            'insurance_package' => 'nullable|max:40',
            'insurance_company' => 'nullable|max:40',
            'class' => 'nullable|max:40',
        ]);

        $parameters = [];
        $sqlSetParts = [];
        foreach ($validated as $key => $value) {
            $sqlSetParts[] = "$key = ?";
            $parameters[] = $value;
        }

        $parameters = array_merge($parameters, [$user_id, $flight_id, $plane_id, explode(' ',$departure_time)[0]]);

        if (!empty($sqlSetParts)) {
            $sql = 'UPDATE Foglalasok SET ' . implode(', ', $sqlSetParts) . ' WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD\')';
            DB::update($sql, $parameters);
        }

        return redirect()->route('bookings.index');
    }

    public function destroy($user_id, $flight_id, $plane_id, $departure_time)
    {
        DB::delete('DELETE FROM Foglalasok WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\')', [
            $user_id,
            $flight_id,
            $plane_id,
            $departure_time,
        ]);

        return redirect()->route('bookings.index');
    }

    public function edit($user_id, $flight_id, $plane_id, $departure_time)
    {
        $booking = DB::select('SELECT * FROM Foglalasok WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\')', [
            $user_id,
            $flight_id,
            $plane_id,
            $departure_time,
        ]);


        if (empty($booking)) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        $booking = $booking[0];

        return view('bookings.edit', compact('booking'));
    }


    public function getUserBookingDetails() {

        $userId = Auth::id();

        $userBookingDetails = DB::select('
                SELECT
                j.id as flight_id,
                d.name as departure_airport,
                a.name as arrival_airport,
                b.name as insurance_package,
                f.class as seat_class,
                f.departure_time as departure_time,
                COUNT(*) as total_bookings_on_this_flight
            FROM Foglalasok f
            JOIN Jaratok j ON f.flight_id = j.id
            JOIN Repterek d ON j.departure = d.id
            JOIN Repterek a ON j.arrival = a.id
            JOIN BiztositasiCsomagok b ON f.insurance_package = b.name
            WHERE f.user_id = :userId
            GROUP BY j.id, d.name, a.name, b.name, f.class, f.departure_time


    ', ['userId' => $userId]);

        return view('listings.user_booking', compact('userBookingDetails'));

    }
    public function book($flightID, $departureCity, $arrivalCity, $departureDate)
    {

        $userId = Auth::id();

        $flight = DB::select("
            SELECT j.*, le.name as airline_name, da.name AS departure_airport_name, aa.name AS arrival_airport_name
            FROM jaratok j
            JOIN repterek da ON j.departure = da.id
            JOIN repterek aa ON j.arrival = aa.id
            JOIN legitarsasagok le on j.airline = le.id
            WHERE j.id = ? ",
            [$flightID]
        );
        Log::info($flightID);
        $flight = collect($flight);
        return view('bookings.book', compact('flight'));
    }
    public function storeBook(Request $request)
    {

        $userId = Auth::id();
        Log::info($request);
        $validated = $request->validate([
            'flight_id' => 'required|integer',
            'plane_id' => 'required|integer',
            'departure_time' => 'required|date',
            'seat_number' => 'required|integer',
            'insurance_package' => 'nullable|max:40',
            'insurance_company' => 'nullable|max:40',
            'class' => 'required|max:40',
        ]);

        DB::insert('INSERT INTO Foglalasok (user_id, flight_id, plane_id, departure_time, seat_number, insurance_package, insurance_company, class) VALUES (?, ?, ?, TO_DATE(?, \'YYYY-MM-DD\'), ?, ?, ?, ?)', [
            $userId = Auth::id(),
            $validated['flight_id'],
            3,
            $validated['departure_time'],
            $validated['seat_number'],
            $validated['insurance_package'],
            $validated['insurance_company'],
            $validated['class'],
        ]);
        return redirect()->route('booking.details');

    }
}
