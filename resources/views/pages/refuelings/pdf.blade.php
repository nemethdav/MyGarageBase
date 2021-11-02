@extends('layouts.pdfBasic')

@section('title', $vehicle->vehicleNickName . ' - tankolások')

@section('content')

<h2>{{ $vehicle->vehicleNickName }} - tankolások</h2>

<table class="table-bordered">
    <thead>
    <tr>
        <th width="5%">Sorsz.</th>
        <th>Tankolás időpontja</th>
        <th>Km/üzemóra</th>
        <th>Tankolás óta</th>
        <th>Tankolt mennyiség</th>
        <th>Átlagfogyasztás</th>
        <th>Egységár</th>
        <th>Kedvezmény</th>
        <th>Fizetendő</th>
        <th>Üzemanyag</th>
    </tr>
    </thead>
    <tbody>
    @foreach($refuelings as $refueling)
        <tr>
            <td>{{ (($loop->index)) + 1 }}</td>
            <td>{{ $refueling->date_time }}</td>
            <td>{{ number_format($refueling->km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
            <td>{{ $refueling->trip1 }} km/üzemóróra</td>
            <td>{{ $refueling->refueled_quantity }} liter</td>
            <td>{{ $refueling->average_consumption }} l/100km/üzemóra</td>
            <td>{{ $refueling->fuel_cost }} Ft/l</td>
            @if($refueling->discount != 0)
                <td>{{ $refueling->discount }} Ft</td>
            @else
                <td>0 Ft</td>
            @endif
            <td>{{ number_format($refueling->refuelling_cost, 0, ',', ' ') }} Ft</td>
            <td>{{ $refueling->fuel_type }}</td>
        </tr>
    @endforeach

@endsection
