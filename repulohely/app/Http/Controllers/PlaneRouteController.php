<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaneRouteController extends Controller
{
    public function index()
    {
        $jaratok = DB::select('SELECT * FROM Jaratok');
        return view('plane-routes.index', ['routes' => $jaratok]);
    }

    public function show($id)
    {
        $jarat = DB::select('SELECT * FROM Jaratok WHERE id = ?', [$id]);

        if (empty($jarat)) {
            return response()->json(['message' => 'Járat nem található'], 404);
        }

        return response()->json($jarat[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'departure' => 'required|integer',
            'arrival' => 'required|integer',
            'flight_length' => 'required|numeric',
            'airline' => 'nullable|integer',
            'child_friendly' => 'nullable|integer|min:0|max:1',
        ]);

        DB::insert('INSERT INTO Jaratok (departure, arrival, flight_length, airline, child_friendly) VALUES (?, ?, ?, ?, ?)', [
            $validated['departure'],
            $validated['arrival'],
            $validated['flight_length'],
            $validated['airline'],
            $validated['child_friendly'],
        ]);

        return response()->json(['success' => true], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'departure' => 'sometimes|integer',
            'arrival' => 'sometimes|integer',
            'flight_length' => 'sometimes|numeric',
            'airline' => 'nullable|integer',
            'child_friendly' => 'nullable|integer|min:0|max:1',
        ]);

        $updates = [];
        foreach (['departure', 'arrival', 'flight_length', 'airline', 'child_friendly'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Jaratok SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Jaratok WHERE id = ?', [$id]);
        if ($deleted) {
            return response()->json(['message' => 'Járat törölve']);
        } else {
            return response()->json(['message' => 'Járat nem található'], 404);
        }
    }

    public function edit($id)
    {
        $route = DB::select('SELECT * FROM Jaratok WHERE id = ?', [$id]);


        if (empty($route)) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        $route = $route[0];

        return view('plane-routes.edit', compact('route'));
    }
}
