@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bookings</h1>

        <!-- Display all bookings -->
        <table class="table">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Flight ID</th>
                <th>Plane ID</th>
                <th>Departure Time</th>
                <th>Seat Number</th>
                <th>Insurance Package</th>
                <th>Insurance Company</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->user_id }}</td>
                    <td>{{ $booking->flight_id }}</td>
                    <td>{{ $booking->plane_id }}</td>
                    <td>{{ $booking->departure_time }}</td>
                    <td>{{ $booking->seat_number }}</td>
                    <td>{{ $booking->insurance_package }}</td>
                    <td>{{ $booking->insurance_company }}</td>
                    <td>{{ $booking->class }}</td>
                    <td>
                        <a href="{{ route('bookings.edit', ['user_id' => $booking->user_id, 'flight_id' => $booking->flight_id, 'plane_id' => $booking->plane_id, 'departure_time' => $booking->departure_time]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('bookings.destroy', ['user_id' => $booking->user_id, 'flight_id' => $booking->flight_id, 'plane_id' => $booking->plane_id, 'departure_time' => $booking->departure_time]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new booking -->
        <h2>Add New Booking</h2>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <label>User ID:</label>
            <input type="number" name="user_id" required>
            <label>Flight ID:</label>
            <input type="number" name="flight_id" required>
            <label>Plane ID:</label>
            <input type="number" name="plane_id" required>
            <label>Departure Time:</label>
            <input type="datetime-local" name="departure_time" required>
            <label>Seat Number:</label>
            <input type="number" name="seat_number" required>
            <label>Insurance Package:</label>
            <input type="text" name="insurance_package">
            <label>Insurance Company:</label>
            <input type="text" name="insurance_company">
            <label>Class:</label>
            <input type="text" name="class" required>
            <button type="submit">Add Booking</button>
        </form>
    </div>
@endsection
