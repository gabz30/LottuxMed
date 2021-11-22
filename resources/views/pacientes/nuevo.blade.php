@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-light border pb-3 shadow">


            <nuevo-paciente user_login="{{ auth()->user()->id }}"></nuevo-paciente>

        </div>
    </div>
</div>
@endsection