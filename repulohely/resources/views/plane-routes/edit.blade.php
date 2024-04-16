@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Plane Route</h1>

        <form id="editPlaneRouteForm" action="{{ route('plane-routes.update', $route->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Departure -->
            <div class="form-group">
                <label for="departure">Departure:</label>
                <input type="text" class="form-control" id="departure" name="departure" value="{{ $route->departure }}">
            </div>

            <!-- Arrival -->
            <div class="form-group">
                <label for="arrival">Arrival:</label>
                <input type="text" class="form-control" id="arrival" name="arrival" value="{{ $route->arrival }}">
            </div>

            <!-- Flight Length -->
            <div class="form-group">
                <label for="flight_length">Flight Length:</label>
                <input type="text" class="form-control" id="flight_length" name="flight_length" value="{{ $route->flight_length }}">
            </div>

            <!-- Airline -->
            <div class="form-group">
                <label for="airline">Airline:</label>
                <input type="text" class="form-control" id="airline" name="airline" value="{{ $route->airline }}">
            </div>

            <!-- Child Friendly -->
            <div class="form-group">
                <label for="child_friendly">Child Friendly:</label>
                <input type="text" class="form-control" id="child_friendly" name="child_friendly" value="{{ $route->child_friendly }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
