@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
        
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pagos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-cxc-tab" data-toggle="pill" href="#pills-cxc" role="tab" aria-controls="pills-cxc" aria-selected="false">CxC</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-cxp-tab" data-toggle="pill" href="#pills-cxp" role="tab" aria-controls="pills-cxp" aria-selected="false">CxP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-nomina-tab" data-toggle="pill" href="#pills-nomina" role="tab" aria-controls="pills-nomina" aria-selected="false">Nomina</a>
                  </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <contabilidad-pagos user_id="{{ auth()->user()->id }}"></contabilidad-pagos>
                </div>
                <div class="tab-pane fade" id="pills-cxc" role="tabpanel" aria-labelledby="pills-cxc-tab">

                    
                    <cxc user_id="{{ auth()->user()->id }}"></cxc>

                </div>
                <div class="tab-pane fade" id="pills-cxp" role="tabpanel" aria-labelledby="pills-cxp-tab">

                  <cxp user_id="{{ auth()->user()->id }}"></cxp>


                </div>
                <div class="tab-pane fade" id="pills-nomina" role="tabpanel" aria-labelledby="pills-nomina-tab">
                    <nomina user_id="{{ auth()->user()->id }}"></nomina>
                </div>
              </div>


        </div>
    </div>
</div>

@endsection
