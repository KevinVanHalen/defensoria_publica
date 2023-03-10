<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaController;
// use App\Http\Controllers\API\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RequisitoController;
use App\Http\Controllers\TipoTramiteController;
use App\Http\Controllers\CentroAtencionController;
use App\Http\Controllers\NumeroContactoController;
use App\Http\Controllers\ReportesController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
});


/**
 * RUTAS ADMINISTRATIVAS
 */
Route::group(['middleware' => 'auth:sanctum'], function ($router) {
    // Ruta para citas del día
    Route::get('/catalogos/citas-del-dia', [CitaController::class, 'getCitasDelDia']);
    
    // Ruta para guardar número de whatsapp
    Route::post('/whatsapp/guardar-numero', [NumeroContactoController::class, 'guardarNumero']);

    // Ruta para guardar/editar horarios para citas
    Route::post('/horarios/llenar-dias', [DiaController::class, 'getDiasMes']);
    Route::post('/horarios/guardar-dias', [DiaController::class, 'guardarDias']);
    Route::post('/horarios/dias-editar', [DiaController::class, 'getDiasEditar']);
    Route::post('/horarios/actualizar-horario', [DiaController::class, 'actualizarHorario']);
    Route::post('/horarios/actualizar-horario-citas', [DiaController::class, 'actualizarHorarioCitas']);

    // Actualizar estatus cita y motivo*
    Route::post('/citas/citas-del-dia', [CitaController::class, 'guardarCambios']);
    Route::post('/citas/citas-del-dia-buscada', [CitaController::class, 'selectDiaCita']);

    // Rutas utilizadas para catalogo de tramites
    Route::get('/catalogos/tramites', [TramiteController::class, 'getTramites']);
    Route::post('/tramite/guardar-nuevo', [TramiteController::class, 'guardarNuevoTramite']);
    Route::post('/tramite/actualizar-tramite', [TramiteController::class, 'actualizarTramite']);
    Route::post('/tramite/eliminar-tramite', [TramiteController::class, 'eliminarTramite']);

    // Rutas utilizadas para catalogo de requisitos
    Route::get('/catalogos/requisitos', [RequisitoController::class, 'getRequisitos']);
    Route::post('/requisito/guardar-nuevo', [RequisitoController::class, 'guardarNuevoRequisito']);
    Route::post('/requisito/actualizar-requisito', [RequisitoController::class, 'actualizarRequisito']);
    Route::post('/requisito/eliminar-requisito', [RequisitoController::class, 'eliminarRequisito']);

    // Rutas utilizadas para catalogo de notas 
    Route::get('/catalogos/notas', [NotaController::class, 'getNota']);
    Route::post('/notas/agregar-nota', [NotaController::class, 'guardarNuevaNota']);
    Route::post('/notas/actualizar-nota', [NotaController::class, 'actualizarNota']);
    Route::post('/notas/eliminar-nota', [NotaController::class, 'eliminarNota']);

    // Rutas utilizadas para catalogo de centros de atención
    Route::get('/catalogos/centros-de-atencion', [CentroAtencionController::class, 'getCentrosAtencion']);
    Route::post('/centro-atencion/guardar-nuevo', [CentroAtencionController::class, 'guardarNuevoCentro']);
    Route::post('/centro-atencion/actualizar-centro', [CentroAtencionController::class, 'actualizarCentroAtencion']);
    Route::post('/centro-atencion/eliminar-centro', [CentroAtencionController::class, 'eliminarCentroAtencion']);

    // Rutas utilizadas para catalogo de Usuarios
    Route::get('/catalogos/usuarios', [UserController::class, 'getUsuarios']);
    Route::post('/usuarios/agregar-usuario', [UserController::class, 'guardarNuevoUsuario']);
    Route::post('/usuarios/actualizar-usuario', [UserController::class, 'actualizarUsuario']);
    Route::post('/usuarios/eliminar-usuario', [UserController::class, 'eliminarUsuario']);
    
    // Rutas para reportes y graficas
    Route::post('/reporte/grafica', [CitaController::class, 'getReporteGraficas']);
    Route::post('/reportes/generar-reporte', [ReportesController::class, 'generarReporte']);
    Route::post('/reportes/exportar-reporte-citas', [ReportesController::class, 'exportarExcel']);

});

/**
 * RUTAS PUBLICAS
 */

Route::get('/whatsapp/get-numero', [NumeroContactoController::class, 'getNumero']);

Route::get('/catalogos/tipos-de-tramite', [TipoTramiteController::class, 'getTipoTramite']);

Route::get('/tramites-citas', [TramiteController::class, 'getTramitesCitas']);
Route::post('/calendario-citas', [DiaController::class, 'getCalendarioCitas']);
Route::post('/citas/agendar-cita', [CitaController::class, 'agendarCita']);

//Rutas utilizadas para los roles 
Route::get('/catalogos/roles', [RolController::class, 'getRoles']);

Route::post('/buscar-cita', [CitaController::class, 'buscarCita']);
Route::get('/cancelar-cita/{id}', [CitaController::class, 'cancelarCita']);
Route::get('/imprimir-cita/{id}', [CitaController::class, 'imprimirCita']);

Route::post('/tramite/requisitos-tipo-tramite', [TramiteController::class, 'getRequisitosTramite']);
Route::post('/tramite/requisitos-tipo-tramite-editar', [TramiteController::class, 'getRequisitosTramiteEditar']);
