@extends('layouts.app', ['activePage' => 'createOtcerCosts', 'titlePage' => __('Új egyéb kiadás rögzítése')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">
                                Új egyéb kiadás rögzítése
                            </h4>
                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form action="{{ route('otherCosts.store') }}" method="POST">

                                @csrf

                                <select class="custom-select" name="vehicle_id" id="vehicle_id">
                                    <option>Jármű kiválasztása</option>
                                    @foreach($user_vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->vehicleNickName }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="title">
                                        Költség megnevezése:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="title"
                                                   id="title" placeholder="Költség megnevezése" required min="3"
                                                   value="{{ old('title') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="description">
                                        Költség részletes leírása:
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                                <textarea id="description" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="price">
                                        Ára:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="number" min="0" class="form-control" name="price"
                                                   id="price"
                                                   placeholder="Ár" required
                                                   value="{{ old('price') }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label" for="date">
                                        Kiadás dátuma
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="date" class="form-control"
                                                   name="date"
                                                   id="date"
                                                   required
                                                   value="{{ old('date') }}"
                                            />
                                        </div>
                                    </div>
                                </div>

                                @include('layouts.star')

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('otherCosts.index') }}">
                                            <button type="button" class="btn btn-danger mt-2 ml-2" rel="tooltip"
                                                    title="Visszalépéssel az adatok nem kerülnek mentésre!">Visszalépés
                                            </button>
                                        </a>
                                        <button type="submit" class="btn btn-outline-danger">Mentés</button>
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
