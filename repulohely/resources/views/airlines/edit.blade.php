@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Airline</h1>

        <form id="editAirlineForm" action="{{ route('airlines.update.post', $airline->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $airline->name }}">
            </div>

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $airline->website }}">
            </div>

            <!-- Rating -->
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" class="form-control" id="rating" name="rating" value="{{ $airline->rating }}">
            </div>

            <!-- Headquarters -->
            <div class="form-group">
                <label for="headquarters">Headquarters:</label>
                <input type="text" class="form-control" id="headquarters" name="headquarters"
                       value="{{ $airline->headquarters }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
