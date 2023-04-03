@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-column-reverse flex-md-row justify-content-center">
        {{-- Preview News --}}
        <div class="col-md-6 col-xl-7 mb-2">
            <div class="card">
                <div class="card-header">
                    Últimas Noticias
                </div>
                <div class="card-body">
                    <label>Al registrarte podrás acceder a todas estas noticias excusivas...</label>
                    @forelse ($news as $item)
                        <div class="card my-2 w-100">
                            <div class="card-body py-2">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text mb-1">
                                    {{ substr($item->content, 0, 100) }}...
                                </p>
                                <div class="row text-muted">
                                    <div class="col-6">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        ( {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} )
                                    </div>
                                    <div class="col-6 text-end">
                                        <i>
                                            Redactado por 
                                            <b>{{ $item->author }}</b>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No hay noticias cargadas
                    @endforelse
                </div>
            </div>
        </div>

        @guest
            {{-- Login / Register --}}
            <div class="col-md-6 col-xl-5 mb-5">
                <div class="card">
                    <div class="card-header">Accede</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            {{-- <button class="btn btn-outline-primary mx-2" onclick="window.collapse('collapseRegister')" type="button" data-toggle="collapse" data-target="#collapseLogin" aria-expanded="false" aria-controls="collapseLogin">
                                Identificarse
                            </button>
                            <button class="btn btn-success mx-2" onclick="window.collapse('collapseLogin')" type="button" data-toggle="collapse" data-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister">
                                Registrarse
                            </button> --}}

                            <button class="btn btn-outline-primary mx-2 col" onclick="window.collapse('collapseRegister')" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogin" aria-expanded="false" aria-controls="collapseLogin">
                                Identificarse
                            </button>

                            <button class="btn btn-success mx-2 col" onclick="window.collapse('collapseLogin')" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister">
                                Registrarse
                            </button>
                        </div>
                        {{-- Login --}}
                        <div class="collapse my-2 @error('from_register') @else show @enderror" id="collapseLogin">
                            <div class="card card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0 mb-3">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Ingresar
                                            </button>

                                            {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    ¿Olvidaste tu contraseña?
                                                </a>
                                            @endif --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Register --}}
                        <div class="collapse my-2  @error('from_register') show @enderror" id="collapseRegister">
                            <label class="my-2" for="">Registrate para poder acceder a todas nuestras noticias</label>
                            <div class="card card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Apellido</label>

                                        <div class="col-md-6">
                                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                        <div class="col-md-6">
                                            <input id="email_register" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                        <div class="col-md-6">
                                            <div class="row g-0">
                                                <div class="col-11">
                                                    <input id="password_register" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-1 px-1 pt-1">
                                                    <label onclick="window.showPassword(document.getElementById('password_register').getAttribute('type'));" class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-eye"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-success">
                                                Registrarse
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else

        @endguest
    </div>
</div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('load', function(event) {
            
        });

        function collapse(id) {
            const elem = document.getElementById(id);
            elem.classList.remove('show');
        }

        function showPassword(actualType) {
            const elem = document.getElementById('password_register');
            if(actualType == 'password'){
                elem.type = 'text';
            } else {
                elem.type = 'password';
            }
        }
    </script>
@endsection