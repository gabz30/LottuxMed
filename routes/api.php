<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('/usuarios',RegisterController::class);

Route::get('/doctores', [ApiController::class, 'doctores']);
Route::get('/pacientes', [ApiController::class, 'pacientes']);
Route::post('/pacientes', [ApiController::class, 'pacientesStore']);
Route::get('/pacientes/{id}', [ApiController::class, 'Showpaciente']);
Route::put('/pacientes/{id}', [ApiController::class, 'PacienteUpdate']);
Route::get('/historial-clinico/{id}', [ApiController::class, 'historialClinico']);

Route::get('/consultas/tipo/{tipo}/doctor/{doctor}', [ApiController::class, 'consultasEmergencia']);

Route::post('/user/login', [ApiController::class, 'login']);

Route::post('/calendario/{doctor}', [ApiController::class, 'calendarioGET']);
Route::post('/calendario', [ApiController::class, 'calendarioPOST']);
Route::get('/calendario/{paciente}', [ApiController::class, 'calendarioPaciente']);

Route::get('/aseguradoras', [ApiController::class, 'aseguradoras']);

Route::post('/new-consulta', [ApiController::class, 'newConsulta']);

