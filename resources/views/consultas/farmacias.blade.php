@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-light border pb-3 shadow">

            <div class="alert alert-primary my-3" role="alert">
                <h3>Seleccionar farmacia para enviarle la receta medica.</h3>
            </div>
            <hr>

            <busqueda-farmacia doctor="{{ auth()->user()->id }}"></busqueda-farmacia>

        </div>
    </div>
</div>

@endsection