@extends('layouts.app', ['activePage' => 'showRefueling', 'titlePage' => __('Tankolás megtekintése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h3 class="card-title d-flex justify-content-between">
                                {{ $refueling->date_time }} tankolás részletei
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="text-center">
                                <h3>{{ $refueling->date_time }} tankolás részletei</h3>
                            </div>
                            <div class="col-sm-12 col-md-6 offset-md-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Jármű:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $refueling->vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Tankolás időpontja:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $refueling->date_time }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">KM vagy üzemóra számláló állása:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $refueling->km_operating_hour }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Számláló 1 állása:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $refueling->trip1 }}</td>
                                        </tr>
                                        @if ($refueling->trip2 =! null)
                                            <tr>
                                                <td width="50%" class="text-right"><span
                                                        class="text-muted">Számláló 2 vagy éves számláló állása:</span>
                                                </td>
                                                <td width="50%" class="text-left">{{ $refueling->trip2 }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Tankolt mennyiség:</span></td>
                                            <td width="50%" class="text-left">{{ $refueling->refueled_quantity }} liter
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Üzemanyag egységára:</span></td>
                                            <td width="50%" class="text-left">{{ $refueling->fuel_cost }} Ft/liter</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Kedvezmény:</span></td>
                                            <td width="50%" class="text-left">{{ $refueling->discount }} Ft/liter</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Tankolás költsége:</span></td>
                                            <td width="50%" class="text-left">{{ $refueling->refuelling_cost }} Ft</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Átlagfogyasztás:</span></td>
                                            <td width="50%"
                                                class="text-left">{{ $refueling->average_consumption }} liter/100 km
                                            </td>
                                        </tr>
                                        @if ($refueling->fuel_type != null)
                                            <tr>
                                                <td width="50%" class="text-right"><span
                                                        class="text-muted">Tankolt üzemanyag fajtája:</span></td>
                                                <td width="50%" class="text-left">{{ $refueling->fuel_type }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route("refueling.index")}}" type="button" class="btn btn-info">Vissza
                                    a tankolásokhoz</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
