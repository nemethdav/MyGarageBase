@extends('layouts.app', ['activePage' => 'yearKM', 'titlePage' => __('Évi km szerkesztése')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">
                                 {{ $yearkm->vehicle->vehicleNickName }} {{ $yearkm->year }}-ban/ben megtett út módosítása
                            </h4>

                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form action="{{ route('yearkm.update', $yearkm->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="vehicle_id">
                                        Jármű kiválasztása
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select col-sm-8" name="vehicle_id" id="vehicle_id">
                                        <option>Járművek</option>
                                        @foreach($user_vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                            @if (old('vehicle_id') == null)
                                                {{ $vehicle->id == $yearkm->vehicle_id ? 'selected' : '' }}
                                                @else
                                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}
                                                @endif
                                            >
                                                {{ $vehicle->vehicleNickName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="year">
                                        Év
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <script>
                                                document.getElementById("year").max = new Date().getFullYear();
                                            </script>
                                            <input type="number" class="form-control" name="year"
                                                   id="year" required
                                                   min="1900"
                                                   max="{{ date("Y") }}"
                                                   value="{{ old('year') == null ? $yearkm->year : old('year') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div id="calc">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="start_km_operating_hour">
                                            Év eleji km óra állás
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control"
                                                       name="start_km_operating_hour"
                                                       id="start_km_operating_hour"
                                                       placeholder="KM óra állása az év elején" required
                                                       v-model="start_km_operating_hour"/>
                                            </div>
                                            @if(old('start_km_operating_hour') != null)
                                                <script>
                                                    let start_km_operating_hour = {!! json_encode(old('start_km_operating_hour', [])) !!};
                                                </script>
                                            @else
                                                <script>
                                                    let start_km_operating_hour = {{ $yearkm->start_km_operating_hour }};
                                                </script>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="end_km_operating_hour">
                                            Év végi km óra állás
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control"
                                                       name="end_km_operating_hour"
                                                       id="end_km_operating_hour"
                                                       placeholder="KM óra állása az év végén"
                                                       v-model="end_km_operating_hour"/>
                                            </div>
                                            @if(old('end_km_operating_hour') != null)
                                                <script>
                                                    let end_km_operating_hour = {!! json_encode(old('end_km_operating_hour', [])) !!};
                                                </script>
                                            @else
                                                <script>
                                                    let end_km_operating_hour = {{ $yearkm->end_km_operating_hour }};
                                                </script>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="year_km_operating_hour">
                                            Évközben megtett km
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control"
                                                       name="year_km_operating_hour"
                                                       id="year_km_operating_hour"
                                                       placeholder="Évközben megtett km"
                                                       v-model="year_km_operating_hour"/>
                                            </div>
                                            @if(old('end_km_operating_hour') != null)
                                                <script>
                                                    let year_km_operating_hour = {!! json_encode(old('year_km_operating_hour', [])) !!};
                                                </script>
                                            @else
                                                <script>
                                                    let year_km_operating_hour = {{ $yearkm->year_km_operating_hour }};
                                                </script>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @include('layouts.star')

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('yearkm.index') }}">
                                            <button type="button" class="btn btn-danger mt-2 ml-2" rel="tooltip"
                                                    title="Visszalépéssel az adatok nem kerülnek mentésre!">Visszalépés
                                            </button>
                                        </a>
                                        <button type="submit" class="btn btn-warning">Mentés</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        new Vue({
            el: '#calc',
            data: {
                start_km_operating_hour: start_km_operating_hour,
                end_km_operating_hour: end_km_operating_hour,
            },
            computed: {
                year_km_operating_hour: function () {
                    let yearKM = this.end_km_operating_hour - this.start_km_operating_hour
                    if (yearKM > 0)
                        return (yearKM);
                },
            }
        })
    </script>
@endsection
