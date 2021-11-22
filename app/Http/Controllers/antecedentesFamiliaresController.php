<?php

namespace App\Http\Controllers;

use App\Models\antecedentes;
use Illuminate\Http\Request;

class AntecedentesFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return antecedentes::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\antecedentes_familiares  $antecedentes_familiares
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $antecedente = antecedentes::with('enfermedades:id,nombre')
        ->where('user_id','=', $id)
        ->orderBy('id', 'asc')
        ->get();

        return $antecedente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\antecedentes_familiares  $antecedentes_familiares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\antecedentes_familiares  $antecedentes_familiares
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
