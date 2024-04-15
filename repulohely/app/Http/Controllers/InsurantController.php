<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsurantController extends Controller
{
    public function index()
    {
        $biztosítók = DB::select('SELECT * FROM Biztositok');
        return response()->json($biztosítók);
    }

    public function show($name)
    {
        $biztosito = DB::select('SELECT * FROM Biztositok WHERE name = ?', [$name]);

        if (empty($biztosito)) {
            return response()->json(['message' => 'Biztosító nem található'], 404);
        }

        return response()->json($biztosito[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:40|unique:Biztositok,name',
            'website' => 'nullable|max:160',
        ]);

        DB::insert('INSERT INTO Biztositok (name, website) VALUES (?, ?)', [
            $validated['name'],
            $validated['website'],
        ]);

        return response()->json(['success' => true], 201);
    }

    public function update(Request $request, $name)
    {
        $validated = $request->validate([
            'website' => 'nullable|max:160',
        ]);

        $updates = [];
        foreach (['website'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Biztositok SET '.implode(', ', $updates).' WHERE name = ?';
            DB::update($updateQuery, [$name]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($name)
    {
        $deleted = DB::delete('DELETE FROM Biztositok WHERE name = ?', [$name]);
        if ($deleted) {
            return response()->json(['message' => 'Biztosító törölve']);
        } else {
            return response()->json(['message' => 'Biztosító nem található'], 404);
        }
    }
}