<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = DB::select('SELECT * FROM Legitarsasagok');
        return view('airlines.index', ['airlines' => $airlines]);
    }


    public function show($id)
    {
        $legitarsasag = DB::select('SELECT * FROM Legitarsasagok WHERE id = ?', [$id]);

        if (empty($legitarsasag)) {
            return response()->json(['message' => 'Légitársaság nem található'], 404);
        }

        return response()->json($legitarsasag[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:40',
            'website' => 'nullable|max:160',
            'rating' => 'nullable|numeric',
            'headquarters' => 'nullable|max:40',
        ]);


        DB::insert('INSERT INTO Legitarsasagok (name, website, rating, headquarters) VALUES (?, ?, ?, ?)', [
            $validated['name'],
            $validated['website'],
            $validated['rating'],
            $validated['headquarters']
        ]);

        return redirect()->route('airlines.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|max:40',
            'website' => 'nullable|max:160',
            'rating' => 'nullable|numeric',
            'headquarters' => 'nullable|max:40',
        ]);


        $updates = [];
        foreach (['name', 'website', 'rating', 'headquarters'] as $field) {
            if (isset($validated[$field])) {
                $updates[] = "$field = '{$validated[$field]}'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Legitarsasagok SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return redirect()->route('airlines.index');
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Legitarsasagok WHERE id = ?', [$id]);
        if ($deleted) {
            return redirect()->route('airlines.index');
        } else {
            return response()->json(['message' => 'legitarsasag nem talalhato'], 404);
        }
    }

    public function edit($id)
    {
        $airline = DB::select('SELECT * FROM Legitarsasagok WHERE id = ?', [$id]);


        if (empty($airline)) {
            return response()->json(['message' => 'Airlines not found'], 404);
        }

        $airline = $airline[0];

        return view('airlines.edit', compact('airline'));
    }
}
