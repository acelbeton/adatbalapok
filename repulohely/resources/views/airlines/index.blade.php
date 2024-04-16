@extends('include.app')

@section('content')
    <div class="container">
        <h1>Airlines</h1>


        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Website</th>
                <th>Rating</th>
                <th>Headquarters</th>
            </tr>
            </thead>
            <tbody>
            @foreach($airlines as $airline)
                <tr>
                    <td>{{ $airline->name }}</td>
                    <td>{{ $airline->website }}</td>
                    <td>{{ $airline->rating }}</td>
                    <td>{{ $airline->headquarters }}</td>
                    <td>
                        <a href="{{ route('airlines.edit', $airline->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('airlines.destroy', $airline->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this airplane?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Form to add a new airline -->
        <h2>Add New Airline</h2>
        <form method="POST" action="{{ route('airlines.store') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Website:</label>
            <input type="text" name="website">
            <label>Rating:</label>
            <input type="number" name="rating" step="0.01">
            <label>Headquarters:</label>
            <input type="text" name="headquarters">
            <button type="submit">Add Airline</button>
        </form>

@endsection
