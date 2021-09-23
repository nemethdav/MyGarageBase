@extends('layouts.app', ['activePage' => 'editMotorwayVignette', 'titlePage' => __('Autópálya matrica szerkesztése')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">
                                Autópálya matrica szerkesztése
                            </h4>
                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <form action="{{ route('motorwayVignette.update', $motorwayVignette->id) }}" method="POST"
                                  enctype="multipart/form-data">

                                <div id="editMotorwayVignettes">
                                    @csrf
                                    @method('PUT')

                                    <select class="custom-select" name="vehicle_id" id="vehicle_id">
                                        <option>Jármű kiválasztása</option>
                                        @foreach($user_vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                            @if (old('vehicle_id') == null)
                                                {{ $vehicle->id == $motorwayVignette->vehicle_id ? 'selected' : '' }}
                                                @else
                                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}
                                                @endif
                                            >
                                                {{ $vehicle->vehicleNickName }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="type">
                                            Matrica típusa
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="type"
                                                       id="type" placeholder="Matrica típusa" required
                                                       value="{{ old('type') == null ? $motorwayVignette->type : old('type') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="category">
                                            Matrica kategóriája
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="category"
                                                       id="category" placeholder="Matrica kategóriája" required
                                                       value="{{ old('category') == null ? $motorwayVignette->category : old('category') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="location">
                                            Matrica érvényességének helye
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" min="0" class="form-control" name="location"
                                                       id="location"
                                                       placeholder="Érvényesség helye" required
                                                       value="{{ old('location') == null ? $motorwayVignette->location : old('location') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="start_date">
                                            Érvényesség kezdete
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="datetime-local" class="form-control"
                                                       name="start_date"
                                                       id="start_date"
                                                       required
                                                       value="{{ old('start_date') == null ? $start_date : old('start_date')}}"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="end_date">
                                            Érvényesség vége
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="datetime-local" class="form-control"
                                                       name="end_date"
                                                       id="end_date"
                                                       required
                                                       value="{{ old('end_date') == null ? $end_date : old('end_date') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="date_of_purchase">
                                            Vásárlás időpontja
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="datetime-local" class="form-control"
                                                       name="date_of_purchase"
                                                       id="date_of_purchase"
                                                       required
                                                       value="{{ old('date_of_purchase') == null ? $date_of_purchase : old('date_of_purchase') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 col-form-label" for="price">
                                            Matrica ára (Ft)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="number" step="1" class="form-control" name="price"
                                                       id="price"
                                                       placeholder="Matrica ára"
                                                       required
                                                       value="{{ old('price') == null ? $motorwayVignette->price : old('price') }}"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label class="col-sm-4" for="image">
                                            Bizonylatról készült fotó
                                            <p class="text-warning">Új fotó feltöltésekor a régi törlődik a
                                                rendszerből</p>
                                        </label>
                                        <div class="col-sm-8">
                                            <div>
                                                <input type="file" name="image"
                                                       id="image"
                                                       value="{{ old('image')  }}"
                                                       accept="image/*"
                                                       @change="previewImage"
                                                />
                                            </div>
                                        </div>
                                        <img src=""
                                             alt="Fotó a bizonylatról"
                                             width="100%"
                                             id="preview"
                                             style="display: none"
                                        />
                                    </div>


                                    @include('layouts.star')

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('motorwayVignette.index') }}">
                                                <button type="button" class="btn btn-danger mt-2 ml-2" rel="tooltip"
                                                        title="Visszalépéssel az adatok nem kerülnek mentésre!">
                                                    Visszalépés
                                                </button>
                                            </a>
                                            <button type="submit" class="btn btn-warning">Mentés</button>
                                        </div>
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
            el: '#editMotorwayVignettes',
            methods: {
                previewImage: function (e) {
                    var file = e.target.files[0];
                    var imgURL = URL.createObjectURL(file);
                    document.getElementById("preview").src = imgURL;
                    document.getElementById("preview").style.display = "inline";
                }
            }
        })
    </script>
@endsection
