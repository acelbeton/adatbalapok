@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Airports</h1>

        <!-- Display all airports -->
        <table class="table">
            <thead>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($airports as $airport)
                <tr>
                    <td>{{ $airport->city }}</td>
                    <td>{{ $airport->country }}</td>
                    <td>{{ $airport->name }}</td>
                    <td>
                        <a href="{{ route('airports.edit', $airport->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('airports.destroy', $airport->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this airport?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new airport -->
        <h2>Add New Airport</h2>
        <form method="POST" action="{{ route('airports.store') }}">
            @csrf
            <label>City:</label>
            <input type="text" name="city" required>
            <label>Country:</label>
            <input type="text" name="country" required>
            <label>Name:</label>
            <input type="text" name="name" required>
            <button type="submit">Add Airport</button>
        </form>
    </div>
@endsection
