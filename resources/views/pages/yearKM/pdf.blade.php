@extends('layouts.pdfBasic')

@section('title', $vehicle->vehicleNickName . ' - évente megtett távolságok')

@section('content')

    <h2>{{ $vehicle->vehicleNickName }} - évente megtett távolságok</h2>

    <table class="table-bordered">
        <thead>
        <tr>
            <th width="5%">Sorsz.</th>
            <th>Év</th>
            <th>Év eleji km</th>
            <th>Év végi km</th>
            <th>Év közben megtett távolság</th>
        </tr>
        </thead>
        <tbody>
        @foreach($yearKms as $yearKm)
            <tr>
                <td>{{ (($loop->index) + 1) }}</td>
                <td>{{ $yearKm->year }} </td>
                @if ($yearKm->start_km_operating_hour > 0)
                    <td>{{ number_format($yearKm->start_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                @else
                    <td></td>
                @endif
                @if ($yearKm->end_km_operating_hour > 0)
                <td>{{ number_format($yearKm->end_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                @else
                    <td></td>
                @endif
                @if ($yearKm->year_km_operating_hour > 0)
                    <td>{{ number_format($yearKm->year_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach

@endsection
