@extends('include.app')

@section('content')
    <div class="container mt-3">
        <h2>Flight Search Results</h2>

        @if ($flights && count($flights) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Departure Time</th>
                    <th>Flight Length</th>
                    <th>Airline</th>
                    <th>Child Friendly</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <td>{{ $flight->departure_airport_name }}</td>
                        <td>{{ $flight->arrival_airport_name }}</td>
                        <td>{{ date('Y-m-d', strtotime($flight->departure_time)) }}</td>
                        <td>{{ $flight->flight_length }} hours</td>
                        <td>{{ $flight->airline_name }}</td>
                        <td>{{ $flight->child_friendly ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('booking.book', [
                                'flightID' => $flight->id,
                                'departureCity' => $flight->departure_airport_name,
                                'arrivalCity' => $flight->arrival_airport_name,
                                'departureDate' => $flight->departure_time
                            ]) }}" class="btn btn-primary">Book</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No flights found for your search criteria.</p>
        @endif
    </div>
@endsection
