@extends('include.app')

@section('content')

    <div class="container mt-5">
        <h1>Airport Departures and Arrivals</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Airport Name</th>
                <th>Total Departures</th>
                <th>Total Arrivals</th>
            </tr>
            </thead>
            <tbody>
            @foreach($airports as $airport)
                <tr>
                    <td>{{ $airport->airportname }}</td>
                    <td>{{ $airport->totaldepartures }}</td>
                    <td>{{ $airport->totalarrivals }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
