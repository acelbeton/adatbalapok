<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Validálás
        $validatedData = $request->validate([
            'email' => 'required|email|unique:felhasznalok,email',
            'password' => 'required|min:6',
            'name' => 'required|max:40',
            'privilege' => 'sometimes|max:40',
        ]);

        // Adatfelvitel
        DB::insert('INSERT INTO Felhasznalok (email, password, name, privilege) VALUES (?, ?, ?, ?)', [
            $validatedData['email'],
            bcrypt($validatedData['password']), // Jelszó titkosítása
            $validatedData['name'],
            $validatedData['privilege'] ?? null,
        ]);

        return response()->json(['success' => true], 201);
    }

    public function index()
    {
        $felhasznalok = DB::select('SELECT * FROM Felhasznalok');
        return view('users', ['felhasznalok' => $felhasznalok]);
    }

    public function show($id)
    {
        $felhasznalo = DB::select('SELECT * FROM Felhasznalok WHERE id = ?', [$id]);

        if (empty($felhasznalo)) {
            return response()->json(['message' => 'Felhasználó nem található'], 404);
        }

        return response()->json($felhasznalo[0]);
    }

    public function update(Request $request, $id)
    {
        // Validálás
        $validatedData = $request->validate([
            'email' => 'email|unique:felhasznalok,email,'.$id,
            'password' => 'sometimes|min:6',
            'name' => 'sometimes|max:40',
            'privilege' => 'sometimes|max:40',
        ]);

        // Frissítendő adatok összeállítása
        $updates = [];
        foreach (['email', 'password', 'name', 'privilege'] as $field) {
            if (isset($validatedData[$field])) {
                $updates[] = "$field = '".($field === 'password' ? bcrypt($validatedData[$field]) : $validatedData[$field])."'";
            }
        }

        if (!empty($updates)) {
            $updateQuery = 'UPDATE Felhasznalok SET '.implode(', ', $updates).' WHERE id = ?';
            DB::update($updateQuery, [$id]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM Felhasznalok WHERE id = ?', [$id]);
        if ($deleted) {
            return response()->json(['message' => 'Felhasználó törölve']);
        } else {
            return response()->json(['message' => 'Felhasználó nem található'], 404);
        }
    }
}
