@extends('layouts.app')

@section('css')
    <style>
      .alert-info{
        background-color: #2b5b76 !important;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
      }
      .bg-success{
        background-color: #098b09 !important;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 6px;
      }
      .texto-success{
        color: #098b09 !important;
        font-weight: bold;
        font-size: 19px;
      }
      .texto-info{
        color: #2b5b76 !important;
        font-weight: bold;
        font-size: 19px;
      }
      .bg-info{
        background-color: #2b5b76 !important;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 6px;
      }
      .bg-danger{
        background-color: #c00101 !important;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 6px;
        color: #ffffff;
      }
      .bg-danger-span{
        color: #c00101;
        font-weight: bold;
        text-align: center;
        border-radius: 6px;
      }
      .btn-success{
        background-color: #2b5b76;
        border: none;
      }
      .btn-success:hover{
        background-color: #193c50;
      }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

          @foreach($caja as $item)
            
            @php 
              $id = $item->id
            @endphp
          @endforeach

            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="apertura-tab" data-toggle="tab" href="#apertura" role="tab" aria-controls="apertura" aria-selected="true">Apertura de caja</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="gastos-tab" data-toggle="tab" href="#gastos" role="tab" aria-controls="gastos" aria-selected="false">Gastos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="cierre-tab" data-toggle="tab" href="#cierre" role="tab" aria-controls="cierre" aria-selected="false">Cierre de caja</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="apertura" role="tabpanel" aria-labelledby="apertura-tab">

                    <apertura-caja user_id="{{ auth()->user()->id }}"></apertura-caja>

                </div>
                <div class="tab-pane fade" id="gastos" role="tabpanel" aria-labelledby="gastos-tab">
                    

                  @if(!$caja->isEmpty())
                    <gastos user_id="{{ auth()->user()->id }}" caja_id="{{ $id }}"></gastos>
                    @else

                    <div class="alert alert-danger my-4" role="alert">
                      Debe abrir la caja antes de registrar un gasto.
                    </div>

                  @endif
                </div>
                <div class="tab-pane fade" id="cierre" role="tabpanel" aria-labelledby="cierre-tab">
                  @if(!empty($id))
                  <cierre-caja user_id="{{ auth()->user()->id }}" caja_id="{{ $id }}"></cierre-caja>
                  @else

                  <div class="alert alert-danger my-4" role="alert">
                    Debe abrir la caja antes de realizar el cierre.
                  </div>

                @endif
                    
                    
                </div>
              </div>



        </div>
    </div>
</div>


@endsection