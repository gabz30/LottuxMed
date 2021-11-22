@extends('layouts.app')

@section('css')
    <style>
        .badge-consulta{
            background-color: #039be5;
        }
        .badge-operacion{
            background-color: #3f51b5;
        }
        .badge-evento{
            background-color: #33b679;
        }
        .badge-tarea{
            background-color: #16D3A2;
        }
        .badge-recordatorio{
            background-color: #e4c441;
        }


    </style>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9 border shadow pb-3 bg-light">
            
            <div class="row">
                <div class="col-md-2 border border-warning text-white text-left">
                    <h4><span class="badge badge-consulta">Consulta</span></h4>
                    <h4><span class="badge badge-evento">Evento</span></h4>
                    <h4><span class="badge badge-operacion">Operacion</span></h4>
                    <h4><span class="badge badge-tarea">Tarea</span></h4>
                    <h4><span class="badge badge-recordatorio">Recordatorio</span></h4>
                </div>
                <div class="col-md-10">
                    <calendario doctor_id="{{ auth()->user()->authLogin }}" /></calendario>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection