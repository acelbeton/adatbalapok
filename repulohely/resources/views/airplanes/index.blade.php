<!-- resources/views/airplanes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Airplanes</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Manufacturer</th>
                <th>Commercial Capacity</th>
                <th>Business Capacity</th>
                <th>First Class Capacity</th>
                <th>Maintainer</th>
                <th>Plane Type</th>
                <th>Plane Capacity</th>
                <th>Consumption</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($airplanes as $airplane)
                <tr>
                    <td>{{ $airplane->manufacturer }}</td>
                    <td>{{ $airplane->commercial_cap }}</td>
                    <td>{{ $airplane->business_cap }}</td>
                    <td>{{ $airplane->first_class_cap }}</td>
                    <td>{{ $airplane->maintainer }}</td>
                    <td>{{ $airplane->plane_type }}</td>
                    <td>{{ $airplane->plane_capacity }}</td>
                    <td>{{ $airplane->consumption }}</td>
                    <td>
                        <a href="{{ route('airplanes.edit', $airplane->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('airplanes.destroy', $airplane->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this airplane?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Add New Airplane</h1>
        <form method="POST" action="{{ route('airplanes.store') }}">
            @csrf
            <div class="form-group">
                <label for="manufacturer">Manufacturer:</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}">
            </div>
            <div class="form-group">
                <label for="commercial_cap">Commercial Capacity:</label>
                <input type="number" class="form-control" id="commercial_cap" name="commercial_cap" value="{{ old('commercial_cap') }}">
            </div>
            <div class="form-group">
                <label for="business_cap">Business Capacity:</label>
                <input type="number" class="form-control" id="business_cap" name="business_cap" value="{{ old('business_cap') }}">
            </div>
            <div class="form-group">
                <label for="first_class_cap">First Class Capacity:</label>
                <input type="number" class="form-control" id="first_class_cap" name="first_class_cap" value="{{ old('first_class_cap') }}">
            </div>
            <div class="form-group">
                <label for="maintainer">Maintainer:</label>
                <input type="text" class="form-control" id="maintainer" name="maintainer" value="{{ old('maintainer') }}">
            </div>
            <div class="form-group">
                <label for="plane_type">Plane Type:</label>
                <input type="text" class="form-control" id="plane_type" name="plane_type" value="{{ old('plane_type') }}">
            </div>
            <div class="form-group">
                <label for="plane_capacity">Plane Capacity:</label>
                <input type="number" class="form-control" id="plane_capacity" name="plane_capacity" value="{{ old('plane_capacity') }}">
            </div>
            <div class="form-group">
                <label for="consumption">Consumption:</label>
                <input type="number" class="form-control" id="consumption" name="consumption" value="{{ old('consumption') }}">
            </div>
            <button type="submit" class="btn btn-primary">Add Airplane</button>
        </form>
    </div>





@endsection
