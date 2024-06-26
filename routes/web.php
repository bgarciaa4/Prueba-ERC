<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\CategoriasController;
use App\Http\Controllers\Home\ReportController;

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
    return view('layouts.home');
});

//CRUD CATEGORIAS
Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::post('store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::post('eliminar', [CategoriasController::class, 'eliminar'])->name('categorias.eliminar');
Route::post('editar', [CategoriasController::class, 'editar'])->name('categorias.editar');
Route::post('actualizar', [CategoriasController::class, 'actualizar'])->name('categorias.actualizar');

//REPORTE DE STOCK
Route::get('/indexStock', [ReportController::class, 'index'])->name('indexStock');
Route::post('Reporte', [ReportController::class, 'reporte'])->name('Reporte');
