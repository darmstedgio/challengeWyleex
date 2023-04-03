<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>

    <body>
        <div id="app" class="">
            <nav class="navbar navbar-expand-lg bg-primary">
                @include('layouts.header')
            </nav>

            <main class="py-4" style="height: content !important; min-height: 95vh;">
                @if (Auth::user() && Auth::user()->role == 'ADMIN' && str_contains(url()->full(), 'admin') || str_contains(url()->full(), 'home'))
                    <div class="row">
                        <div class="col-md-3 px-0 d-none d-md-block" style="background-color: #6c757d25; height: content !important; min-height: 95vh;">
                            <h4 class="text-center my-3">
                                Panel de Administración
                            </h4>
                            @include('layouts.admin-sidebar')
                        </div>
                        <div class="col-md-9 col-12">
                            @yield('content')
                        </div>
                    </div>
                @else
                    @yield('content')
                @endif
            </main>

            <footer class="navbar-light shadow-sm w-100 bg-light" style="position: fixed; bottom: 0; left: 0;">
                @include('layouts.footer')
            </footer>
        </div>
        
        @include('layouts.scripts')

        {{-- Scripts --}}
        @yield('scripts')

        {{-- Sweet Alert --}}
        @include('sweetalert::alert')
    </body>
</html>
