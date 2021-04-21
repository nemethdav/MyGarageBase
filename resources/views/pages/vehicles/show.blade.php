@extends('layouts.app', ['activePage' => 'showVehicle', 'titlePage' => __('Jármű megtekintése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h3 class="card-title d-flex justify-content-between">
                                {{ $vehicle->vehicleNickName }} – {{ $vehicle->license_plate_number }}
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="text-center">
                                @if ($vehicle->vehicle_image == null)
                                    <img src="{{ asset("storage/imgs/vehicles/default.png") }}"
                                         alt="Alapértelmezett jármű kép">
                                @else
                                    <img src="{{ asset("storage/imgs/vehicles/" . $vehicle->vehicle_image) }}"
                                         alt="{{ $vehicle->vehicleNickName }}  –  {{ $vehicle->license_plate_number }} jármű képe">
                                @endif
                            </div>

                            <div class="text-center">
                                <h3>{{ $vehicle->manufacturer }} {{ $vehicle->type }}</h3>
                            </div>
                            <div class="col-6 offset-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Becenév:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Fajtája:</span></td>
                                            <td width="50%" class="text-left">
                                                @if ($vehicle->vehicle_type == 1)
                                                    Motorkerékpár
                                                @elseif($vehicle->vehicle_type == 2)
                                                    Személygépjármű
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Gyártási év:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $vehicle->year_of_manufacture }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Becenév: </span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Alvázszám:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $vehicle->chassis_number }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Motorszám:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $vehicle->motor_number }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Hengerűrtartalom: </span></td>
                                            <td width="50%" class="text-left">{{ $vehicle->cylinder_capacity }}
                                                cm<sup>3</sup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Teljesítmény: </span></td>
                                            <td width="50%" class="text-left">{{ $vehicle->performance_kw }} kW</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Teljesítmény: </span></td>
                                            <td width="50%" class="text-left">{{ $vehicle->performance_le }} LE</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Műszaki vizsga érvényessége: </span></td>
                                            <td width="50%"
                                                class="text-left">{{ $vehicle->validity_of_technical_Examination }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Vásárlás dátuma: </span></td>
                                            <td width="50%" class="text-left">{{ $vehicle->date_of_purchase }}</td>
                                        </tr>
                                        @if ($vehicle->date_of_purchase != null)
                                            <tr>
                                                <td width="50%" class="text-right"><span
                                                        class="text-muted">Eladás dátuma: </span></td>
                                                <td width="50%" class="text-left">{{ $vehicle->date_of_purchase }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route("vehicle.index")}}" type="button" class="btn btn-info">Vissza
                                    a járművekhez</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
