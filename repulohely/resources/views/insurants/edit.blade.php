@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Insurance</h1>

        <form id="editInsuranceForm" action="{{ route('insurants.update', $insurance->name) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $insurance->name }}">
            </div>

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $insurance->website }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
