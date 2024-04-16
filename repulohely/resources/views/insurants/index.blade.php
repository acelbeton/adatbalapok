@extends('include.app')

@section('content')
    <div class="container">
        <h1>Insurance Companies</h1>

        <!-- Display all insurance companies -->
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($insurances as $insurance)
                <tr>
                    <td>{{ $insurance->name }}</td>
                    <td>{{ $insurance->website }}</td>
                    <td>
                        <a href="{{ route('insurants.edit', $insurance->name) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('insurants.destroy', $insurance->name) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this insurance company?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Form to add a new insurance company -->
        <h2>Add New Insurance Company</h2>
        <form method="POST" action="{{ route('insurants.store') }}">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Website:</label>
            <input type="text" name="website" maxlength="160">
            <button type="submit">Add Insurance Company</button>
        </form>
    </div>
@endsection
