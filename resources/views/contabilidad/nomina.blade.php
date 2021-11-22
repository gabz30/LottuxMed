@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"><h3 class="ml-1"><b class="text-primary">Pago de nomina: </b> {{ auth()->user()->name }}</h3>
            
               
                <nomina user_id="{{ auth()->user()->id }}"></nomina>

            
        </div>
    </div>
</div>


@endsection