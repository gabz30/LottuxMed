<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\antecedentesController;
use App\Http\Controllers\antecedentesFamiliaresController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\UtilidadesController;
use App\Http\Controllers\EstudiosInterconsultaController;
use App\Http\Controllers\EstudiosRealizadosController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ContabilidadController;
use App\Http\Controllers\ReportesController;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use App\Http\Controllers\CitasPendientesController;
use App\Http\Controllers\doctorController;
use App\Http\Controllers\extraConsultasController;
use App\Http\Controllers\FarmaciasController;
use App\Http\Controllers\ListaEsperaController;
use App\Http\Controllers\pedidosfarmacia;
use App\Http\Controllers\pedidosfarmaciaController;
use App\Models\citasPendientes;
use App\Models\extraConsulta;
use App\Models\farmacias;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [HomeController::class, 'admin'])->name('admin');

Route::get('/admin/reportes/medicamentos', [HomeController::class, 'admin'])->name('reportesMedicamentos');
Route::get('/admin/reportes/consultas', [HomeController::class, 'reportesConsultasView'])->name('reportesConsultas');

Route::get('/admin/mantenimientos/clinicas', [HomeController::class, 'clinicas'])->name('clinicas');
Route::get('/admin/mantenimientos/ciudades', [HomeController::class, 'ciudades'])->name('ciudades');
Route::resource('/farmacias', FarmaciasController::class);
Route::get('/admin/mantenimientos/farmacias', [FarmaciasController::class, 'index'])->name('farmacias');

Route::get('/admin/ciudades/get', [HomeController::class, 'ciudadesGET']);
Route::get('/admin/especialidad/get', [HomeController::class, 'especialidadGET']);
Route::post('/admin/ciudades', [HomeController::class, 'ciudadesPOST']);
Route::get('/admin/clinicas/get', [HomeController::class, 'clinicasGET']);
Route::post('/admin/clinicas/show/{id}', [HomeController::class, 'clinicasShow']);
Route::post('/admin/clinicas', [HomeController::class, 'clinicasPOST']);

Route::get('/admin/doctor', function () {
    return view('admin.doctor');
})->name('admin.doctor.registrar');

Route::get('/admin/doctor/lista', function () {
    return view('admin.listaDoctor');
})->name('admin.doctor.lista');

Route::post('/admin/registrar/doctor', [HomeController::class, 'registrarDoctor']);
Route::get('/admin/lista/doctor', [HomeController::class, 'listaDoctores']);
Route::post('/admin/lista/doctor', [HomeController::class, 'listaDoctoresParametros']);

Route::get('/doctor-documentos', [doctorController::class, 'doctorDocumentos'])->name('doctor.documentos');

Route::post('/admin/reportes/medicamentos', [HomeController::class, 'reportesMedicamentos']);
Route::post('/admin/reportes/consultas', [HomeController::class, 'reportesConsultas']);

Route::get('/lottuxpharm', function () {
    return view('LottuxPharm.index');
})->name('LottuxMed');
Route::post('/lottuxpharm', [pedidosfarmaciaController::class, 'store']);
Route::put('/lottuxpharm/{id}', [pedidosfarmaciaController::class, 'update']);
Route::get('/get/lottuxpharm', [pedidosfarmaciaController::class, 'lista']);

Route::get('/perfiles', [UtilidadesController::class, 'perfiles'])->name('perfiles');


Route::get('/pacientes/nuevo/', [PacientesController::class, 'nuevoPaciente']);
Route::get('/pacientes/historia/{id}', [PacientesController::class, 'historiaClinica'])->name('historiaClinica');
Route::resource('/pacientes', PacientesController::class);

// Route::resource('/archivos', ArchivosController::class);

Route::post('/lista-espera', [ListaEsperaController::class, 'store']);
Route::get('/lista-espera', [ListaEsperaController::class, 'index'])->name('lista.espera');
Route::put('/lista-espera/{id}', [ListaEsperaController::class, 'update']);
// Route::get('/pacientes/lista-espera', [ListaEsperaController::class, 'lista']);

Route::resource('/antecedentes', antecedentesController::class);
Route::resource('/antecedentes/familiares', antecedentesFamiliaresController::class);

Route::get('/consulta/nueva/{id}', [ConsultasController::class, 'nuevaConsulta'])->name('nuevaConsulta');
Route::get('/consulta/recetas/{id}', [ConsultasController::class, 'showRecetas'])->name('showRecetas');
Route::resource('/consultas', ConsultasController::class);
Route::get('/consulta/{id}', [ConsultasController::class, 'mostrar']);
Route::post('/consultas/reporte', [ConsultasController::class, 'consultas'])->name('reportes.consultas');
Route::get('/busqueda/farmacias', function () {
    return view('consultas.farmacias');
});

Route::get('/enfermedades', [UtilidadesController::class, 'allEnfermedades']);
Route::post('/enfermedades', [UtilidadesController::class, 'saveEnfermedades']);
Route::get('/medicamentos', [UtilidadesController::class, 'allMedicamentos']);
Route::POST('/medicamentos', [UtilidadesController::class, 'saveMedicamentos']);
Route::get('/lista-medicamentos', [UtilidadesController::class, 'listaMedicamentos']);
Route::post('/recetas', [UtilidadesController::class, 'saveRecetas']);
Route::post('/archivos', [UtilidadesController::class, 'guardarArchivo'])->name('subir-archivo');
Route::get('/secretarias', [UtilidadesController::class, 'listaSecretarias']);
Route::get('/ocupaciones', [UtilidadesController::class, 'ocupaciones']);
Route::get('/grupos-sanguineos', [UtilidadesController::class, 'gruposSanguineos']);


// </Calendario>
Route::resource('/calendarios', CalendarioController::class);
Route::get('/calendario', [CalendarioController::class, 'vista'])->name('calendario.vista');
Route::delete('/calendario/{id}', [CalendarioController::class, 'destroy']);

Route::get('/citas-pendientes/', function () {
    return view('calendario.pendientes');
})->name('citas.pendientes');

Route::get('/citas-pendientes/index', [CitasPendientesController::class, 'index']);
Route::put('/citas-pendientes/{id}', [CitasPendientesController::class, 'update']);
// <Contabilidad>

// Pago de consulta
Route::get('/pago/consulta/{id}', [PagosController::class, 'consultar'])->name('pagar.consulta');
Route::post('/pago', [PagosController::class, 'realizarPago']);
Route::post('/detallePago', [PagosController::class, 'guardarDetalle']);


// Excel
Route::get('/excel/gastos', [GastosController::class, 'gastosExcel'])->name('gastos.excel');

// Nomina
Route::get('/nomina', [NominaController::class, 'index'])->name('nomina');
Route::get('/lista-nomina', [NominaController::class, 'lista'])->name('nomina.lista');
Route::post('/nomina', [NominaController::class, 'guardar']);
Route::post('/nomina/busqueda', [NominaController::class, 'busqueda']);
Route::put('/nomina/{id}', [NominaController::class, 'update']);

// Caja
Route::get('/caja', [CajaController::class, 'index'])->name('caja');
Route::get('/lista-cajas', [CajaController::class, 'lista']);
Route::post('/caja/apertura', [CajaController::class, 'guardar']);
Route::get('/caja/Showcierre', [CajaController::class, 'ShowcierreCaja']);
Route::PUT('/caja/apertura/{id}', [CajaController::class, 'update']);
Route::post('/caja/cierre', [CajaController::class, 'store']);
Route::post('/caja/cierre/busqueda', [CajaController::class, 'listaCierre']);

// Route::get('/caja/apertura', [CajaController::class,'index'])->name('apertura.caja');

//Gastos
Route::get('/gastos', [GastosController::class, 'index'])->name('gastos');
Route::get('/lista-gastos', [GastosController::class, 'lista']);
Route::post('/gastos/buscar/', [GastosController::class, 'buscar']);
Route::post('/gastos', [GastosController::class, 'guardar']);
// </ Contabilidad>


//Estudios
Route::resource('/estudios-realizados', EstudiosRealizadosController::class);

// Mantenimientos
Route::resource('/estudios', EstudiosInterconsultaController::class);
Route::get('/todos/estudios', [EstudiosInterconsultaController::class, 'getALL']);

// Configuracion
Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
Route::post('/configuracion', [ConfiguracionController::class, 'registrar']);
Route::PUT('/configuracion/estudios/{id}', [ConfiguracionController::class, 'estatusEstudios']);

//Extra consultas

Route::post('/extra-consultas', [extraConsultasController::class, 'store']);
Route::get('/extra-consultas/{id}', [extraConsultasController::class, 'show']);

// Reportes
Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
// Route::get('/graficas', [ReportesController::class,'graficas'])->name('reportes.graficas');


// Contabilidad
Route::get('/contabilidad', [ContabilidadController::class, 'index'])->name('contabilidad.index');
Route::post('/contabilidad/buscar/', [ContabilidadController::class, 'buscar']);

Route::post('/contabilidad/buscar/cxc/', [ContabilidadController::class, 'buscarcxc']);
Route::PUT('/contabilidad/pago/{id}', [ContabilidadController::class, 'actualizarPago']);

// Route::post('/historia', [PacientesController::class, 'guardar']);


// Route::get('/pacientes', [RegisterController::class, 'index']);
// Route::get('/pacientes', function () {
//     return view('pacientes');
// });


// $usuarios = User::all()->take(6);


// Route::get('/pdf', function(){

//     $pdf =  PDF::loadView('Reportes.todos');

//     return $pdf->stream();

// })->name('pdf');




Route::get('/graficas', function () {

    $user_id = auth()->user()->id;

    // $chart = (new LarapexChart)->lineChart()
    // ->setTitle('Users')
    // ->addLine('Active users', User::query()->inRandomOrder()->limit(6)->pluck('id')->toArray())
    // ->addLine('Inactive users', User::query()->inRandomOrder()->limit(6)->pluck('id')->toArray())
    // ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'])
    // ->setColors(['#ffc63b', '#ff6384']);

    // return App\Models\estudios_realizados::inRandomOrder()->limit(6)->pluck('id');

    $userLogin = App\Models\User::limit(4)->pluck('id');
    $estudios = App\Models\estudios_realizados::limit(4)->pluck('id');


    // $consultasRealizadas = App\Models\Consultas::select('id', 'sintomas', 'created_at')
    // ->get()
    // ->groupBy(function($date) {
    //     return \Carbon\Carbon::parse($date->created_at)->format('m'); // grouping by years
    //     //return Carbon::parse($date->created_at)->format('m'); // grouping by months
    // });




    $now = \Carbon\Carbon::now();

    $consultasNormales = App\Models\Consultas::where('created_at', '>=', $now->year)
        ->where('drID', '=', $user_id)
        ->where('tipo_consulta_id', '=', 1)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get(array(
            DB::raw('DATE_FORMAT(created_at,"%b - %Y") as date'),
            DB::raw('COUNT(*) as "views"')
        ));
    $dateConsultasNormales = [];
    $viewsConsultasNormales = [];
    $vies1 = 0;

    foreach ($consultasNormales as $item) {
        $dateConsultasNormales[] = $item->date;
        $viewsConsultasNormales[] = $item->views;
        $vies1 += $item->views;
    }

    $consultasEmergencia = App\Models\Consultas::where('created_at', '>=', $now->year)
        ->where('drID', '=', $user_id)
        ->where('tipo_consulta_id', '=', 2)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get(array(
            DB::raw('DATE_FORMAT(created_at,"%b - %Y") as date'),
            DB::raw('COUNT(*) as "views"')
        ));
    $dateConsultasEmergencia = [];
    $viewsConsultasEmergencia = [];
    $vies2 = 0;

    foreach ($consultasEmergencia as $item) {
        $dateConsultasEmergencia[] = $item->date;
        $viewsConsultasEmergencia[] = $item->views;
        $vies2 += $item->views;
    }


    $consultasInternamiento = App\Models\Consultas::where('created_at', '>=', $now->year)
        ->where('drID', '=', $user_id)
        ->where('tipo_consulta_id', '=', 3)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get(array(
            DB::raw('DATE_FORMAT(created_at,"%b - %Y") as date'),
            DB::raw('COUNT(*) as "views"')
        ));
    $dateConsultasInternamiento = [];
    $viewsConsultasInternamiento = [];
    $vies3 = 0;

    foreach ($consultasInternamiento as $item) {
        $dateConsultasInternamiento[] = $item->date;
        $viewsConsultasInternamiento[] = $item->views;
        $vies3 += $item->views;
    }

    $consultasUci = App\Models\Consultas::where('created_at', '>=', $now->year)
        ->where('drID', '=', $user_id)
        ->where('tipo_consulta_id', '=', 4)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get(array(
            DB::raw('DATE_FORMAT(created_at,"%b - %Y") as date'),
            DB::raw('COUNT(*) as "views"')
        ));
    $dateConsultasUci = [];
    $viewsConsultasUci = [];
    $vies4 = 0;

    foreach ($consultasUci as $item) {
        $dateConsultasUci[] = $item->date;
        $viewsConsultasUci[] = $item->views;
        $vies4 += $item->views;
    }


    $sql = "SELECT SUM(p.total_pago) as total_pago,SUM(p.monto_seguro) as monto_seguro, DATE_FORMAT(p.created_at,'%b - %Y') as date, COUNT(*) as 'views'
                            from pagos p
                            inner join consultas c on (p.consulta_id = c.id)
                            inner join users u on (u.id = c.user_id) 
                            where true
                                and p.authLogin in (select id from users where authLogin = $user_id)
                                and DATE_FORMAT(p.created_at,'%Y') >= $now->year
                                GROUP BY date
                                ORDER BY p.id desc";

    $busquedaPagos = DB::select($sql);

    $datePagos = [];
    $monto_seguro = [];
    $total_pago = [];


    foreach ($busquedaPagos as $item) {
        $datePagos[] = $item->date;
        $monto_seguro[] = $item->monto_seguro;
        $total_pago[] = $item->total_pago;
    }


    $sql = "SELECT SUM(p.monto) as monto, DATE_FORMAT(p.created_at,'%b - %Y') as date
    from gastos p
    inner join users u on (u.id = p.user_id) 
    where true
        and p.user_id in (select id from users where authLogin = $user_id)
        and DATE_FORMAT(p.created_at,'%Y') >= 2021
        GROUP BY date
        ORDER BY p.id desc";

    $busquedaGastos = DB::select($sql);

    $dateGastos = [];
    $total_Gastos = [];


    foreach ($busquedaGastos as $item) {
        $dateGastos[] = $item->date;
        $total_Gastos[] = $item->monto;
    }



    // $consultasRealizadas = (new LarapexChart)->horizontalBarChart()
    //     ->setTitle('Consultas realizadas')
    //     ->addData('Consultas', $viewsConsultasNormales)
    //     ->setMarkers(['#FFA41B', '#4F46E5'], 7, 10)
    //     ->setXAxis($dateConsultasNormales);



    $consultasRealizadas = (new LarapexChart)->donutChart()
        ->setTitle('Consultas realizadas')
        ->setSubtitle('2021.')
        ->addData([$vies1, $vies2, $vies3, $vies4])
        ->setLabels(['Consulta', 'Emergencia', 'Internamiento', 'Uci']);

    $chartPagos = (new LarapexChart)->barChart()
        ->setTitle('Efectivo vs Aseguradora.')
        ->setSubtitle('Ganado durante el ' . $now->year)
        ->addData('Efectivo', $total_pago)
        ->addData('Seguro', $monto_seguro)
        ->setXAxis($datePagos);

    $gastos = (new LarapexChart)->horizontalBarChart()
        ->setTitle('Gastos')
        ->setSubtitle('Gastos del ' . $now->year)
        ->setColors(['#D32F2F', '#D32F2F'])
        ->addData('Gastos', $total_Gastos)
        ->setXAxis($dateGastos);


    return view('reportes.graficas', compact('gastos', 'chartPagos', 'consultasRealizadas'));
})->name('reportes.graficas');
