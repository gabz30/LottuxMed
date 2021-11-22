<?php

namespace App\Http\Controllers;

use App\Models\estudios_realizados;
use Illuminate\Http\Request;

class EstudiosRealizadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
        return estudios_realizados::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estudios_realizados  $estudios_realizados
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return estudios_realizados::where('consulta_id','=',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estudios_realizados  $estudios_realizados
     * @return \Illuminate\Http\Response
     */
    public function edit(estudios_realizados $estudios_realizados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estudios_realizados  $estudios_realizados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudios_realizados $estudios_realizados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estudios_realizados  $estudios_realizados
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudios_realizados $estudios_realizados)
    {
        //
    }
}
