@extends('include.app')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Your Booking Details</h1>
        @if($userBookingDetails)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Flight Time</th>
                    <th>Seat Class</th>
                    <th>Insurance Package</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userBookingDetails as $booking)
                    <tr>
                        <td>{{ $booking->departure_airport }}</td>
                        <td>{{ $booking->arrival_airport }}</td>
                        <td>{{ $booking->flight_time }}</td>
                        <td>{{ $booking->seat_class }}</td>
                        <td>{{ $booking->insurance_package }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">You have no bookings.</div>
        @endif
    </div>
@endsection
