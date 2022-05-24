<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('script_content')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <?php
                        // Manejo del menu en base a los roles
                            if (auth()->user()->rols_id == 1) {
                                $menu = '<li class="nav-item"><a class="nav-link" href="/users/list/admin" role="button">Administradores</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/users/list/docente" role="button">Docentes</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/users/list/estudiante" role="button">Estudiantes</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/subjects" role="button">Asignaturas</a></li>'; 
                            } else if (auth()->user()->rols_id == 2) {
                                $menu = '<li class="nav-item"><a class="nav-link" href="/listEstudiantes" role="button">Estudiantes</a></li>';
                            } else {
                                $menu = '<li class="nav-item"><a class="nav-link" href="/qualifications" role="button">Notas</a></li>';
                            }
                        ?>
                            <?= $menu ?>
                        
                                <?php
                                // Manejo del menu en base a los roles
                                    if (auth()->user()->rols_id == 1) {
                                        echo '<li class="nav-item"><a class="nav-link" href="/settings">Ajustes</a></li">'; 
                                    }
                                ?>

                                <div>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
