<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if (auth()->user()->avatar != null)
            <img src="{{asset('storage/imgs/avatars') . auth()->user()->avatar}}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
              @else
            <img src="{{asset('storage/imgs/avatars/avatar.jpg')}}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
              @endif
              <span class="align-middle">{{ \Illuminate\Support\Facades\Auth::user()->name }} </span>
              <p class="d-lg-none d-md-block">
              {{ __('Felhasználó') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profil módosítása') }}</a>
{{--            <a class="dropdown-item" href="{{ route('vehicles') }}">{{ __('Beállítások') }}</a>--}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Kijelentkezés') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
