@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <configuracion user_id="{{ auth()->user()->id }}"></configuracion>

    </div>
</div>
@endsection