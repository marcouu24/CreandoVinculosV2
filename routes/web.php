<?php

use Illuminate\Support\Facades\Route;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [App\Http\Controllers\MapaController::class, 'index'] )->name('mapa');

Route::middleware(['auth'])->group(function () {
Route::get('/centros', [App\Http\Controllers\CentrosController::class, 'index'] )->name('centros.index');
Route::get('/centros/crear', [App\Http\Controllers\CentrosController::class, 'crear'] )->name('centros.crear');
Route::post('/centros/guardar', [App\Http\Controllers\CentrosController::class, 'guardar'])->name('centros.guardar');
Route::get('/centros/listar', [App\Http\Controllers\CentrosController::class, 'listar'] )->name('centros.listar');
Route::delete('/centros/eliminar/{id}', [App\Http\Controllers\CentrosController::class, 'eliminar'])->name('centros.eliminar');
Route::get('/centros/editar/{id}', [App\Http\Controllers\CentrosController::class, 'editar'] )->name('centros.editar');


Route::get('/categorias', [App\Http\Controllers\CategoriasController::class, 'index'] )->name('categorias.index');
Route::get('/categorias/crear', [App\Http\Controllers\CategoriasController::class, 'crear'] )->name('categorias.crear');
Route::post('/categorias/guardar', [App\Http\Controllers\CategoriasController::class, 'guardar'])->name('categorias.guardar');
Route::get('/categorias/listar', [App\Http\Controllers\CategoriasController::class, 'listar'] )->name('categorias.listar');
Route::delete('/categorias/eliminar/{id}', [App\Http\Controllers\CategoriasController::class, 'eliminar'])->name('categorias.eliminar');
Route::get('/categorias/editar/{id}', [App\Http\Controllers\CategoriasController::class, 'editar'] )->name('categorias.editar');




Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'] )->name('usuarios.index');
Route::get('/usuarios/crear', [App\Http\Controllers\UsuariosController::class, 'crearUsuario'] )->name('usuarios.crear');
Route::post('/usuarios/guardar', [App\Http\Controllers\UsuariosController::class, 'guardarUsuario'])->name('usuarios.guardar');
Route::get('/usuarios/listar', [App\Http\Controllers\UsuariosController::class, 'listar'] )->name('usuarios.listar');
Route::get('/usuarios/editar/{id}', [App\Http\Controllers\UsuariosController::class, 'editarUsuario'] )->name('usuarios.editar');
Route::delete('/usuarios/eliminar/{id}', [App\Http\Controllers\UsuariosController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
});

Route::get('/mapa/getCentros/{id}',[App\Http\Controllers\MapaController::class, 'getCentros'])->name('mapa.getCentros');