<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $foglalasok = DB::select('SELECT * FROM Foglalasok');
        return view('bookings.index', ['bookings' => $foglalasok]);
    }

    public function show($user_id, $flight_id, $plane_id, $departure_time)
    {
        $foglalas = DB::select('SELECT * FROM Foglalasok WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\')', [
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

        DB::insert('INSERT INTO Foglalasok (user_id, flight_id, plane_id, departure_time, seat_number, insurance_package, insurance_company, class) VALUES (?, ?, ?, TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\'), ?, ?, ?, ?)', [
            $validated['user_id'],
            $validated['flight_id'],
            $validated['plane_id'],
            $validated['departure_time'],
            $validated['seat_number'],
            $validated['insurance_package'],
            $validated['insurance_company'],
            $validated['class'],
        ]);

        return response()->json(['success' => true], 201);
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

        $parameters = array_merge($parameters, [$user_id, $flight_id, $plane_id, $departure_time]);

        if (!empty($sqlSetParts)) {
            $sql = 'UPDATE Foglalasok SET ' . implode(', ', $sqlSetParts) . ' WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\')';
            DB::update($sql, $parameters);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($user_id, $flight_id, $plane_id, $departure_time)
    {
        DB::delete('DELETE FROM Foglalasok WHERE user_id = ? AND flight_id = ? AND plane_id = ? AND departure_time = TO_DATE(?, \'YYYY-MM-DD HH24:MI:SS\')', [
            $user_id,
            $flight_id,
            $plane_id,
            $departure_time,
        ]);

        return response()->json(['message' => 'Foglalás törölve']);
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
}
