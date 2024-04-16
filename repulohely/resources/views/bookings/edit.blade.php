@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>

        <form id="editBookingForm"
              action="{{ route('bookings.update', ['user_id' => $booking->user_id, 'flight_id' => $booking->flight_id, 'plane_id' => $booking->plane_id, 'departure_time' => $booking->departure_time]) }}"
              method="POST">
            @csrf
            @method('PUT')

            <!-- User ID -->
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $booking->user_id }}"
                       readonly>
            </div>

            <!-- Flight ID -->
            <div class="form-group">
                <label for="flight_id">Flight ID:</label>
                <input type="text" class="form-control" id="flight_id" name="flight_id"
                       value="{{ $booking->flight_id }}" readonly>
            </div>

            <!-- Plane ID -->
            <div class="form-group">
                <label for="plane_id">Plane ID:</label>
                <input type="text" class="form-control" id="plane_id" name="plane_id" value="{{ $booking->plane_id }}"
                       readonly>
            </div>

            <!-- Departure Time -->
            <div class="form-group">
                <label for="departure_time">Departure Time:</label>
                <input type="text" class="form-control" id="departure_time" name="departure_time"
                       value="{{ explode(' ',$booking->departure_time)[0] }}" readonly>
            </div>

            <!-- Seat Number -->
            <div class="form-group">
                <label for="seat_number">Seat Number:</label>
                <input type="number" class="form-control" id="seat_number" name="seat_number"
                       value="{{ $booking->seat_number }}">
            </div>

            <!-- Insurance Package -->
            <div class="form-group">
                <label for="insurance_package">Insurance Package:</label>
                <input type="text" class="form-control" id="insurance_package" name="insurance_package"
                       value="{{ $booking->insurance_package }}">
            </div>

            <!-- Insurance Company -->
            <div class="form-group">
                <label for="insurance_company">Insurance Company:</label>
                <input type="text" class="form-control" id="insurance_company" name="insurance_company"
                       value="{{ $booking->insurance_company }}">
            </div>

            <!-- Class -->
            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" class="form-control" id="class" name="class" value="{{ $booking->class }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
