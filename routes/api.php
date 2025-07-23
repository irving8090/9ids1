<?php

use App\Http\Controllers\ClasesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MembresiasController;
use App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class,'login']);
//Membresias
Route::post('membresias/nuevo',[MembresiasController::class,'store']);
Route::post('membresias/eliminar',[MembresiasController::class,'delete']);
Route::put('membresias/{id}', [MembresiasController::class, 'update']);
Route::get('membresias',[MembresiasController::class,'list']);
//Usuarios
Route::get('clientes', [ClienteController::class, 'index']);           
//Profesor
Route::get('profesores', [ClienteController::class, 'index1']);
//Administrador
Route::get('administradores', [ClienteController::class, 'index2']);

Route::post('clientes/nuevo', [ClienteController::class, 'store']);    
Route::get('clientes/{id}', [ClienteController::class, 'show']);       
Route::put('clientes/{id}', [ClienteController::class, 'update']);     
Route::delete('clientes/{id}', [ClienteController::class, 'destroy']); 

//Ver todas las clases (clientes, profesores, todos pueden verlas)
Route::get('verClases', [ClienteController::class, 'verClases']);

// Crear clase (solo administradores)
Route::post('clases/nuevo/{id}', [ClienteController::class, 'crearClase']);

// Marcar asistencia a clase
Route::post('clases/asistir/{cliente_id}/{clase_id}', [ClienteController::class, 'asistirClase']);


// Editar clase
Route::put('clases/{id}', [ClasesController::class, 'actualizarClase']);

// Eliminar clase
Route::delete('clases/{id}', [ClasesController::class, 'eliminarClase']);
Route::get('membresias/usuario', [MembresiasController::class, 'listPorUsuario']);

//Clases Profesor
Route::get('clases/profesor/{profesorId}', [ClasesController::class, 'clasesPorProfesor']);

//Clases CLiente
Route::get('/clases/cliente/{cliente_id}', [ClienteController::class, 'verClasesInscritas']);


//Graficos Para TV
Route::prefix('dashboard')->group(function () {
    Route::get('/tipos-membresia-populares', [DashboardController::class, 'tiposMembresiaPopulares']);
    Route::get('/clases-por-profesor', [DashboardController::class, 'clasesPorProfesor']);
});
