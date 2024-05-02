<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InsurantController extends Controller
{
    public function index()
    {
        $biztositok = DB::select('SELECT * FROM Biztositok');
        return view('insurants.index', ['insurances' => $biztositok]);
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

        return redirect()->route('insurants.index');
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

        return redirect()->route('insurants.index');
    }

    public function destroy($name)
    {
        $deleted = DB::delete('DELETE FROM Biztositok WHERE name = ?', [$name]);
        if ($deleted) {
            return redirect()->route('insurants.index');
        } else {
            return response()->json(['message' => 'Biztosító törölve']);
        }
    }
    public function edit($name)
    {
        $insurance = DB::select('SELECT * FROM Biztositok WHERE name = ?', [$name]);

        if (empty($insurance)) {
            return response()->json(['message' => 'Insurance not found'], 404);
        }

        $insurance = $insurance[0];

        return view('insurants.edit', compact('insurance'));
    }

    public function getInsuranceDetails() {

        $userId = Auth::id();

        $userInsuranceDetails = DB::select("
            SELECT
                ic.name AS insurance_company_name,
                ic.website AS insurance_company_website,
                ip.name AS insurance_package_name,
                AVG(ip.price) AS average_price,
                MIN(ip.price) AS cheapest_price,
                MAX(ip.price) AS most_expensive_price,
                COUNT(ip.name) AS package_count
            FROM
                InsurancePackages ip
            JOIN
                InsuranceCompanies ic ON ip.insurance_company_name = ic.name
            GROUP BY
                ic.name, ic.website, ip.name;
        ", ['userId' => $userId]);

        return view('listings.user_insurance', compact('userInsuranceDetails'));

    }

    public function getPaidInsurance(){

        $sum = DB::select('SELECT
        insurance_package,
        count(price) AS pricecount
        FROM Foglalasok
        INNER JOIN BiztositasiCsomagok ON BiztositasiCsomagok.name = Foglalasok.insurance_package
        GROUP BY insurance_package

        ');

        return view('listings.insurance_bought', compact('sum'));
    }
}
