
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Airlines</h1>

        <!-- Display all airlines -->
        <h2>All Airlines</h2>
        <ul>
            @foreach($airlines as $airline)
                <li>{{ $airline->name }}</li>
            @endforeach
        </ul>

        <!-- Form to add a new airline -->
        <h2>Add New Airline</h2>
        <form method="POST" action="{{ route('airlines.store') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Website:</label>
            <input type="text" name="website">
            <label>Rating:</label>
            <input type="number" name="rating">
            <label>Headquarters:</label>
            <input type="text" name="headquarters">
            <button type="submit">Add Airline</button>
        </form>

        <!-- Form to update an existing airline -->
        <h2>Update Airline</h2>
        <form method="POST" action="{{ route('airlines.update', ['id' => $airline->id]) }}">
            @csrf
            @method('PUT')
            <label>Name:</label>
            <input type="text" name="name" value="{{ $airline->name }}">
            <label>Website:</label>
            <input type="text" name="website" value="{{ $airline->website }}">
            <label>Rating:</label>
            <input type="number" name="rating" value="{{ $airline->rating }}">
            <label>Headquarters:</label>
            <input type="text" name="headquarters" value="{{ $airline->headquarters }}">
            <button type="submit">Update Airline</button>
        </form>

        <!-- Form to delete an existing airline -->
        <h2>Delete Airline</h2>
        <form method="POST" action="{{ route('airlines.destroy', ['id' => $airline->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Airline</button>
        </form>
    </div>
@endsection
