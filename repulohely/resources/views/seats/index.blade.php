@extends('include.app')

@section('content')
    <div class="container">
        <h1>Seats</h1>

        <!-- Display all seats -->
        <table class="table">
            <thead>
            <tr>
                <th>Seat Class</th>
                <th>Plane ID</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seats as $seat)
                <tr>
                    <td>{{ $seat->seat_class }}</td>
                    <td>{{ $seat->plane_id }}</td>
                    <td>{{ $seat->price }}</td>
                    <td>
                        <a href="{{ route('seats.edit', $seat->seat_number) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('seats.destroy', $seat->seat_number) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this seat?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new seat -->
        <h2>Add New Seat</h2>
        <form method="POST" action="{{ route('seats.store') }}">
            @csrf
            <label>Seat Class:</label>
            <input type="text" name="seat_class" required>
            <label>Plane ID:</label>
            <input type="number" name="plane_id" required>
            <label>Price:</label>
            <input type="number" name="price" required>
            <button type="submit">Add Seat</button>
        </form>
    </div>
@endsection
