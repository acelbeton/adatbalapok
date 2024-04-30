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
                    <th>Last Flight Time</th>
                    <th>Class</th>
                    <th>Insurance Package</th>
                    <th>Total Bookings on This Flight</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userBookingDetails as $booking)
                    <tr>
                        <td>{{ $booking->departure_airport }}</td>
                        <td>{{ $booking->arrival_airport }}</td>
                        <td>{{ date('Y-m-d', strtotime($booking->departure_time)) }}</td>
                        <td>{{ $booking->seat_class }}</td>
                        <td>{{ $booking->insurance_package }}</td>
                        <td>{{ $booking->total_bookings_on_this_flight }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">You have no bookings.</div>
        @endif
    </div>
@endsection
