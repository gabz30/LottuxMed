@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .btn-warning{
            background-color: #008000;
        }
        .btn-warning:hover{
            background-color: #017001;
        }
        .btn-warning:active{
            background-color: #ff0000 !important;
        }
        .btn-warning:visited{
            background-color: #ff0000 !important;
        }
       
    </style>

@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card-body">

            <nav>
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-historia-tab" data-toggle="tab" href="#nav-historia"
                        role="tab" aria-controls="nav-historia" aria-selected="true"><i class="fas fa-file-medical"></i>
                        Antecedentes</a>
                    {{-- <a class="nav-item nav-link" id="nav-Consulta-tab" data-toggle="tab" href="#nav-Consulta" role="tab"
                        aria-controls="nav-Consulta" aria-selected="false">
                        <i class="fas fa-stethoscope"></i> Consultas</a> --}}
                    <a class="nav-item nav-link" id="nav-Historial-tab" data-toggle="tab" href="#nav-Historial"
                        role="tab" aria-controls="nav-Historial" aria-selected="false"><i
                            class="fas fa-stethoscope"></i> Historial medico</a>
                    <a class="nav-item nav-link" id="nav-archivos-tab" data-toggle="tab" href="#nav-archivos" role="tab"
                        aria-controls="nav-archivos" aria-selected="false"><i class="fas fa-folder-open"></i>
                        Archivos</a>
                </div>
            </nav>
            <div class="tab-content my-5 mx-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-historia" role="tabpanel"
                    aria-labelledby="nav-historia-tab">


                    <div class="row">

                        <div class="col-md-6">

                           <antecedente-personal
                            user_id={{ $id }}
                           ></antecedente-personal>

                        </div>

                        <div class="col-md-6">

                            <Antecedentes user_id={{ $id }}></Antecedentes>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="nav-Consulta" role="tabpanel" aria-labelledby="nav-Consulta-tab">
                    {{-- <div class=" text-center">
                    <a 
                        type="button"
                        class="btn btn-primary my-2 h-100 p-3 w-50"
                        href="{{ route('nuevaConsulta', $id) }}"
                     ><i class="fas fa-plus-circle"></i> Nueva consulta</a>
                     </div>
                    <hr>
                    <div class="alert alert-primary my-3" role="alert">
                        <h3>Historial de Consultas</h3>
                    </div>
                    <hr>

                    <consultas user_id="{{ $id }}"></consultas> --}}

                </div>
                <div class="tab-pane fade my-5 mx-5 px-5 py-5" id="nav-Historial" role="tabpanel"
                    aria-labelledby="nav-Historial-tab">
                  


                    <div class=" text-center">
                        <a 
                            type="button"
                            class="btn btn-primary my-2 h-100 p-3 btn-block"
                            href="{{ route('nuevaConsulta', $id) }}"
                         ><i class="fas fa-plus-circle"></i> Nueva consulta</a>
                         </div>
                        <hr>
                        {{-- <div class="alert alert-primary my-3" role="alert">
                            <h3>Historial medico</h3>
                        </div>
                        <hr> --}}
    
                        <consultas user_id="{{ $id }}"></consultas>



                </div>
                <div class="tab-pane fade" id="nav-archivos" role="tabpanel" aria-labelledby="nav-archivos-tab">





                   <ul class="row list-unstyled mt-4">
                        @foreach($files as $item)
                        <div class="px-2 py-2">
                            <a href="{{ asset($item->url)}}" class="fancybox" data-fancybox="gallery">
                                <li class="col-md-12 mb-2">
                                    <img 
                                    class="img-fluid"
                                    src="{{ asset($item->url)}}" 
                                    height="360px"
                                    width="330px"
                                    />

                                    {{-- {{ asset($item->url)}} --}}
                                    {{-- <embed src="{{ asset($item->url)}}" type="application/pdf" width="100%" height="600px" /> --}}
                                </li>
                                <i class="fas fa-clock mx-3"></i> {{ $item->created_at }}
                            </a>
                        </div>
                        @endforeach            
                    </ul>

                    

                    {{-- <galeria-imagenes></galeria-imagenes> --}}
                    

                    {{-- <nuevo-archivo />--}}


                    <form action="{{ route('subir-archivo') }}"
                    class="dropzone"
                    id="my-awesome-dropzone">

                    <input type="hidden"
                    name="paciente_id"
                    id="paciente_id"
                    value="{{ $id }}"
                    />
                
                </form>

            
                </div>

            </div>

            



        </div>

    </div>
</div>
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
{{-- 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    Dropzone.options.myAwesomeDropzone = {
        headers:{
            'X-CSRF-TOKEN' : "{{ csrf_token() }}"
        },

        dictDefaultMessage: "Arrastre uno o varios archivos para subir.",
        maxFilessize: 2,
        addRemoveLinks: true,
};
</script>
@endsection