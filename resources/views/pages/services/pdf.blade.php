@extends('layouts.pdfBasic')

@section('title', $vehicle->vehicleNickName . ' - szervizelések')

@section('content')

    <h2>{{ $vehicle->vehicleNickName }} - szervizelések</h2>

    <table class="table-bordered">
        <thead>
        <tr>
            <th width="5%">Sorsz.</th>
            <th>Szervizelés megnevezése</th>
            <th>Szervív neve</th>
            <th>Szervizelés időpontja</th>
            <th>Km óra állás</th>
            <th>Szervizelés leírása</th>
            <th>Szervizelés költsége</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{ (($loop->index)) + 1 }}</td>
                <td>{{ $service->service_title }}</td>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->service_date }}</td>
                <td>{{ number_format($service->km_operatinghour, 0, ',', ' ') }} km/üzemóra</td>
                <td>{{ $service->description }}</td>
                <td>{{ number_format($service->price, 0, ',', ' ') }} Ft</td>
            </tr>
    @endforeach

@endsection
