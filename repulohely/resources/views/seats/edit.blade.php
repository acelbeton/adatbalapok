@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Seat</h1>

        <form method="POST" action="{{ route('seats.update', $seat->seat_number) }}">
            @csrf
            @method('PUT')

            <!-- Seat Class -->
            <div class="form-group">
                <label for="seat_class">Seat Class:</label>
                <input type="text" class="form-control" id="seat_class" name="seat_class" value="{{ $seat->seat_class }}">
            </div>

            <!-- Plane ID -->
            <div class="form-group">
                <label for="plane_id">Plane ID:</label>
                <input type="number" class="form-control" id="plane_id" name="plane_id" value="{{ $seat->plane_id }}">
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $seat->price }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Seat</button>
        </form>
    </div>
@endsection
