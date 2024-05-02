@extends('include.app')
@section('content')
    <div class="container" style="margin: 0 auto; padding:  10px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Biztosító neve</th>
                                <th>Biztosító weboldala</th>
                                <th>Átlagos ár</th>
                                <th>Legolcsóbb ár</th>
                                <th>Legdrágább ár</th>
                                <th>Csomagok száma</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userInsuranceDetails as $detail)
                                <tr>
                                    <td>{{ $detail->insurance_company_name }}</td>
                                    <td>{{ $detail->insurance_company_website }}</td>
                                    <td>{{ $detail->average_price }}</td>
                                    <td>{{ $detail->cheapest_price }}</td>
                                    <td>{{ $detail->most_expensive_price }}</td>
                                    <td>{{ $detail->package_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
