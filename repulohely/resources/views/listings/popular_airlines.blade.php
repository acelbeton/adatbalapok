@extends('include.app')

@section('content')
    <div class="container">
        <h1>Airline Ratings and Flights</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Airline Name</th>
                <th>Rating</th>
                <th>Total Flights</th>
            </tr>
            </thead>
            <tbody>
            @foreach($airlineRatingsFlights as $flight)
                <tr>
                    <td>{{ $flight->airline_name }}</td>
                    <td>{{ $flight->airline_rating }}</td>
                    <td>{{ $flight->total_flights }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
