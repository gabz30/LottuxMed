@extends('layouts.app')
@section('css')

<style>
body {
    background: #eee
}

.icons i {
    color: #b5b3b3;
    border: 1px solid #b5b3b3;
    padding: 6px;
    margin-left: 4px;
    border-radius: 5px;
    cursor: pointer
}

.activity-done {
    font-weight: 600
}

.list-group li {
    margin-bottom: 12px
}

.list-group-item {}

.list li {
    list-style: none;
    padding: 10px;
    border: 1px solid #e3dada;
    margin-top: 12px;
    border-radius: 5px;
    background: #fff
}

.checkicon {
    color: green;
    font-size: 19px
}

.date-time {
    font-size: 12px
}

.profile-image img {
    margin-left: 3px
}
</style>

@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card-body col-md-3">
            








            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="mt-3">

                            <h3 class="alert alert-primary">Lista de pacientes para consulta</h3>

                            <ul class="list list-inline">
                                
                                @php
                                    $datetime = \Carbon\Carbon::now();
                                @endphp

                                @foreach ($lista as $item)
                                    
                                
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2">
                                            <h6 class="mb-0"><a href="/pacientes/historia/{{ $item->user->id }}">{{ $item->user->name }}</a></h6>
                                            <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                <div><i class="fa fa-calendar-o"></i><span class="ml-2">{{ $item->created_at->format('d M Y') }}</span></div>
                                                <div class="ml-3"><i class="fa fa-clock-o"></i><span class="ml-2">{{ $datetime->diffForHumans($item->created_at) }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                               

                            </ul>
                        </div>

                        {{ $lista->links('pagination::bootstrap-4') }}

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

