@extends('layouts.pdfBasic')

@section('title', $vehicle->vehicleNickName . ' - autópálya matricák')

@section('content')

    <h2>{{ $vehicle->vehicleNickName }} - autópálya matricák</h2>

    <table class="table-bordered">
        <thead>
        <tr>
            <th width="5%">Sorsz.</th>
            <th>Típus</th>
            <th>Kategória</th>
            <th>Érvényesség helye</th>
            <th>Érvényesség kezdete</th>
            <th>Érvényesség vége</th>
            <th>Érvényesség</th>
            <th>Vásárlás ideje</th>
            <th>Matrica ára</th>
        </tr>
        </thead>
        <tbody>
        @foreach($motorwayVignettes as $motorwayVignette)
            <tr>
                <td>{{ (($loop->index)) + 1 }}</td>
                <td>{{ $motorwayVignette->type }}</td>
                <td>{{ $motorwayVignette->category }}</td>
                <td>{{ $motorwayVignette->location }}</td>
                <td>{{ $motorwayVignette->start_date }}</td>
                <td>{{ $motorwayVignette->end_date }}</td>
                <td>
                    {{ $motorwayVignette->end_date }} -
                    @if ($motorwayVignette->end_date < date("Y-m-d H:i:s"))
                        <span class="text-danger font-weight-bold">Lejárt!</span>
                    @else
                        <span class="text-success font-weight-bold">Érvényes!</span>
                    @endif
                </td>
                <td>{{ $motorwayVignette->date_of_purchase }}</td>
                <td>{{ number_format($motorwayVignette->price, 0, ',', ' ') }} Ft</td>
            </tr>
    @endforeach


@endsection
