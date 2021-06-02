@extends('layouts.app', ['activePage' => 'motorwayVignettes', 'titlePage' => __('Autópálya matricák')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header card-header-success">
                            <h3 class="card-title d-flex justify-content-between">
                                Autópálya matricák
                                <a href="{{ route('motorwayVignette.create') }}">
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
                        <div class="card-body text-center">

                            <x-alert/>

                            <table class="table table-hover">
                                <thead class="text-warning text-center">
                                <th width="5%">ID</th>
                                <th>Jármű beceneve</th>
                                <th>Matrica típusa</th>
                                <th>Érvényességének helye</th>
                                <th>Érvényességének kezdete</th>
                                <th>Érvényességének vége</th>
                                <th>Ár</th>
                                <th>Műveletek</th>
                                </thead>
                                <tbody class="text-center">
                                @forelse($motorwayVignettes as $motorwayVignette)
                                    <tr>
                                        {{--                                    <td>{{ ($loop->index) + 1 }}</td>--}}
                                        <td>{{ $motorwayVignette->id }}</td>
                                        <td>{{ $motorwayVignette->vehicle->vehicleNickName }}</td>
                                        <td>{{ $motorwayVignette->type }}</td>
                                        <td>{{ $motorwayVignette->location }}</td>
                                        <td>{{ $motorwayVignette->start_date }}</td>
                                        <td>
                                            {{ $motorwayVignette->end_date }} -
                                            @if ($motorwayVignette->end_date < date("Y-m-d H:i:s"))
                                                <span class="text-danger font-weight-bold">Lejárt!</span>
                                            @else
                                                <span class="text-success font-weight-bold">Érvényes!</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($motorwayVignette->price, 0, ',', ' ') }} Ft</td>
                                        <td>
                                            <span>
                                                <a href="{{ route("motorwayVignette.show", $motorwayVignette->id) }}" rel="tooltip"
                                                   title="Részletek"
                                                   class="btn btn-success btn-link btn-sm">
                                                    <i class="material-icons">launch</i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="{{ route('motorwayVignette.edit', $motorwayVignette->id) }}" rel="tooltip"
                                                   title="Szerkesztés"
                                                   class="btn btn-warning btn-link btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </span>
                                            <span rel="tooltip" title="Törlés"
                                                  class="btn btn-danger btn-link btn-sm"
                                                  onclick="if(confirm('Biztosan törölni szeretné?')){
                                                      document.getElementById('delete{{ $motorwayVignette->id }}').submit()
                                                      }">
                                                <i class="material-icons">close</i>
                                                <form action="{{ route('motorwayVignette.destroy', $motorwayVignette->id) }}"
                                                      method="POST"
                                                      style="display: none"
                                                      id={{ 'delete'.$motorwayVignette->id }}>
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                        </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            Még egy autópályamatrcája sincs rögzítve! <a href="{{ route('motorwayVignette.create') }}">Ide
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
                    {{ $motorwayVignettes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
