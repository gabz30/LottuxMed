@extends('layouts.app')

@section('content')

<hr>
<div class="alert alert-primary my-3" role="alert">
    <h3>Todas las consultas</h3>
</div>
<hr>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9 pb-3">

            <div class="card-deck m-3">
            @foreach ($consultas as $item)

                    <div class="card">
                        
                        <div class="card-body font-weight-bold shadow p-3">

                            <h3><span class="badge badge-success text-dark">{{ $item->Paciente->name }}</span> - <span class="badge badge-danger shadow">{{ $item->created_at->diffForHumans() }}</span></h3>

                            <p class="card-text"><textarea class="form-control" rows="3" disabled>{{ $item->comentario }}</textarea></p>
                            
                            
                                
                                    @if($item->estatus == 1)
                                        <a href="{{ route('pagar.consulta', $item->id) }}" class="btn btn-danger btn-lg disabled">Pagado</a>
                                    @else                
                                        <a href="{{ route('pagar.consulta', $item->id) }}" class="btn btn-primary btn-lg"><i class="fas fa-money-check-alt"></i> Pagar consulta</a>
                                    @endif
                                
                        </div>
                    </div>
             
           
              
            {{-- <div class="alert alert-success my-3 shadow" role="alert">
                <h3>
                    <div class="row">
                        <div class="col-md-10">
                            <span class="badge badge-danger shadow"
                                >{{ $item->created_at->diffForHumans() }}
                                </span
                            >
                            <span class="badge badge-success text-dark">{{ $item->paciente->name }}</span>
                        </div>

                        <div class="col-md-2 text-right">
                            @if($item->estatus == 1)
                            <span
                                class="badge badge-danger shadow my-2"
                               
                            >
                                Pagado
                            </span>
                            @endif
                        </div>
                    </div>
                </h3>
                <hr />

                <div>

                    @if(!$item->estudiosRealizados->isEmpty())
                    <h3
                        class="alert-heading text-dark font-weight-bold"
                    >
                        Estudios de interconsulta:
                    </h3>

                        @foreach($item->estudiosRealizados as $estudio)
                            <h6>{{ $estudio->descripcion }} - <b>${{ $estudio->precio }}</b></h6>
                        @endforeach 
                    <hr />
                    @endif

                </div>


                <div>
                    <h4
                        class="alert-heading text-danger font-weight-bold"
                    >
                        Comentario
                    </h4>

                    <textarea class="form-control" rows="3" disabled>{{ $item->comentario }}</textarea>
                    
                    <hr />
                </div>

                @if($item->estatus == 1)
                <a href="{{ route('pagar.consulta', $item->id) }}" class="btn btn-primary btn-lg disabled"><i class="fas fa-money-check-alt"></i> Pagar consulta</a>
                @else                
                <a href="{{ route('pagar.consulta', $item->id) }}" class="btn btn-primary btn-lg"><i class="fas fa-money-check-alt"></i> Pagar consulta</a>
                @endif

        </div> --}}
            @endforeach
        </div>
            {{ $consultas->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>



@endsection