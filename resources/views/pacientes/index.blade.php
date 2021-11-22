@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
 
                <div class="col-md-7">

                    <lista-pacientes user_login="{{ auth()->user()->authLogin }}"></lista-pacientes>

        </div>

    </div>
</div>
@endsection

{{-- 


<div class="form-inline bg-dark my-2 py-2 px-2">
                       
    <input 
    type="text"
    placeholder="Buscar paciente..."
    class="w-25 p-1 mr-1"
    />
    <button
    type="button"
    class="btn btn-primary btn-md "
    ><i class="fas fa-search"></i></button>

</div>


<div class="card">
    
    <div class="card-header">Pacientes</div>

    <table class="table table-dark">
        <thead>
            <tr>
                
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Cedula</th>
                <th scope="col">Celular</th>
                <th scope="col">Telefono</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
           
            @foreach($pacientes as $item)
                <tr>
                    
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->cedula }}</td>
                    <td>{{ $item->celular }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>
                


                        <a 
                        href="{{ route('historiaClinica', $item->id) }}"
                        class="btn btn-primary"
                        >Ver expediente</a>

                        <a 
                        href="{{ route('historiaClinica', $item->id) }}"
                        class="btn btn-primary"
                        >Agendar</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 --}}
