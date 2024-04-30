<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AirportController extends Controller
{
    public function index()
    {
        $repterek = DB::select('SELECT * FROM Repterek');
        return view('airports.index', ['airports' => $repterek]);
    }

    public function show($id)
    {
        $repter = DB::select('SELECT * FROM Repterek WHERE id = ?', [$id]);

        if (empty($repter)) {
            return response()->json(['message' => 'Reptér nem található'], 404);
        }

        return response()->json($repter[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|max:40',
            'country' => 'required|max:40',
            'name' => 'required|max:40',
        ]);

        DB::insert('INSERT INTO Repterek (city, country, name) VALUES (?, ?, ?)', [
            $validated['city'],
            $validated['country'],
            $validated['name']
        ]);

        return redirect()->route('airports.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'city' => 'sometimes|max:40',
            'country' => 'sometimes|max:40',
            'name' => 'sometimes|max:40',
        ]);

        $updates = [];
        foreach (['city', 'country', 'name'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Repterek SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return redirect()->route('airports.index');
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Repterek WHERE id = ?', [$id]);
        if ($deleted) {
            return redirect()->route('airports.index');
        } else {
            return response()->json(['message' => 'Reptér nem található'], 404);
        }
    }

    public function edit($id)
    {
        $airport = DB::select('SELECT * FROM Repterek WHERE id = ?', [$id]);


        if (empty($airport)) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        $airport = $airport[0];

        return view('airports.edit', compact('airport'));
    }

    public function getTotalDepartures()
    {

        $airports = DB::select('SELECT Results.name AS AirportName,
                   SUM(Results.Departures) AS TotalDepartures,
                   SUM(Results.Arrivals) AS TotalArrivals
            FROM (
                SELECT Repterek.name,
                       COUNT(Jaratok.id) AS Departures,
                       0 AS Arrivals
                FROM Jaratok
                JOIN Repterek ON Repterek.id = Jaratok.departure
                GROUP BY Repterek.name

                UNION ALL

                SELECT Repterek.name,
                       0 AS Departures,
                       COUNT(Jaratok.id) AS Arrivals
                FROM Jaratok
                JOIN Repterek ON Repterek.id = Jaratok.arrival
                GROUP BY Repterek.name
            ) Results
            GROUP BY Results.name

            ');

        Log::info($airports);



        return view('listings.airport_departures', compact('airports'));
    }
}
