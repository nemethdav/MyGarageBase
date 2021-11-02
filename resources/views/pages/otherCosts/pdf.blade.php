@extends('layouts.pdfBasic')

@section('title', $vehicle->vehicleNickName . ' - egyéb kiadások')

@section('content')

    <h2>{{ $vehicle->vehicleNickName }} - egyéb kiadásai</h2>

    <table class="table-bordered">
        <thead>
        <tr>
            <th width="5%">Sorsz.</th>
            <th>Kiadás megnevezése</th>
            <th>Kiadás leírása</th>
            <th>Fizetendő</th>
            <th>Kiadás dátuma</th>
        </tr>
        </thead>
        <tbody>
        @foreach($otherCosts as $otherCost)
            <tr>
                <td>{{ (($loop->index)) + 1 }}</td>
                <td>{{ $otherCost->title }}</td>
                <td>{{ $otherCost->description }}</td>
                <td>{{ number_format($otherCost->price, 0, ',', ' ') }} Ft</td>
                <td>{{ $otherCost->date }}</td>

            </tr>
    @endforeach

@endsection
