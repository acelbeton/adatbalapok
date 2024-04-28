<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirplaneController extends Controller
{
    public function index()
    {
        $repulok = DB::select('SELECT * FROM Repulok');
        return view('airplanes.index', ['airplanes' => $repulok]);
    }

    public function show($id)
    {
        $repulo = DB::select('SELECT * FROM Repulok WHERE id = ?', [$id]);

        if (empty($repulo)) {
            return response()->json(['message' => 'Repülő nem található'], 404);
        }

        return response()->json($repulo[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'manufacturer' => 'required|max:40',
            'commercial_cap' => 'required|integer',
            'business_cap' => 'required|integer',
            'first_class_cap' => 'required|integer',
            'maintainer' => 'required|max:40',
            'plane_type' => 'required|max:40',
            'consumption' => 'required|numeric|min:0',
        ]);

        DB::insert('INSERT INTO Repulok (manufacturer, commercial_cap, business_cap, first_class_cap, maintainer, plane_type, consumption) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $validated['manufacturer'],
            $validated['commercial_cap'],
            $validated['business_cap'],
            $validated['first_class_cap'],
            $validated['maintainer'],
            $validated['plane_type'],
            $validated['consumption'],
        ]);

        return redirect()->route('airplanes.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'manufacturer' => 'sometimes|max:40',
            'commercial_cap' => 'sometimes|integer',
            'business_cap' => 'sometimes|integer',
            'first_class_cap' => 'sometimes|integer',
            'maintainer' => 'sometimes|max:40',
            'plane_type' => 'sometimes|max:40',
            'consumption' => 'sometimes|numeric|min:0',
        ]);

        $updates = [];
        foreach (['manufacturer', 'commercial_cap', 'business_cap', 'first_class_cap', 'maintainer', 'plane_type', 'consumption'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Repulok SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return redirect()->route('airplanes.index');
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Repulok WHERE id = ?', [$id]);
        if ($deleted) {
            return redirect()->route('airplanes.index');
        } else {
            return response()->json(['message' => 'Repülő nem található'], 404);
        }
    }

    public function edit($id)
    {
        $airplane = DB::select('SELECT * FROM Repulok WHERE id = ?', [$id]);

        if (empty($airplane)) {
            return response()->json(['message' => 'Airplane not found'], 404);
        }

        $airplane = $airplane[0];

        return view('airplanes.edit', compact('airplane'));
    }
}
