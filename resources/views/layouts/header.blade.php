<div class="container-fluid">
    <a class="navbar-brand text-white ms-3" href="{{ url('/') }}">
        Desafío Wyleex
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="btn btn-outline-primary text-white" href="{{ route('login') }}">Ingresar</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="btn btn-success text-white" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endif
            @else
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link  text-white" href="{{ route('home') }}">
                        <i class="fas fa-home text-white"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item dropdown" >
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="background: transparent !important;" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user me-sm-1"></i>

                        {{ Auth::user()->name }}
                    </a>

                    @if (Auth::user()->role == 'ADMIN')
                        <div class="row px-0 d-block d-md-none">
                            @include('layouts.admin-links')
                        </div>
                    @endif

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            @endguest
        </ul>
    </div>
</div>
