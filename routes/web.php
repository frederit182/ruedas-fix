<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroInstalacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConsumoRuedaController;
use App\Http\Controllers\InventarioRuedaController;

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

// 📦 INVENTARIO DE RUEDAS
Route::get('/inventario', [InventarioRuedaController::class, 'index'])->name('inventario.index');
Route::get('/inventario/create', [InventarioRuedaController::class, 'create'])->name('inventario.create');
Route::post('/inventario', [InventarioRuedaController::class, 'store'])->name('inventario.store');

// AJAX
Route::get('/buscar-serial/{serial}', [RegistroInstalacionController::class, 'buscarSerial']);

// 🔧 CONSUMO DE RUEDAS
Route::get('/consumo', function () {
    return redirect()->route('consumo.create');
})->name('consumo.index');

Route::get('/consumo/create', [ConsumoRuedaController::class, 'create'])->name('consumo.create');
Route::post('/consumo', [ConsumoRuedaController::class, 'store'])->name('consumo.store');

// 🔥 HISTORIAL (SOLO UNA VEZ)
Route::get('/consumo/historial/{cliente_id}', [ConsumoRuedaController::class, 'historialCliente'])->name('consumo.historial');

// 🔧 EQUIPOS POR CLIENTE (AJAX)
Route::get('/equipos/{cliente}', function ($clienteId) {
    return \App\Models\Equipo::where('cliente_id', $clienteId)->get();
});