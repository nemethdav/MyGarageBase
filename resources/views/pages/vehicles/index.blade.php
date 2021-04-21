@extends('layouts.app', ['activePage' => 'myVehicles', 'titlePage' => __('Járműveim')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h3 class="card-title d-flex justify-content-between">
                                Járműveim
                                <a href="{{ route('vehicle.create') }}">
                                    <button type="button" rel="tooltip" title="Új jármű hozzáadása"
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

                        <x-alert />

                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning text-center">
                                <th width="5%">ID</th>
                                <th>Jármű beceneve</th>
                                <th>Rendszám</th>
                                <th>Márka-Típus</th>
                                <th>Hengerűrtartalom</th>
                                <th colspan="2" width="">Teljesítmény</th>
                                <th width="25%">Műveletek</th>
                                </thead>
                                <tbody class="text-center">
                                @forelse($vehicles as $vehicle)
                                <tr>
{{--                                    <td>{{ ($loop->index) + 1 }}</td>--}}
                                    <td>{{ ($vehicle->id) }}</td>
                                    <td>{{ ($vehicle->vehicleNickName) }}</td>
                                    <td>{{ $vehicle->license_plate_number }}</td>
                                    <td>{{ $vehicle->manufacturer }} {{ $vehicle->type }}</td>
                                    <td>{{ $vehicle->cylinder_capacity }} cm<sup>3</sup> </td>
                                    <td>{{ $vehicle->performance_kw }} kW</td>
                                    <td>{{ $vehicle->performance_le }} LE</td>
                                    <td>
                                        <button type="button" rel="tooltip" title="Részletek"
                                                class="btn btn-success btn-link btn-sm">
                                            <i class="material-icons">launch</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Szerkesztés"
                                                class="btn btn-warning btn-link btn-sm">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <span>
                                        <button type="button" rel="tooltip" title="Törlés"
                                                class="btn btn-danger btn-link btn-sm"
                                                onclick="if(confirm('Biztosan törölni szeretné?')){
                                                    document.getElementById('delete{{ $vehicle->id }}').submit()
                                                    }">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" style="display: none"
                                              id={{ 'delete'.$vehicle->id }}>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            Még egy járműve sincs rögzítve! <a href="{{ route('vehicle.create') }}">Ide kattintva tud létrehozni egyet!</a>
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
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
