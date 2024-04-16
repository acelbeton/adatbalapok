@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Ticket</h1>

        <form id="editTicketForm" action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Flight ID -->
            <div class="form-group">
                <label for="flight_id">Flight ID:</label>
                <input type="number" class="form-control" id="flight_id" name="flight_id" value="{{ $ticket->flight_id }}" readonly>
            </div>

            <!-- Seat Number -->
            <div class="form-group">
                <label for="seat_number">Seat Number:</label>
                <input type="number" class="form-control" id="seat_number" name="seat_number" value="{{ $ticket->seat_number }}">
            </div>

            <!-- Plane ID -->
            <div class="form-group">
                <label for="plane_id">Plane ID:</label>
                <input type="number" class="form-control" id="plane_id" name="plane_id" value="{{ $ticket->plane_id }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
