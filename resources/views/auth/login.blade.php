@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'titlePage' => __('Bejelentkezés')])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
                <h3>{{ __('Az oldal szolgáltatásainak használatához kérem jelentkezzen be az alábbi felületen') }} </h3>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"><strong>{{ __('Bejelentkezés') }}</strong></h4>
                            <div class="social-line">
                                <p class="card-description text-center">{{ __('Jelentkezzen be közösségi média segítségével') }}</p>
                                <a href="{{ route('facebook.login') }}" class="btn btn-just-icon btn-link btn-white">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                {{--              <a href="#pablo" class="btn btn-just-icon btn-link btn-white">--}}
                                {{--                <i class="fa fa-twitter"></i>--}}
                                {{--              </a>--}}
                                <a href="{{ route('google.login') }}" class="btn btn-just-icon btn-link btn-white">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-description text-center">{{ __('Vagy jelentkezzen be e-mail címe és jelszava használatával') }}</p>
                            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                                    </div>
                                    <input type="email" name="email" class="form-control"
                                           placeholder="{{ __('E-mail...') }}" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <div id="email-error" class="error text-danger pl-3" for="email"
                                         style="display: block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="{{ __('Jelszó...') }}" required>
                                </div>
                                @if ($errors->has('password'))
                                    <div id="password-error" class="error text-danger pl-3" for="password"
                                         style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block error text-danger pl-3">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                            <div class="mt-3">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit"
                                    class="btn btn-primary btn-link btn-lg">{{ __('Bejelentkezés') }}</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Elfelejtetted a jelszavad?') }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-light">
                            <small>{{ __('Regisztráció') }}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
