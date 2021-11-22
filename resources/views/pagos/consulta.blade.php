@extends('layouts.app')

@section('content')

@section('css')

@endsection
@php
$suma = 0;
@endphp

@foreach ($cajas as $item)
@php 
$caja_id = $item->id
@endphp
@endforeach


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 border shadow pb-3 bg-light">

            <div class="p-3">

                

                @if(!$cajas)
                <div class="alert alert-danger" role="alert">
                    No hay caja abierta
                  </div>
                @endif

                <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="">Monto de la consulta</label>
                    <input type="number" class="form-control" id="monto_consulta"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Monto cubierto por el seguro</label>
                    <input type="number" class="form-control" id="monto_seguro"/>
                </div>
    
                    <h4
                        class="alert-heading text-danger font-weight-bold"
                    >
                        Comentario del Doctor
                    </h4>

                    <textarea class="form-control" rows="3" disabled>{{ $consulta->comentario }}</textarea>

                    <input type="text" id="authLogin" value="{{ auth()->user()->id }}" hidden/>
                    <input type="text" id="consulta_id" value="{{ $consulta->id }}" hidden/>

                    
                    <hr />
               
                </div>

                @if(!$consulta->estudios->isEmpty())
                <hr>
                    <input type="checkbox" class="form-check-input" id="checkEstudios" onclick="calcular()"/>
                    <label for="">Agregar estudios de interconsulta?</label>
                   
                        <div class="alert alert-success text-black border shadow col-md-11 p-3">
                            <h3 class="font-weight-bold">Estudios de interconsulta:</h3>
                            
                            
                                @foreach ($consulta->estudios as $item)
                                    <h6>{{ $item->estudiosInterconsulta->descripcion }} - <b>${{ number_format($item->precio,2) }}</b></h6>
                                
                                    @php
                                    $suma = $suma + $item->precio;
                                    @endphp
                                @endforeach
                        
                            <br>
                            Total: <b>${{ number_format($suma,2) }}</b>
                            <input type="text" value="{{ $suma }}" id="total_estudios" hidden/>
                        </div>
                @else
              
                    <input type="checkbox" class="form-check-input" id="checkEstudios" onclick="calcular()" hidden/>
                    <input type="text" value="0" id="total_estudios" hidden/>
                        
                @endif
                <hr>
                <div class="row my-2">
                    <div class="col-md-6">
                        <label for="">Total a cobrar:</label>
                        <input type="text" class="form-control" id="total" onclick="calcular()"/>
                    </div>
                    <div class="col-md-6">
                        <label for="">Tipo de pago</label>
                        <select name="tipo_pago" id="tipo_pago" class="form-control">
                            <option value="1">Efectivo</option>
                            <option value="2">Tarjeta</option>
                        </select>
                    </div>
                </div>
                <hr>

                @if(!empty($caja_id))
                <input type="text" id="caja_id" name="caja_id" value="{{ $caja_id }}" hidden/>

                <button class="btn btn-primary btn-block" onclick="procesarPago()">Procesar pago</button>
                @else

                <button class="btn btn-danger btn-block" disabled>Debe aperturar la caja antes de pagar una consulta.</button>
                @endif

            </div>  
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var datos;
         function calcular(){

            const check = document.getElementById("checkEstudios").checked; 
            const monto_consulta = document.getElementById("monto_consulta").value;
            const monto_seguro = document.getElementById("monto_seguro").value;
            const total_estudios = document.getElementById("total_estudios").value;

            var total_pagar = 0;

            if(check){
                total_pagar = (Number(monto_consulta) + Number(total_estudios) - monto_seguro);
            }else{
                total_pagar = (monto_consulta - monto_seguro);
            }

            // console.log('Total a pagar => ' + total_pagar);
            
            document.getElementById("total").value = total_pagar;
            
        }
        function procesarPago(){
            





            var total = document.getElementById("total").value;

            if(total <= 0){
                alert('Debe digitar un numero valido!');
            }else{
                

                const consulta_id = @json($consulta->id);
                
                const estudiosRealizados = @json($consulta->estudiosRealizados);
                //console.log(estudiosRealizados);

                const data = {
                    check: document.getElementById("checkEstudios").checked,
                    monto_consulta: document.getElementById("monto_consulta").value,
                    monto_seguro: document.getElementById("monto_seguro").value,
                    total_estudios: document.getElementById("total_estudios").value,
                    total_pago: document.getElementById("total").value,
                    consulta_id: consulta_id,
                    authLogin: document.getElementById("authLogin").value,
                    tipo_pago: document.getElementById("tipo_pago").value,
                    caja_id: document.getElementById("caja_id").value,
                    estatus: 0,
                }


                axios.post('/pago', data)
                .then(res => {
                    
                        //actualizamos el estatus de la consulta en la tabl.
                        
                        axios.put('/consultas/'+consulta_id, {
                            estatus: 1,
                        })
                        .then(res => console.log(res.data))
                        .catch(err => console.log(err))
                    

                    var noPago = res.data.id;
                    var consulta = false;

                 

                    
                    
                 
                    // var check = document.getElementById("checkEstudios").checked;
                    if(Object.keys(estudiosRealizados).length === 0){
                        
                                        var datos = {
                                            noPago: noPago,
                                            interconsulta_id: 0,
                                            importe: document.getElementById("monto_consulta").value,
                                            estatus: 1,
                                            consulta: 1                  
                                        };

                                        axios.post('/detallePago', datos)
                                        .then(res => console.log(res.data))
                                        .catch(err => console.log(err))
                            
                    }else{
                        estudiosRealizados.forEach((value, index) => {
                                // for(var index = 0; index <= estudiosRealizados.length; index++){

                                    
        
                                    if(index === 0)
                                    {

                                        var datos = {
                                            noPago: noPago,
                                            interconsulta_id: 0,
                                            importe: document.getElementById("monto_consulta").value,
                                            estatus: 1,
                                            consulta: 1                  
                                        };

                                        axios.post('/detallePago', datos)
                                        .then(res => console.log(res.data))
                                        .catch(err => console.log(err))
                                    }

                                    if(data.check){

                                        datos = {
                                            noPago: noPago,
                                            interconsulta_id: value.interconsulta_id,
                                            importe: value.precio,
                                            estatus: 1,
                                            consulta: consulta
                                        };

                                        axios.post('/detallePago', datos)
                                        .then(res => console.log(res.data))
                                        .catch(err => console.log(err))
                                    }
                            

                                

                            });
   

                    }

                    Swal.fire({
                        icon: "success",
                        title: "Pago realizado exitosamente!",
                        showConfirmButton: false,
                        timer: 1300
                    });

                    setTimeout( () => { window.location.href = window.location.origin + "/home"; }, 1000);

                    
                })
                .catch(err => console.log(err))

            }





        }

    
        
    </script>
@endsection