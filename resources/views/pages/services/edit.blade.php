@extends('layouts.app', ['activePage' => 'editService', 'titlePage' => __('Szervizelés szerkesztése')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">
                                {{ $service->title }} szerkesztése
                            </h4>
                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form action="{{ route('services.edit', $service->id) }}" method="POST">

                                @csrf

                                <select class="custom-select" name="vehicle_id" id="vehicle_id">
                                    <option>Jármű kiválasztása</option>
                                    @foreach($user_vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                        @if (old('vehicle_id') == null)
                                            {{ $vehicle->id == $service->vehicle_id ? 'selected' : '' }}
                                            @else
                                            {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $vehicle->vehicleNickName }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="service_name">
                                        Szerviz neve:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control"
                                                   name="service_name"
                                                   id="service_name"
                                                   placeholder="Szerviz neve"
                                                   required
                                                   min="3"
                                                   value="{{ old('service_name') == null ? $service->service_name : old('service_name') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="service_title">
                                        Megnevezés:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control"
                                                   name="service_title"
                                                   id="service_title"
                                                   placeholder="Szervizelés megnevezése"
                                                   required
                                                   min="3"
                                                   value="{{ old('service_title') == null ? $service->service_title : old('service_title') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="service_date">
                                        Szervizelés időpontja:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="date"
                                                   class="form-control"
                                                   name="service_date"
                                                   id="service_date"
                                                   required
                                                   value="{{ old('service_date') == null ? $service->service_date : old('service_date') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="km_operatinghour">
                                        Km/üzemóra állása:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number"
                                                   class="form-control"
                                                   name="km_operatinghour"
                                                   id="km_operatinghour"
                                                   required
                                                   min="0"
                                                   placeholder="Óraállás"
                                                   value="{{ old('km_operatinghour') == null ? $service->km_operatinghour : old('km_operatinghour') }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="description">
                                        Leírás:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   name="description"
                                                   id="description"
                                                   required
                                                   min="0"
                                                   placeholder="Szervizelés részletes leírása"
                                                   value="{{ old('description') == null ? $service->description : old('description') }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="price">
                                        Szervizelés költsége
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number"
                                                   class="form-control"
                                                   name="price"
                                                   id="price"
                                                   required
                                                   min="0"
                                                   placeholder="Szervizelés költsége"
                                                   value="{{ old('price') == null ? $service->price : old('price') }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                @include('layouts.star')

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('services.index') }}">
                                            <button type="button" class="btn btn-outline-danger mt-2 ml-2" rel="tooltip"
                                                    title="Visszalépéssel az adatok nem kerülnek mentésre!">Visszalépés
                                            </button>
                                        </a>
                                        <button type="submit" class="btn btn-outline-info">Mentés</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
