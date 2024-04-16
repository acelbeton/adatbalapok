@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Insurance Packages</h1>

        <!-- Display all insurance packages -->
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Insurance Company Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{ $package->name }}</td>
                    <td>{{ $package->insurance_company_name }}</td>
                    <td>{{ $package->price }}</td>
                    <td>
                        <a href="{{ route('insurant-packages.edit', ['name' => $package->name, 'insurance_company_name' => $package->insurance_company_name]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('insurant-packages.destroy', ['name' => $package->name, 'insurance_company_name' => $package->insurance_company_name]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this insurance package?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new insurance package -->
        <h2>Add New Insurance Package</h2>
        <form method="POST" action="{{ route('insurant-packages.store') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Insurance Company Name:</label>
            <input type="text" name="insurance_company_name" required>
            <label>Price:</label>
            <input type="number" name="price" required>
            <button type="submit">Add Insurance Package</button>
        </form>
    </div>
@endsection
