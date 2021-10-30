@extends('layouts.app', ['activePage' => 'services', 'titlePage' => __('Képek kezelése')])

@section('content')
    <style type="text/css">
        #gallery-images img {
            width: 240px;
            height: 160px;
            border: 2px solid black;
            margin-bottom: 10px;
            border-radius: 25px;
        }

        #gallery-images ul {
            margin: 0;
            padding: 0;
        }

        #gallery-images li {
            margin: 0;
            padding: 0;
            list-style: none;
            float: left;
            padding-right: 10px;
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">
                                {{ $service->service_title }} képek kezelése
                            </h4>
                        </div>
                        <div class="card-body text-center">

                            <x-alert/>

                            <div class="row">
                                <div class="col-md-12 mt-3 mb-3">
                                    <h3>Húzza a keretbe a feltölteni kívánt képeket!</h3>
                                    <form action="{{ route('serviceImageUpload') }}"
                                          class="dropzone"
                                          accept="image/*"
                                          id="addImages">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="gallery-images">
                                        <ul>
                                            @foreach($service->serviceImages as $image)
                                                <li>
                                                    <a href="{{ asset('storage/imgs/serviceImages/' . $image->file_name) }}"
                                                       {{--target="_blank"--}}
                                                       data-lightbox="myGallery"
                                                    >
                                                        <img
                                                            src="{{ asset('storage/imgs/serviceImages/thumbs/' . $image->file_name) }}">
                                                    </a>

                                                    <div rel="tooltip" title="Törlés"
                                                          class="btn btn-danger btn-link btn-sm"
                                                          onclick="if(confirm('Biztosan törölni szeretné?')){
                                                              document.getElementById('delete{{ $image->id }}').submit()
                                                              }">
                                                        <i class="material-icons">close</i>
                                                        <form
                                                            action="{{ route('deleteServiceImage', $image->id) }}"
                                                            method="POST"
                                                            style="display: none"
                                                            id={{ 'delete'.$image->id }}>
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('services.index') }}">
                                        <button type="button" class="btn btn-danger mt-2 ml-2">Visszalépés</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
