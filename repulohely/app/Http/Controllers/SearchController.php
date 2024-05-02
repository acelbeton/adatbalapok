<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

class SearchController extends Controller
{
    public function searchFlights(Request $request)
    {
        $departureCity = $request->input('departure_city');
        $arrivalCity = $request->input('arrival_city');
        $departureDate = $request->input('departure_date');


        $flights = DB::select("
            SELECT j.*, le.name as airline_name, da.name AS departure_airport_name, aa.name AS arrival_airport_name,
                   (SELECT COUNT(*) FROM jaratok WHERE departure = da.id
                        AND TRUNC(departure_time) = TO_DATE(?, 'YYYY-MM-DD')) AS total_flights_from_departure
            FROM jaratok j
            JOIN repterek da ON j.departure = da.id
            JOIN repterek aa ON j.arrival = aa.id
            JOIN legitarsasagok le on j.airline = le.id
            WHERE da.city = ? AND aa.city = ? AND TRUNC(j.departure_time) = TO_DATE(?, 'YYYY-MM-DD')",
            [$departureDate, $departureCity, $arrivalCity, $departureDate]
        );
        foreach($flights as $value){
            $value->base_price= DB::executeFunction("base_price", ['child_friendly'=>$value->child_friendly, 'flight_length'=>$value->flight_length],PDO::PARAM_STR, 20);
        }


        return view('listings.search_results', compact('flights'));
    }

    public function searchCheapestFlights(Request $request)
    {
        $departureCity = $request->input('departure_city');
        $arrivalCity = $request->input('arrival_city');

        $flights = DB::select('
            SELECT j.id AS flight_id,
                   dep.name AS departure_airport,
                   arr.name AS arrival_airport,
                   MIN(u.price) AS lowest_price,
                   l.name AS airline_name
            FROM jaratok j
            JOIN ulesek u ON j.id = u.plane_id
            JOIN repterek dep ON j.departure = dep.id
            JOIN repterek arr ON j.arrival = arr.id
            JOIN legitarsasagok l ON j.airline = l.id
            WHERE dep.city = :departure_city AND arr.city = :arrival_city
            GROUP BY j.id, dep.name, arr.name, l.name
            ORDER BY lowest_price ASC
        ', [
            'departure_city' => $departureCity,
            'arrival_city' => $arrivalCity
        ]);

        return view('listings.cheapest_flight', compact('flights'));
    }

    public function averageFlightLengthByAirline()
    {
        $averageLengths = DB::select('
            SELECT l.name AS airline_name, AVG(j.flight_length) AS average_flight_length
            FROM jaratok j
            JOIN legitarsasagok l ON j.airline = l.id
            GROUP BY l.name
    ');

        return view('listings.average_flight_lengths', compact('averageLengths'));
    }


    public function childFriendlyFlights()
    {
        $flights = DB::select('
        SELECT r.name AS departure_airport, ra.name AS arrival_airport, COUNT(j.id) AS number_of_flights
        FROM jaratok j
        JOIN repterek r ON j.departure = r.id
        JOIN repterek ra ON j.arrival = ra.id
        WHERE j.child_friendly = 1
        GROUP BY r.name, ra.name
    ');

        $flights = collect($flights);

        return view('listings.child-friendly', compact('flights'));
    }

}
