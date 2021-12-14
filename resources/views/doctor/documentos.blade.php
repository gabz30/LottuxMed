@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
    integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<style>
    trix-editor {
        min-height: 300px !important;
    }
</style>

@section('content')
<div class="row justify-content-center">

    <div class="col-md-6 border shadow pb-3 bg-light">

        <div class="p-4">
            <form action="">
                <label for="">Nombre</label>
                <input type="text" class="form-control mb-4">
                <div class="form-group">
                    <label for="plantilla">Plantilla</label>
                    <input id="x" type="hidden" name="plantilla" />
                    <trix-editor input="x"></trix-editor>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix-core.js"
    integrity="sha512-H8CbNdhcOBCt62S6eVGAUSiyNx5OGVEVrYIIVs0iIgurgD1+oTA9THTZ1tqxSE9yw9vzfilg83xgyxD467a28g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection