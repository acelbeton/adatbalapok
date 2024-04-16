<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $jegyek = DB::select('SELECT * FROM Jegyek');
        return response()->json($jegyek);
    }

    public function show($id)
    {
        $jegy = DB::select('SELECT * FROM Jegyek WHERE id = ?', [$id]);

        if (empty($jegy)) {
            return response()->json(['message' => 'Jegy nem található'], 404);
        }

        return response()->json($jegy[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|integer|exists:Jaratok,id',
            'seat_number' => 'required|integer|exists:Ulesek,seat_number',
            'plane_id' => 'required|integer|exists:Repulok,id',
        ]);

        DB::insert('INSERT INTO Jegyek (flight_id, seat_number, plane_id) VALUES (?, ?, ?)', [
            $validated['flight_id'],
            $validated['seat_number'],
            $validated['plane_id'],
        ]);

        return redirect()->route('tickets.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'flight_id' => 'sometimes|integer|exists:Jaratok,id',
            'seat_number' => 'sometimes|integer|exists:Ulesek,seat_number',
            'plane_id' => 'sometimes|integer|exists:Repulok,id',
        ]);

        $updates = [];
        foreach (['flight_id', 'seat_number', 'plane_id'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Jegyek SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return redirect()->route('tickets.index');
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Jegyek WHERE id = ?', [$id]);
        if ($deleted) {
            return redirect()->route('tickets.index');
        } else {
            return response()->json(['message' => 'Jegy nem található'], 404);
        }
    }
}
