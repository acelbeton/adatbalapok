@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Flight Routes</h1>

        <!-- Display all flight routes -->
        <table class="table">
            <thead>
            <tr>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Flight Length</th>
                <th>Airline</th>
                <th>Child Friendly</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>{{ $route->departure }}</td>
                    <td>{{ $route->arrival }}</td>
                    <td>{{ $route->flight_length }}</td>
                    <td>{{ $route->airline }}</td>
                    <td>{{ $route->child_friendly }}</td>
                    <td>
                        <a href="{{ route('plane-routes.edit', $route->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('plane-routes.destroy', $route->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this flight route?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new flight route -->
        <h2>Add New Flight Route</h2>
        <form method="POST" action="{{ route('plane-routes.store') }}">
            @csrf
            <label>Departure:</label>
            <input type="number" name="departure" required>
            <label>Arrival:</label>
            <input type="number" name="arrival" required>
            <label>Flight Length:</label>
            <input type="number" name="flight_length" required>
            <label>Airline:</label>
            <input type="number" name="airline">
            <label>Child Friendly:</label>
            <input type="number" name="child_friendly" min="0" max="1">
            <button type="submit">Add Flight Route</button>
        </form>
    </div>
@endsection
