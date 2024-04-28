<!-- resources/views/airplanes/edit.blade.php -->

@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Airplane</h1>

        <form id="editAirplaneForm" action="{{ route('airplanes.update', $airplane->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Manufacturer -->
            <div class="form-group">
                <label for="manufacturer">Manufacturer:</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                       value="{{ $airplane->manufacturer }}">
            </div>

            <!-- Commercial Capacity -->
            <div class="form-group">
                <label for="commercial_cap">Commercial Capacity:</label>
                <input type="number" class="form-control" id="commercial_cap" name="commercial_cap"
                       value="{{ $airplane->commercial_cap }}">
            </div>

            <!-- Business Capacity -->
            <div class="form-group">
                <label for="business_cap">Business Capacity:</label>
                <input type="number" class="form-control" id="business_cap" name="business_cap"
                       value="{{ $airplane->business_cap }}">
            </div>

            <!-- First Class Capacity -->
            <div class="form-group">
                <label for="first_class_cap">First Class Capacity:</label>
                <input type="number" class="form-control" id="first_class_cap" name="first_class_cap"
                       value="{{ $airplane->first_class_cap }}">
            </div>

            <!-- Maintainer -->
            <div class="form-group">
                <label for="maintainer">Maintainer:</label>
                <input type="text" class="form-control" id="maintainer" name="maintainer"
                       value="{{ $airplane->maintainer }}">
            </div>

            <!-- Plane Type -->
            <div class="form-group">
                <label for="plane_type">Plane Type:</label>
                <input type="text" class="form-control" id="plane_type" name="plane_type"
                       value="{{ $airplane->plane_type }}">
            </div>

            <!-- Consumption -->
            <div class="form-group">
                <label for="consumption">Consumption:</label>
                <input type="number" class="form-control" id="consumption" name="consumption"
                       value="{{ $airplane->consumption }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
