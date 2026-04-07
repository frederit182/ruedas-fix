<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroInstalacionController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('dashboard');
});

// REGISTROS
Route::get('/registros', [RegistroInstalacionController::class, 'index'])->name('registros.index');
Route::get('/registros/create', [RegistroInstalacionController::class, 'create'])->name('registros.create');
Route::post('/registros', [RegistroInstalacionController::class, 'store'])->name('registros.store');

// CLIENTES
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/buscar-serial', [ClienteController::class, 'buscar'])->name('clientes.buscar');
// AJAX
Route::get('/buscar-serial/{serial}', [RegistroInstalacionController::class, 'buscarSerial']);
use App\Http\Controllers\ConsumoRuedaController;

Route::get('/consumos/create', [ConsumoRuedaController::class, 'create']);
Route::post('/consumos', [ConsumoRuedaController::class, 'store'])->name('consumos.store'); 
Route::get('/equipos/{cliente}', function ($clienteId) {
    return \App\Models\Equipo::where('cliente_id', $clienteId)->get();
});