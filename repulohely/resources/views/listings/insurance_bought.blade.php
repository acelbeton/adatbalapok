@extends('include.app')

@section('content')
    <div class="container">
        <h1>Insurance Packages Bought</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Insurance Package</th>
                <th>Count of Purchases</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sum as $item)
                <tr>
                    <td>{{ $item->insurance_package }}</td>
                    <td>{{ $item->pricecount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
