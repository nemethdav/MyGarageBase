@extends('layouts.app', ['activePage' => 'createRefueling', 'titlePage' => __('Új tankolás')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">
                                Új tankolás rögzítése
                            </h4>

                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form action="{{ route('refueling.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="vehicle_id">
                                        Jármű kiválasztása
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select col-sm-8" name="vehicle_id" id="vehicle_id" required>
                                        <option value="null">Járművek</option>
                                        @foreach($user_vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->vehicleNickName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="date_time">
                                        Tankolás időpontja
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="datetime-local" class="form-control" name="date_time"
                                                   id="date_time" required
                                                   value="{{ old('date_time') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="km_operating_hour">
                                        Óraállás
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number" min="0" class="form-control" name="km_operating_hour"
                                                   id="km_operating_hour"
                                                   placeholder="Km óra vagy üzemóra állása" required
                                                   value="{{ old('km_operating_hour') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div id="calc">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="trip1">
                                            Számláló 1
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" class="form-control"
                                                       name="trip1"
                                                       id="trip1"
                                                       placeholder="1-es számláló óra állása" required
                                                       value="{{ old('trip1') }}"
                                                       v-model="trip1"
                                                />
                                                <script>
                                                    let trip1 = {!! json_encode(old('trip1', [])) !!};
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="trip2">Számláló 2 vagy éves
                                            km/üzemóra</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" class="form-control" name="trip2"
                                                       id="trip2"
                                                       placeholder="2-es számláló óra állása vagy éves km/üzemóra"
                                                       value="{{ old('trip2') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="refueled_quantity">
                                            Tankolt üzemanyag mennyiség (l)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" class="form-control"
                                                       name="refueled_quantity"
                                                       id="refueled_quantity" required
                                                       placeholder="Tankolt üzemanyag mennyisége"
                                                       value="{{ old('refueled_quantity') }}"
                                                       v-model="refueled_quantity"
                                                />
                                                <script>
                                                    let refueled_quantity = {!! json_encode(old('refueled_quantity', [])) !!};
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="average_consumption">
                                            Átlagfogyasztás (l)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" class="form-control"
                                                       name="average_consumption"
                                                       id="average_consumption"
                                                       placeholder="Átlagfogyasztás"
                                                       readonly
                                                       value="{{ old('average_consumption') }}"
                                                       v-model="average_consumption"
                                                />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="fuel_cost">
                                            Üzemanyag egységára (Ft):
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" class="form-control"
                                                       name="fuel_cost"
                                                       id="fuel_cost" required
                                                       placeholder="Üzemanyag egységár" value="{{ old('fuel_cost') }}"
                                                       v-model="fuel_cost"
                                                />
                                                <script>
                                                    let fuel_cost = {!! json_encode(old('fuel_cost', [])) !!};
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="discount">
                                            Kedvezmény (Ft):
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" class="form-control"
                                                       name="discount"
                                                       id="discount"
                                                       placeholder="Kedvezmény"
                                                       value="{{ old('discount') }}"
                                                       v-model="discount"
                                                />
                                                <script>
                                                    let discount = {!! json_encode(old('discount', [])) !!};
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="refuelling_cost">
                                            Tankolás költsége (Ft):
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control" name="refuelling_cost"
                                                       id="refuelling_cost" required
                                                       placeholder="Tankolás költsége"
                                                       value="{{ old('refuelling_cost') }}"
                                                       readonly
                                                       v-model="refuelling_cost"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="fuel_type">
                                        Tankolt üzemanyag fajtája</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="fuel_type"
                                                   id="fuel_type"
                                                   placeholder="Tankolt üzemanyag fajtája"
                                                   value="{{ old('fuel_type') }}"/>
                                        </div>
                                    </div>
                                </div>

                                @include('pages.refuelings.refueling_warning')

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('refueling.index') }}">
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
                trip1: trip1,
                refueled_quantity: refueled_quantity,

                fuel_cost: fuel_cost,
                discount: discount,
            },
            computed: {
                average_consumption: function () {
                    return ((this.refueled_quantity / this.trip1) * 100).toFixed(2);
                },
                refuelling_cost: function () {
                    return Math.round(this.fuel_cost * this.refueled_quantity - this.discount);
                }
            }
        })
    </script>
@endsection
