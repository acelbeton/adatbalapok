@extends('include.app')

@section('content')
    <div class="container">
        <h1>Tickets</h1>

        <!-- Display all tickets -->
        <table class="table">
            <thead>
            <tr>
                <th>Flight ID</th>
                <th>Seat Number</th>
                <th>Plane ID</th>
                <th>CO2 emission</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->flight_id }}</td>
                    <td>{{ $ticket->seat_number }}</td>
                    <td>{{ $ticket->plane_id }}</td>
                    <td>{{ $ticket->co2_emission }}</td>
                    <td>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this ticket?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new ticket -->
        <h2>Add New Ticket</h2>
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <label>Flight ID:</label>
            <input type="number" name="flight_id" required>
            <label>Seat Number:</label>
            <input type="number" name="seat_number" required>
            <label>Plane ID:</label>
            <input type="number" name="plane_id" required>
            <button type="submit">Add Ticket</button>
        </form>
    </div>
@endsection
