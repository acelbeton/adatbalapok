@extends('include.app')
@section('title', 'Child-Friendly Flights')

@section('content')
    <h1>Child-Friendly Flights Overview</h1>
    @if (empty($flights))
        <p>No child-friendly flights available at the moment.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Number of Flights</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <td>{{ $flight->departure_airport }}</td>
                        <td>{{ $flight->arrival_airport }}</td>
                        <td>{{ $flight->number_of_flights }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
