@extends('include.app')

@section('content')
    <div class="container">
        <h1>Search Results</h1>
        @if (empty($flights))
            <p>No flights found matching your criteria.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Flight ID</th>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Lowest Price</th>
                    <th>Airline Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <td>{{ $flight->flight_id }}</td>
                        <td>{{ $flight->departure_airport }}</td>
                        <td>{{ $flight->arrival_airport }}</td>
                        <td>${{ number_format($flight->lowest_price, 2) }}</td>
                        <td>{{ $flight->airline_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
