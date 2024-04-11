<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsurantPackageController extends Controller
{
    public function index()
    {
        $csomagok = DB::select('SELECT * FROM BiztosításiCsomagok');
        return response()->json($csomagok);
    }

    public function show($name, $insurance_company_name)
    {
        $csomag = DB::select('SELECT * FROM BiztosításiCsomagok WHERE name = ? AND insurance_company_name = ?', [$name, $insurance_company_name]);

        if (empty($csomag)) {
            return response()->json(['message' => 'Biztosítási csomag nem található'], 404);
        }

        return response()->json($csomag[0]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:40',
            'insurance_company_name' => 'required|max:40|exists:Biztositok,name',
            'price' => 'required|numeric',
        ]);

        DB::insert('INSERT INTO BiztosításiCsomagok (name, insurance_company_name, price) VALUES (?, ?, ?)', [
            $validated['name'],
            $validated['insurance_company_name'],
            $validated['price'],
        ]);

        return response()->json(['success' => true], 201);
    }

    public function update(Request $request, $name, $insurance_company_name)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
        ]);

        DB::update('UPDATE BiztosításiCsomagok SET price = ? WHERE name = ? AND insurance_company_name = ?', [
            $validated['price'],
            $name,
            $insurance_company_name,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($name, $insurance_company_name)
    {
        DB::delete('DELETE FROM BiztosításiCsomagok WHERE name = ? AND insurance_company_name = ?', [$name, $insurance_company_name]);
        return response()->json(['message' => 'Biztosítási csomag törölve']);
    }
}
