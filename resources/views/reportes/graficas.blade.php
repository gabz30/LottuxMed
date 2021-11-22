<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

    <style>
        .bg-primary{
            background-color: #235AA7 !important;
        }
        .btn-primary{
            background-color: #235AA7 !important;
        }
    </style>
    
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{asset('storage/icons/isotipo.png')}}" height="40px" class="mr-1">
                <img src="{{asset('storage/icons/nombre.png')}}" height="20px" >
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

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
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/calendario">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/consultas">Ultimas consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/pacientes">Pacientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('caja') }}">Caja</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/pacientes">Administracion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('configuracion.index') }}">Configuracion</a>
                    </li>
                   
                    
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            
          

            <div class="col-md-7 border shadow pb-3 bg-light my-2">
                {!! $consultasRealizadas->container() !!}
            </div>

            <div class="col-md-7 border shadow pb-3 bg-light my-2">
                {!! $chartPagos->container() !!}
            </div>

             <div class="col-md-7 border shadow pb-3 bg-light my-2">
             {!! $gastos->container() !!}
            </div>
            
        </div>
    </div>

</div>

<script src="{{ LarapexChart::cdn() }}"></script>

{{ $gastos->script() }}
{{ $chartPagos->script() }}
{{ $consultasRealizadas->script() }}

</body>
</html>
