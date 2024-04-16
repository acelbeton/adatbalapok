<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function index()
    {
        $ulesek = DB::select('SELECT * FROM Ulesek');
        return response()->json($ulesek);
    }

    public function show($seat_number)
    {
        $ules = DB::select('SELECT * FROM Ulesek WHERE seat_number = ?', [$seat_number]);

        if (empty($ules)) {
            return response()->json(['message' => 'Ülés nem található'], 404);
        }

        return response()->json($ules[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'seat_class' => 'required|max:40',
            'plane_id' => 'required|integer|exists:Repulok,id',
            'price' => 'required|numeric',
        ]);

        DB::insert('INSERT INTO Ulesek (seat_class, plane_id, price) VALUES (?, ?, ?)', [
            $validated['seat_class'],
            $validated['plane_id'],
            $validated['price'],
        ]);

        return redirect()->route('seats.index');
    }

    public function update(Request $request, $seat_number)
    {
        $validated = $request->validate([
            'seat_class' => 'sometimes|max:40',
            'plane_id' => 'sometimes|integer|exists:Repulok,id',
            'price' => 'sometimes|numeric',
        ]);

        $updates = [];
        foreach (['seat_class', 'plane_id', 'price'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Ulesek SET '.implode(', ', $updates).' WHERE seat_number = ?';
            DB::update($updateQuery, [$seat_number]);
        }

        return redirect()->route('seats.index');
    }

    public function destroy($seat_number)
    {
        $deleted = DB::delete('DELETE FROM Ulesek WHERE seat_number = ?', [$seat_number]);
        if ($deleted) {
            return redirect()->route('seats.index');
        } else {
            return response()->json(['message' => 'Ülés nem található'], 404);
        }
    }
}
