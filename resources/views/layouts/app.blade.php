<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('storage/icons/ISOTIPOs.png') }}">


    <title>LottuxMed</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

    <style>
        .bg-primary {
            background-color: #235AA7 !important;
        }

        .menu {}
    </style>

</head>

<body>

    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
            <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm menu">

                <div class="container">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        {{-- <i class="fas fa-clinic-medical"></i> --}}
                        <img src="{{ asset('storage/icons/ISOTIPOs.png') }}" height="40px" class="mr-1">
                        <img src="{{ asset('storage/icons/NOMBRE.png') }}" height="20px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        {{-- <ul class="navbar-nav mr-auto">
                            <a class="navbar-brand" href="/pacientes">Pacientes</a>

                        </ul> --}}

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto ">
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else


                            @if(auth()->user()->tipo_usuario_id == 2)
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('lista.espera') }}"><b
                                        class="alert alert-success">Lista de espera</b></a>
                            </li>
                            @endif

                            <li class="nav-item dropdown font-weight-bold">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    Agenda
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/calendario">Calendario</a>
                                    <a class="dropdown-item" href="{{ route('citas.pendientes') }}">Pendientes</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-light" href="/consultas">Ultimas consultas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-light" href="/pacientes">Pacientes</a>
                            </li>

                            @if(auth()->user()->tipo_usuario_id <> 3)
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('caja') }}">Caja</a>
                                </li>

                                {{--
                                <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        Caja
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('apertura.caja') }}">
                                            Apertura
                                        </a>
                                        <a class="dropdown-item" href="{{ route('cierre.caja') }}">
                                            Cierre
                                        </a>
                                        <a class="dropdown-item" href="{{ route('gastos') }}">
                                            Gastos
                                        </a>
                                        <a class="dropdown-item" href="{{ route('nomina') }}">
                                            Pagos de nomina
                                        </a>
                                    </div>

                                </li>
                                --}}


                                @if(auth()->user()->tipo_usuario_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="/pacientes">Administracion</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link text-light"
                                        href="{{ route('configuracion.index') }}">Configuracion</a>
                                </li>
                                @endif

                                <!-- Authentication Links -->

                                <li class="nav-item dropdown font-weight-bold">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        {{-- <a class="dropdown-item"
                                            href="{{ route('doctor.documentos') }}">Documentos</a> --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js')
</body>

</html>