@extends('include.app')

@section('content')
    <div class="container">
        <h1>Edit Insurance Package</h1>

        <form id="editInsurancePackageForm"
              action="{{ route('insurant-packages.update', ['name' => $insurancePackage->name, 'insurance_company_name' => $insurancePackage->insurance_company_name]) }}"
              method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $insurancePackage->name }}">
            </div>

            <!-- Insurance Company Name -->
            <div class="form-group">
                <label for="insurance_company_name">Insurance Company Name:</label>
                <input type="text" class="form-control" id="insurance_company_name" name="insurance_company_name"
                       value="{{ $insurancePackage->insurance_company_name }}" readonly>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price"
                       value="{{ $insurancePackage->price }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
