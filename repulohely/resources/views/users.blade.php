@extends('include.app')

@section('content')
    <div class="container">
        <h1>Felhasználók listája</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Privilege</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($felhasznalok as $felhasznalo)
                <tr>
                    <td>{{ $felhasznalo->id }}</td>
                    <td>{{ $felhasznalo->email }}</td>
                    <td>{{ $felhasznalo->name }}</td>
                    <td>{{ $felhasznalo->privilege ?? 'N/A' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
