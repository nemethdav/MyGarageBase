@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'titlePage' => __('E-mail cím megerősítése')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <p class="card-title"><strong>{{ __('E-mail cím megerősítése') }}</strong></p>
                        </div>
                        <div class="card-body">
                            <p class="card-description text-center"></p>
                            <p>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A megerősítő e-mail elküldtük az e-mail címére.') }}
                                </div>
                            @endif

                            {{ __('Kérem erősítse meg a fiókját az e-mailben kapott link segítségével!') }}

                            @if (Route::has('verification.resend'))
                                {{ __('Nem kapta meg az e-mailt?') }}
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-link p-0 m-0 align-baseline">{{ __('Kattintson ide az e-mail újraküldéséhez!') }}</button>
                                </form>
                                @endif
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
