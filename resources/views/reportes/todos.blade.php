@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row justify-content-center">

            <reportes user_id="{{ auth()->user()->id }}"></reportes>
        
    </div>
</div>

@endsection
