@extends('layouts.app', ['activePage' => 'editVehicle', 'titlePage' => __('Jármű szerkesztése')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">
                                {{ $vehicle->vehicleNickName }}
                            </h4>

                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form novalidate action="{{ route('vehicle.update', $vehicle->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                @if($vehicle->vehicle_image==null)
                                    <img src="{{ asset('storage/imgs/vehicles/default.png') }}" width="100"
                                         alt="Jármű kép" class="mb-3">
                                @else
                                    <img src="{{ asset('storage/imgs/vehicles/' . $vehicle->vehicle_image) }}"
                                         width="100" alt="Jármű kép" class="mb-3">
                                @endif
                                <br>
                                <label for="vehicle_image">Jármű profilkép megváltoztatása</label><br>
                                <input type="file" id="vehicle_image" name="vehicle_image" accept="image/*">

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="vehicleNickName">Becenév</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="vehicleNickName"
                                                   id="vehicleNickName"
                                                   placeholder="Jármű beceneve"
                                                   value="{{ old('vehicleNickName') == null ? $vehicle->vehicleNickName : old('vehicleNickName') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <select class="custom-select" name="vehicle_type" id="vehicle_type">
                                    <option>Jármű fajtája</option>
                                    @foreach($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->id }}"
                                        @if (old('vehicle_type') == null)
                                            {{ $vehicleType->id == ($loop->index) + 1 ? 'selected' : '' }}
                                            @else
                                            {{ old('vehicle_type') == $vehicleType->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $vehicleType->vehicle_type }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="manufacturer">Gyártmány</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="manufacturer"
                                                   id="manufacturer"
                                                   placeholder="Jármű gyártója" required min="3" max="255"
                                                   value="{{ old('manufacturer') == null ? $vehicle->manufacturer : old('manufacturer') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="type">Típus</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="type" id="type"
                                                   placeholder="Jármű típusa" required min="3" max="255"
                                                   value="{{ old('type') == null ? $vehicle->type : old('type') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="license_plate_number">Forgalmi
                                        rendszám</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="license_plate_number"
                                                   id="license_plate_number"
                                                   placeholder="Jármű forgalmi rendszáma"
                                                   value="{{ old('license_plate_number') == null ? $vehicle->license_plate_number : old('license_plate_number') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="year_of_manufacture">Gyártási év</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="year_of_manufacture"
                                                   id="year_of_manufacture"
                                                   placeholder="Jármű gyártási éve" min="1900" required
                                                   value="{{ old('year_of_manufacture') == null ? $vehicle->year_of_manufacture : old('year_of_manufacture') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="chassis_number">Alvázszám</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="chassis_number"
                                                   id="chassis_number"
                                                   placeholder="Jármű alvázszáma"
                                                   value="{{ old('chassis_number') == null ? $vehicle->chassis_number : old('chassis_number') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="motor_number">Motorszám</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="motor_number"
                                                   id="motor_number"
                                                   placeholder="Jármű motorszáma"
                                                   value="{{ old('motor_number') == null ? $vehicle->motor_number : old('motor_number') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="motor_code">Motorkód</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="motor_code" id="motor_code"
                                                   placeholder="Jármű motorkódja"
                                                   value="{{ old('motor_code') == null ? $vehicle->motor_code : old('motor_code') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label"
                                           for="cylinder_capacity">Hengerűrtartalom</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="cylinder_capacity"
                                                   id="cylinder_capacity"
                                                   placeholder="Jármű hengerűrtartalma" min="0" required
                                                   value="{{ old('cylinder_capacity') == null ? $vehicle->cylinder_capacity : old('cylinder_capacity') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div id="calc">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="performance_kw">Teljesítmény
                                            (kW)</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="performance_kw"
                                                       id="performance_kw"
                                                       v-model="performance_kw"
                                                       placeholder="Jármű teljesítménye kW-ban megadva" min="0" required
                                                />
                                                @if(old('performance_kw') != null)
                                                    <script>
                                                        let performance_kw = {!! json_encode(old('performance_kw', [])) !!};
                                                    </script>
                                                @else
                                                    <script>
                                                        let performance_kw = {{ $vehicle->performance_kw }};
                                                    </script>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="performance_le">Teljesítmény
                                            (LE)</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="performance_le"
                                                       id="performance_le"
                                                       v-model="performance_le"
                                                       placeholder="Jármű teljesítménye LE-ben megadva" min="0" required
                                                       value="{{ old('performance_le') == null ? $vehicle->performance_le : old('performance_le') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="validity_of_technical_Examination">Műszaki
                                        vizsga érvényessége</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="date" class="form-control"
                                                   name="validity_of_technical_Examination"
                                                   id="validity_of_technical_Examination"
                                                   placeholder="Műszaki vizsga érvényessége" min="1900-01-01"
                                                   value="{{ old('validity_of_technical_Examination') == null ? $vehicle->validity_of_technical_Examination : old('validity_of_technical_Examination') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="date_of_purchase">Vásárlás
                                        dátuma</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date_of_purchase"
                                                   id="date_of_purchase"
                                                   placeholder="Jármű eladásának dátuma" min="1900-01-01"
                                                   value="{{ old('date_of_purchase') == null ? $vehicle->date_of_purchase : old('date_of_purchase') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="date_of_sale">Eladás dátuma</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date_of_sale"
                                                   id="date_of_sale"
                                                   placeholder="Jármű eladásának dátuma" min="1900-01-01"
                                                   value="{{ old('date_of_sale') == null ? $vehicle->date_of_sale : old('date_of_sale') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('vehicle.index') }}">
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
                performance_kw: performance_kw,
            },
            computed: {
                performance_le: function () {
                    return Math.round(this.performance_kw * 1.34, 0);
                }
            }
        })
    </script>
@endsection
