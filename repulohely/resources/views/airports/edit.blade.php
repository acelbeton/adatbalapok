@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Airport</h1>

        <form id="editAirportForm" action="{{ route('airports.update', $airport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- City -->
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $airport->city }}">
            </div>

            <!-- Country -->
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country" value="{{ $airport->country }}">
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $airport->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
