@extends('layouts.app', ['activePage' => 'showMotorwayVignette', 'titlePage' => __('Autópályamatrica megtekintése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h3 class="card-title d-flex justify-content-between">
                                Autópályamatrica részletei
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-12 col-md-6 offset-md-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Jármű beceneve:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $motorwayVignette->vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Jármű forgalmi rendszáma:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $motorwayVignette->vehicle->license_plate_number }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Matrica típusa:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $motorwayVignette->type }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Matrica érvényességének helye:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $motorwayVignette->location }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Érvényesség kezdete:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $motorwayVignette->start_date }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Érvényesség vége:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $motorwayVignette->end_date }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="h4 font-weight-bold align-middle text-center">
                                                    @if($motorwayVignette->end_date < date("Y-m-d H:i:s"))
                                                        <span class="text-danger">Az autópálya matrica lejárt!</span>
                                                    @elseif($days < 3)
                                                        <span class="text-warning">Az autópálya matrica hamarosan, {{ $days }} nap múlva lejár!</span>
                                                    @else
                                                        <span class="text-info">Az autópálya matrica még {{ $days }} napig érvényes!</span>
                                                    @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Vásárlás időpontja:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $motorwayVignette->date_of_purchase }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Matrica ára:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ number_format($motorwayVignette->price, 0, ',', ' ') }} Ft</td>
                                        </tr>
                                        </tbody>
                                        @if ($motorwayVignette->image != null)
                                            <tr>
                                                <td width="50%" class="text-right"><span
                                                        class="text-muted">Bizonylat fotó:</span>
                                                </td>
                                                <td width="50%" class="text-left">
                                                    <a href="{{ asset('storage/imgs/motorwayVignettes/' . $motorwayVignette->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/imgs/motorway2.png') }}"
                                                             alt="Autopalya_png" width="30px">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route("motorwayVignette.index")}}" type="button" class="btn btn-success">Vissza
                                    az autópálya matricákhoz</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
