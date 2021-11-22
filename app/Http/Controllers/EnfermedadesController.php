<?php

namespace App\Http\Controllers;

use App\Models\enfermedades;
use Illuminate\Http\Request;

class EnfermedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return enfermedades::orderBy('nombre','asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\enfermedades  $enfermedades
     * @return \Illuminate\Http\Response
     */
    public function show(enfermedades $enfermedades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\enfermedades  $enfermedades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, enfermedades $enfermedades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\enfermedades  $enfermedades
     * @return \Illuminate\Http\Response
     */
    public function destroy(enfermedades $enfermedades)
    {
        //
    }
}
