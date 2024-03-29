@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Felhasználói profil')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Profil szerkesztése') }}</h4>
                                <p class="card-category">{{ __('Felhasználói információk') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Név') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text" placeholder="{{ __('Név') }}"
                                                   value="{{ old('name', auth()->user()->name) }}" required="true"
                                                   aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('E-mail') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" id="input-email" type="email"
                                                   placeholder="{{ __('E-mail') }}"
                                                   value="{{ old('email', auth()->user()->email) }}" required/>
                                            @if ($errors->has('email'))
                                                <span id="email-error" class="error text-danger"
                                                      for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Mentés') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-5">
                    <form method="post" action="{{ route('profile.avatar') }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Profilkép') }}</h4>
                                <p class="card-category">{{ __('Profilkép megváltoztatása') }}</p>
                            </div>
                            <div class="card-body text-center">
                                @if (session('status_avatar'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status_avatar') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (session('status_error_avatar'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status_error_avatar') }}</span>
                                            </div>
                                        </div>
                                    </div>@endif

                                <div class="author">
                                    @if(auth()->user()->avatar != null)
                                        <a href="{{asset('storage/imgs/avatars') . auth()->user()->avatar}}"
                                           target="_blank">
                                            <img class="avatar mb-3"
                                                 src="{{asset('storage/imgs/avatars') . auth()->user()->avatar}}"
                                                 alt="Profilkép">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/imgs/avatars/avatar.jpg') }}"
                                           target="_blank">
                                            <img class="avatar mb-3"
                                                 src="{{asset('storage/imgs/avatars/avatar.jpg')}}"
                                                 alt="Profilkép">
                                        </a>
                                    @endif
                                    <h5 class="title font-weight-bold">{{ auth()->user()->name }}</h5>
                                </div>

                                <div id="changeProfilePicture">
                                    <label for="changeAvatar">Profilkép módosítása</label>
                                    <br>
                                    <input type="file"
                                           id="changeAvatar"
                                           name="changeAvatar"
                                           accept="image/*"
                                           @change="previewImage">
                                    <br>
                                    <img src=""
                                         alt="Új profilkép"
                                         width="50%"
                                         id="preview"
                                         style="display: none"
                                    />
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <div>
                                    <button type="submit"
                                            class="btn btn-primary">{{ __('Profilkép módosítása') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-md-7">
                    <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Jelszó megváltoztatása') }}</h4>
                                <p class="card-category">{{ __('Jelszó') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status_password'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status_password') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="input-current-password">{{ __('Jelenlegi jelszó') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                                input type="password" name="old_password" id="input-current-password"
                                                placeholder="{{ __('Jelenlegi jelszó') }}" value="" required/>
                                            @if ($errors->has('old_password'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('old_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="input-password">{{ __('Új jelszó') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" id="input-password" type="password"
                                                placeholder="{{ __('Új jelszó') }}" value="" required/>
                                            @if ($errors->has('password'))
                                                <span id="password-error" class="error text-danger"
                                                      for="input-password">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                           for="input-password-confirmation">{{ __('Jelszó megerősítése') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" name="password_confirmation"
                                                   id="input-password-confirmation" type="password"
                                                   placeholder="{{ __('Jelszó megerősítése') }}" value="" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"
                                        class="btn btn-primary">{{ __('Jelszó megváltoztatása') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#changeProfilePicture',
            methods: {
                previewImage: function (e) {
                    var file = e.target.files[0];
                    var imgURL = URL.createObjectURL(file);
                    document.getElementById("preview").src = imgURL;
                    document.getElementById("preview").style.display = "inline";
                }
            }
        })
    </script>
@endsection
