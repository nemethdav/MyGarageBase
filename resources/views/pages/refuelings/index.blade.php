@extends('layouts.app', ['activePage' => 'refuelings', 'titlePage' => __('Tankolásaim')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h3 class="card-title d-flex justify-content-between">
                                Tankolásaim
                                <a href="{{ route('refueling.create') }}">
                                    <button type="button" rel="tooltip" title="Új tankolás rögzítése"
                                            class="btn btn-success btn-link btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                             fill="orange"
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
                                <button type="button" class="btn btn-outline-info" data-toggle="modal"
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

                                        <form action="{{ route('refuelingPDF') }}" method="POST">
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
                                                <button type="submit" class="btn btn-info">Exportálás PDF-be</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <thead class="text-warning text-center">
                                <th width="5%">Sorszám</th>
                                <th>Jármű</th>
                                <th>Tankolás időpontja</th>
                                <th>Km/üzemóra</th>
                                <th>Számláló 1</th>
                                <th>Átlagfogyasztás</th>
                                <th>Fizetendő</th>
                                <th>Műveletek</th>
                                </thead>
                                <tbody class="text-center">
                                @forelse($refuelings as $refueling)
                                    <tr>
                                        <td>{{ (($loop->index) + 1) + ($refuelings->currentPage() * 10 - 10) }}</td>
                                        <td>{{ $refueling->vehicle->vehicleNickName }}</td>
                                        <td>{{ $refueling->date_time }}</td>
                                        <td>{{ number_format($refueling->km_operating_hour, 0, ',', ' ') }}km/üzemóra
                                        </td>
                                        <td>{{ $refueling->trip1 }} km/üzemóróra</td>
                                        <td>{{ $refueling->average_consumption }} l/100km/üzemóra</td>
                                        <td>{{ number_format($refueling->refuelling_cost, 0, ',', ' ') }} Ft</td>
                                        <td>
                                            <span>
                                                <a href="{{ route("refueling.show", $refueling->id) }}" rel="tooltip"
                                                   title="Részletek"
                                                   class="btn btn-success btn-link btn-sm">
                                                    <i class="material-icons">launch</i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="{{ route('refueling.edit', $refueling->id) }}" rel="tooltip"
                                                   title="Szerkesztés"
                                                   class="btn btn-warning btn-link btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </span>
                                            <span rel="tooltip" title="Törlés"
                                                  class="btn btn-danger btn-link btn-sm"
                                                  onclick="if(confirm('Biztosan törölni szeretné?')){
                                                      document.getElementById('delete{{ $refueling->id }}').submit()
                                                      }">
                                                <i class="material-icons">close</i>
                                                <form action="{{ route('refueling.destroy', $refueling->id) }}"
                                                      method="POST"
                                                      style="display: none"
                                                      id={{ 'delete'.$refueling->id }}>
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                        </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            Még egy tankolása sincs rögzítve! <a href="{{ route('refueling.create') }}">Ide
                                                kattintva tud rögzíteni egyet!</a>
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
                    {{ $refuelings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
