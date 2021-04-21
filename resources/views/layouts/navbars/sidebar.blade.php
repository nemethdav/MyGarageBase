<div class="sidebar" data-color="azure" data-background-color="black"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal">
            {{ __('MyGarageBase') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Főképernyő') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'profile') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
                    <i class="material-icons">settings</i>
                    <p>{{ __('Beállítások') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="settings">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"> FP </span>
                                <span class="sidebar-normal">{{ __('Felhasználói profil') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ ($activePage == 'createVehicle' || $activePage == 'myVehicles' ||
                $activePage == 'showVehicle' || $activePage == 'editVehicle') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
                    <i class="material-icons">settings</i>
                    <p>{{ __('Járművek') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="settings">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'createVehicle' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('vehicle.create') }}">
                                <i class="material-icons">add</i>
                                <i class="material-icons">directions_car</i>
                                <span class="sidebar-normal">{{ __('Jármű hozzáadása') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'myVehicles' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('vehicle.index') }}">
                                <i class="material-icons">directions_car</i>
                                <span class="sidebar-normal">{{ __('Jámrűveim') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('table') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('notifications') }}">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="nav-item mt-5">
                <a class="nav-link text-white btn-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">logout</i>
                    <p>{{ __('Kijelentkezés') }}</p>
                </a>
            </li>
            <li class="nav-item github-button">
                <a class="nav-link text-white bg-info" target="_blank"
                   href="https://github.com/nemethdav/MyGarageBase.git">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="28" fill="currentColor"
                         class="bi bi-github float-left mr-2" viewBox="0 0 16 16">
                        <path
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    <p>{{ __('GitHub link') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
