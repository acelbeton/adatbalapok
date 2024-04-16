<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsurantPackageController extends Controller
{
    public function index()
    {
        $csomagok = DB::select('SELECT * FROM BiztositasiCsomagok');
        return view('insurant-packages.index', ['packages' => $csomagok]);
    }

    public function show($name, $insurance_company_name)
    {
        $csomag = DB::select('SELECT * FROM BiztositasiCsomagok WHERE name = ? AND insurance_company_name = ?', [$name, $insurance_company_name]);

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

        DB::insert('INSERT INTO BiztositasiCsomagok (name, insurance_company_name, price) VALUES (?, ?, ?)', [
            $validated['name'],
            $validated['insurance_company_name'],
            $validated['price'],
        ]);

        return redirect()->route('insurant-packages.index');
    }

    public function update(Request $request, $name, $insurance_company_name)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
        ]);

        DB::update('UPDATE BiztositasiCsomagok SET price = ? WHERE name = ? AND insurance_company_name = ?', [
            $validated['price'],
            $name,
            $insurance_company_name,
        ]);

        return redirect()->route('insurant-packages.index');
    }

    public function destroy($name, $insurance_company_name)
    {
        DB::delete('DELETE FROM BiztositasiCsomagok WHERE name = ? AND insurance_company_name = ?', [$name, $insurance_company_name]);
        return redirect()->route('insurant-packages.index');
    }

    public function edit($name, $insurance_company_name)
    {
        $insurancePackage = DB::select('SELECT * FROM BiztositasiCsomagok WHERE name = ? AND insurance_company_name = ?', [$name, $insurance_company_name]);

        if (empty($insurancePackage)) {
            return response()->json(['message' => 'Insurance package not found'], 404);
        }

        $insurancePackage = $insurancePackage[0];

        return view('insurant-packages.edit', compact('insurancePackage'));
    }
}
