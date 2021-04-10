@extends('layouts.app', ['activePage' => 'myVehicles', 'titlePage' => __('Járműveim')])

@section('content')

    <div id="app" class="mt-5">
        <Index></Index>
    </div>

    <script src="{{ asset(('js/app.js')) }}"></script>

@endsection
