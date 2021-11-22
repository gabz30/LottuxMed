@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-light border pb-3 shadow">

            <div class="alert alert-primary my-3" role="alert">
                <h3>Nueva consulta</h3>
            </div>
            <hr>

            <formulario-receta user_id="{{ $id }}" doctor="{{ auth()->user()->id }}"></formulario-receta>

        </div>
    </div>
</div>

@endsection