@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Főképernyő')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="breakpoints">
                <div class="d-block d-sm-none">XS</div> <!--d-block: display block; d-none: display-none; melyiknél jelenjen meg és melyiknél nem, a kicsi felől a nagy felé-->
                <div class="d-none d-sm-block d-md-none">SM</div>
                <div class="d-none d-md-block d-lg-none">MD</div>
                <div class="d-none d-lg-block d-xl-none">LG</div>
                <div class="d-none d-xl-block">XL</div>
            </div>
            <div class="row">

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">perm_identity</i>
                            </div>
                            <h4 class="card-title">Felhasználói profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-primary" href="{{route('profile.edit')}}" role="button">Szerkesztés</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">directions_car</i>
                            </div>
                            <h4 class="card-title">Járművek</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-warning mr-3" href="{{route('vehicle.index')}}" role="button">Járművek</a>
                                <a class="btn btn-outline-warning" href="{{route('vehicle.create')}}" role="button">Új
                                    jármű</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <img src="{{ asset('storage/imgs/fuelStation.png') }}" width="60px" class="mr-3">
                            </div>
                            <h4 class="card-title">Tankolások</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-info mr-3" href="{{route('refueling.index')}}" role="button">Tankolások</a>
                                <a class="btn btn-outline-info" href="{{route('refueling.create')}}" role="button">Új
                                    tankolás</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <img src="{{ asset('storage/imgs/motorway_png.png') }}" width="50px" class="mr-3">
                            </div>
                            <h4 class="card-title">Autópálya matricák</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-success mr-3" href="{{route('motorwayVignette.index')}}" role="button">Autópálya matricák</a>
                                <a class="btn btn-outline-success" href="{{route('motorwayVignette.create')}}" role="button">Új
                                    matrica</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header card-header-icon">
                            <div class="card-icon">
                                <span class="sidebar-mini"> KM </span>
                            </div>
                            <h4 class="card-title">Évente megtett KM-ek</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-dark mr-3" href="{{route('yearkm.index')}}" role="button">Megtett távolságok</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">build</i>
                            </div>
                            <h4 class="card-title">Szervizelések</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-info mr-3" href="{{route('services.index')}}" role="button">Szervizelések</a>
                                <a class="btn btn-outline-info" href="{{route('services.create')}}" role="button">Új
                                    szerviz</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">build</i>
                            </div>
                            <h4 class="card-title">Egyéb kiadások</h4>
                        </div>
                        <div class="card-body">
                            <div class="stats">
                                <a class="btn btn-outline-danger mr-3" href="{{route('otherCosts.index')}}" role="button">Egyéb kiadások</a>
                                <a class="btn btn-outline-danger" href="{{route('otherCosts.create')}}" role="button">Új
                                    kiadás</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
