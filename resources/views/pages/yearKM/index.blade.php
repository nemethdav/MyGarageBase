@extends('layouts.app', ['activePage' => 'yearKM', 'titlePage' => __('Évente megtett távolgások')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h3 class="card-title d-flex justify-content-between">
                                Évente megtett távolságok
                                <a href="{{ route('yearkm.create') }}">
                                    <button type="button" rel="tooltip" title="Új km hozzáadása"
                                            class="btn btn-success btn-link btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                             fill="currentColor"
                                             class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                </a>
                            </h3>

                        </div>

                        <div class="card-body table-responsive">

                            <x-alert/>

                            <!-- Button trigger modal -->
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                        data-target="#PDFexport">
                                    <i class="material-icons">
                                        picture_as_pdf
                                    </i>
                                    Adatok exportálása PDF-be
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="PDFexport" tabindex="-1" aria-labelledby="PDFexportLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="PDFexportLabel">Adatok PDF-be exportálása</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('yearkmPDF') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mdc-form-field">
                                                    @foreach($vehicles as $vehicle)
                                                        <div class="mdc-radio">
                                                            <input class="mdc-radio__native-control" type="radio"
                                                                   id="{{ $vehicle->id }}" value="{{ $vehicle->id }}"
                                                                   name="vehicleID">
                                                            <label
                                                                for="{{ $vehicle->id }}">{{ $vehicle->vehicleNickName }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-warning">Exportálás PDF-be</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <thead class="text-warning text-center">
                                <th width="5%">Sorszám</th>
                                <th>Jármű beceneve</th>
                                <th>Év</th>
                                <th>Év eleji óra állás</th>
                                <th>Év végi óra állás</th>
                                <th>Évben megtett távolság</th>
                                <th width="25%">Műveletek</th>
                                </thead>
                                <tbody class="text-center">
                                @forelse($yearKMs as $yearKM)
                                    <tr>
                                        <td>{{ (($loop->index) + 1) + ($yearKMs->currentPage() * 10 - 10) }}</td>
                                        <td>{{ $yearKM->vehicle->vehicleNickName }}</td>
                                        <td>{{ $yearKM->year }} </td>
                                        <td>{{ number_format($yearKM->start_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                                        <td>{{ number_format($yearKM->end_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                                        <td>{{ number_format($yearKM->year_km_operating_hour, 0, ',', ' ') }} km/üzemóra</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('yearkm.edit', $yearKM->id) }}" rel="tooltip"
                                                   title="Szerkesztés"
                                                   class="btn btn-warning btn-link btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </span>
                                            <span rel="tooltip" title="Törlés"
                                                  class="btn btn-danger btn-link btn-sm"
                                                  onclick="if(confirm('Biztosan törölni szeretné?')){
                                                      document.getElementById('delete{{ $yearKM->id }}').submit()
                                                      }">
                                                <i class="material-icons">close</i>
                                                <form action="{{ route('yearkm.destroy', $yearKM->id) }}"
                                                      method="POST"
                                                      style="display: none"
                                                      id={{ 'delete'.$yearKM->id }}>
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                        </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            Még egy km óra állás sincs rögzítve! <a href="{{ route('yearkm.create') }}">Ide
                                                kattintva tud létrehozni egyet!</a>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto">
                    {{ $yearKMs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
