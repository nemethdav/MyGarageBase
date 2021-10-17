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
                                    <button type="button" rel="tooltip" title="Új autópálya matrica rögzítése"
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
