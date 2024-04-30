@extends('include.app')

@section('content')
<h1>Book Flight</h1>

<div>

    <h2>Selected Flight Details</h2>
    <p><strong>Departure Airport:</strong> {{ $flight[0]->departure_airport_name }}</p>
    <p><strong>Arrival Airport:</strong> {{ $flight[0]->arrival_airport_name }}</p>
    <p><strong>Departure Time:</strong> {{ $flight[0]->departure_time }}</p>
    <p><strong>Flight Length:</strong> {{ $flight[0]->flight_length }} hours</p>
    <p><strong>Airline:</strong> {{ $flight[0]->airline_name }}</p>
    <p><strong>Child Friendly:</strong> {{ $flight[0]->child_friendly ? 'Yes' : 'No' }}</p>
</div>

<hr>

<h2>Select Your Booking Options</h2>

<form action="{{ route('booking.storeBook') }}" method="POST">
    @csrf
    <input type="hidden" name="flight_id" value="{{ $flight[0]->id }}">
    <input type="hidden" name="plane_id" value="{{ $flight[0]->id }}">
    <input type="hidden" name="departure_time" value="{{ date('Y-m-d', strtotime($flight[0]->departure_time))}}">

    <label for="seat_number">Seat Number:</label>
    <input type="text" id="seat_number" name="seat_number" required>

    <label for="insurance_package">Insurance Package:</label>
    <input type="text" id="insurance_package" name="insurance_package" required>

    <label for="insurance_company">Insurance Company:</label>
    <input type="text" id="insurance_company" name="insurance_company" required>

    <select id="class" name="class" required>
        <option value="Economy">Economy</option>
        <option value="Business">Business</option>
        <option value="First">First</option>
    </select>

    <button type="submit">Confirm Booking</button>
</form>
@endsection

