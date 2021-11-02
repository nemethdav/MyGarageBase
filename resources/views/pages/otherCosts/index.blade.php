@extends('layouts.app', ['activePage' => 'otherCosts', 'titlePage' => __('Egyéb kiadások')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h3 class="card-title d-flex justify-content-between">
                                Egyéb kiadások
                                <a href="{{ route('otherCosts.create') }}">
                                    <button type="button" rel="tooltip" title="Új egyéb költség hozzáadása"
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
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
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

                                        <form action="{{ route('otherCostsPDF') }}" method="POST">
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
                                                <button type="submit" class="btn btn-danger">Exportálás PDF-be</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <thead class="text-warning text-center">
                                <th width="5%">Sorszám</th>
                                <th>Jármű beceneve</th>
                                <th>Kiadás címe</th>
                                <th>Költség</th>
                                <th>Dátum</th>
                                <th>Műveletek</th>
                                </thead>
                                <tbody class="text-center">
                                @forelse($otherCosts as $otherCost)
                                    <tr>
                                        <td>{{ (($loop->index) + 1) + ($otherCosts->currentPage() * 10 - 10) }}</td>
                                        <td>{{ $otherCost->vehicle->vehicleNickName }}</td>
                                        <td>{{ $otherCost->title }}</td>
                                        <td>{{ number_format($otherCost->price, 0, ',', ' ') }} Ft</td>
                                        <td>{{ $otherCost->date }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route("otherCosts.show", $otherCost->id) }}"
                                                   rel="tooltip"
                                                   title="Részletek"
                                                   class="btn btn-success btn-link btn-sm">
                                                    <i class="material-icons">launch</i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="{{ route('otherCosts.edit', $otherCost->id) }}"
                                                   rel="tooltip"
                                                   title="Szerkesztés"
                                                   class="btn btn-warning btn-link btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </span>
                                            <span rel="tooltip" title="Törlés"
                                                  class="btn btn-danger btn-link btn-sm"
                                                  onclick="if(confirm('Biztosan törölni szeretné?')){
                                                      document.getElementById('delete{{ $otherCost->id }}').submit()
                                                      }">
                                                <i class="material-icons">close</i>
                                                <form
                                                    action="{{ route('otherCosts.destroy', $otherCost->id) }}"
                                                    method="POST"
                                                    style="display: none"
                                                    id={{ 'delete'.$otherCost->id }}>
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                        </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            Nincs egyéb költség rögzítve! <a
                                                href="{{ route('otherCosts.create') }}">Ide
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
                    {{ $otherCosts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
