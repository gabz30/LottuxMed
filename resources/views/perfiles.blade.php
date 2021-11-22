@extends('layouts.app')

@section('content')
    
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-2 border shadow pb-3 bg-light">

            <perfiles user_id="{{ auth()->user()->id }}"></perfiles>

        </div>
    </div>
</div>
@endsection