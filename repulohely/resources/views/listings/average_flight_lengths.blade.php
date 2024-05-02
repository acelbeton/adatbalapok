@extends('include.app')

@section('content')
    <div class="container">
        <h1>Average Flight Lengths by Airline</h1>
        @if(count($averageLengths) > 0)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Airline Name</th>
                    <th>Average Flight Length (Hours)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($averageLengths as $length)
                    <tr>
                        <td>{{ $length->airline_name }}</td>
                        <td>{{ number_format($length->average_flight_length, 2) }} hours</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No data available.</p>
        @endif
    </div>
@endsection
