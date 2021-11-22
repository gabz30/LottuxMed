@extends('layouts.app')

@section('css')

<style>
    .card span{
        padding-top: 4%;
        font-weight: bold;
        color: gray;
        font-size: 18px;
    }
    .cardimg{
        /* height: 120px !important;
        /* cursor: pointer; */
        /* background-color: #235AA7 !important; */ */
       
    }
    .cardimg img{
        height: 100px;
        width: 100px;
        position: relative !important;
        text-align: center !important;
        border-radius: 20px;
        margin: 0px 5px;
    }
    .cardfondo{
        background-image: url("{{asset('storage/icons/isotipo.png')}}");
        background-color: #ffffff; /* Used if the image is unavailable */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        
        /* opacity: 0.1; */
        
    }

    .invisible{
        visibility: hidden;

    }
    .disabled{
        pointer-events:none;

    }
    .disabled img{
        opacity: 0.2;
    }
    .card-deck span{
        font-weight: bold;
        font-size: 20px;
    }
</style>

@endsection

@section('content')

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            <div class="card shadow p-3 mb-5 cardfondo px-5 py-2">
    
                <div class="card-deck my-3">
                    @if(auth()->user()->tipo_usuario_id == 3)
                        @php $disabled = 'disabled'; @endphp
                    @else
                        @php $disabled = ''; @endphp
                    @endif

                        <div class="cardimg">
                            <a href="/calendario">
                                <img class="" src="{{asset('storage/icons/Agenda.jpg')}}" alt="Card image cap">
                            </a>
                        </div>
                    
                    <span>Agenda</span>
                    
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible "></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible "></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible "></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible "></div>

                   
                    <span>Contabilidad</span>
                    <div class="cardimg {{ $disabled }}">
                        <a href="{{ route('contabilidad.index') }}">
                            <img class="" src="{{asset('storage/icons/Contabilidad.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                </div>

                <div class="card-deck my-3">
                    <div class="cardimg {{ $disabled }}">
                    <a href="/consultas">
                      <img class="" src="{{asset('storage/icons/Consultas.jpg')}}" alt="Card image cap">
                    </a>
                    </div>
                    <span>Consultas</span>
                    
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>

                    <span>Caja</span>
                    <div class="cardimg">
                        <a href="{{ route('caja') }}">
                            <img class="" src="{{asset('storage/icons/Caja.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                    
                   
                </div>

                <div class="card-deck my-3">
                    <div class="cardimg">
                        <a href="/pacientes">
                            <img class="" src="{{asset('storage/icons/Pacientes.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                    <span>Pacientes</span>
                    
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>

                    <span>Configuracion</span>
                    <div class="cardimg {{ $disabled }}">
                        <a href="{{ route('configuracion.index')}}">
                            <img class="" src="{{asset('storage/icons/Configuracion.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                   
                </div>


                <div class="card-deck my-3">
                    <div class="cardimg {{ $disabled }}">
                        <a href="{{ route('reportes.index') }}">
                            <img class="" src="{{asset('storage/icons/Aseguradoras.jpg')}}" alt="Card image cap">
                       </a>
                    </div>
                    <span>Reportes</span>
                    
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>

                    <span>LottuxPharm</span>
                    <div class="cardimg {{ $disabled }}">
                        <a href="{{ route('LottuxMed') }}">
                            <img class="" src="{{asset('storage/icons/Laboratorio.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                    
                </div>

                <div class="card-deck my-3">
                    <div class="cardimg {{ $disabled }}">
                    <a href="{{ route('reportes.graficas') }}">
                        <img class="" src="{{asset('storage/icons/Graficas.jpg')}}" alt="Card image cap">
                    </a>
                    </div>
                    <span>Graficas</span>
                    
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>
                    <div class="card border-bottom-0 border-top-0 border-left-0 border-right-0 invisible"></div>

                   
                    <span>Perfiles</span>
                    <div class="cardimg {{ $disabled }}">
                        <a href="{{ route('perfiles') }}">
                            <img class="" src="{{asset('storage/icons/Perfiles.jpg')}}" alt="Card image cap">
                        </a>
                    </div>
                </div>
                  
                  


                {{-- <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')



@endsection