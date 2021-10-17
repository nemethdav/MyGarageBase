@extends('layouts.app', ['activePage' => 'showOtherCosts', 'titlePage' => __('Egyéb költség metekintése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h3 class="card-title d-flex justify-content-between">
                                Kiválasztott költség részletei
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="text-center">
                                <h3>Kiválasztott költség részletei</h3>
                            </div>
                            <div class="col-sm-12 col-md-6 offset-md-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Jármű beceneve:</span>
                                            </td>
                                            <td width="50%"
                                                class="text-left">{{ $otherCost->vehicle->vehicleNickName }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Költség megnevezése:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $otherCost->title }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span class="text-muted">Költség részletes leírása</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $otherCost->description }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Ár: </span>
                                            </td>
                                            <td width="50%" class="text-left">{{ number_format($otherCost->price, 0, ',', ' ') }} Ft</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="text-right"><span
                                                    class="text-muted">Kiadás dátuma:</span>
                                            </td>
                                            <td width="50%" class="text-left">{{ $otherCost->date }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route("otherCosts.index")}}" type="button" class="btn btn-danger">Vissza
                                    a kiadásokhoz</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
