@extends('layouts.app', ['activePage' => 'showOtherCosts', 'titlePage' => __('Kiválasztott szervizelés metekintése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h3 class="card-title d-flex justify-content-between">
                                {{ $service->service_title }} szervizelés részletei
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-12 col-md-6 offset-md-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Jármű neve:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $service->vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Szerviz neve</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $service->service_name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Szervizelés címe</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $service->service_title }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Szervizelés dátuma:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $service->service_date }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Km/üzemóra állása:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $service->km_operatinghour }} Km/Üzemóra</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Szervizelés leírása:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $service->description }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Ár:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ number_format($service->price, 0, ',', ' ') }} Ft</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route("services.index")}}" type="button" class="btn btn-info">Vissza
                                    a kiadásokhoz</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
